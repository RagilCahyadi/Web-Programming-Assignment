<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::with(['customer', 'items.product'])
                     ->withCount('items')
                     ->latest()
                     ->get();
        
        $customers = Customer::orderBy('name')->get();
        
        return view('orders.index', compact('orders', 'customers'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        $shippings = Shipping::all();
        $promoCodes = PromoCode::where('valid_until', '>=', now())->get();
        
        return view('orders.create', compact('customers', 'products', 'shippings', 'promoCodes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'shipping_id' => 'required|exists:shippings,id',
            'promo_code_id' => 'nullable|exists:promo_codes,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Create order
        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'shipping_id' => $validated['shipping_id'],
            'promo_code_id' => $validated['promo_code_id'],
            'order_date' => now(),
            'sub_total_amount' => 0,
            'discount_amount' => 0,
            'grand_total_amount' => 0,
            'booking_trx_id' => 'TRX-' . time(),
        ]);

        // Calculate totals and create order items
        $subTotal = 0;
        foreach ($validated['products'] as $productData) {
            $product = Product::find($productData['id']);
            $quantity = $productData['quantity'];
            $price = $product->price;
            
            $order->orderItems()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
            
            $subTotal += $price * $quantity;
        }

        // Calculate discount and grand total
        $discountAmount = 0;
        if ($order->promo_code_id) {
            $promoCode = PromoCode::find($order->promo_code_id);
            $discountAmount = $promoCode->discount_amount;
        }

        $shipping = Shipping::find($validated['shipping_id']);
        $grandTotal = $subTotal - $discountAmount + $shipping->price;

        $order->update([
            'sub_total_amount' => $subTotal,
            'discount_amount' => $discountAmount,
            'grand_total_amount' => $grandTotal,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'orderItems.product', 'shipping', 'promoCode', 'payments']);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        $shippings = Shipping::all();
        $promoCodes = PromoCode::where('valid_until', '>=', now())->get();
        
        return view('orders.edit', compact('order', 'customers', 'shippings', 'promoCodes'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'shipping_id' => 'required|exists:shippings,id',
            'promo_code_id' => 'nullable|exists:promo_codes,id',
            'is_paid' => 'boolean',
            'tracking_number' => 'nullable|string|max:50',
        ]);

        $validated['is_paid'] = $request->has('is_paid');
        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->orderItems()->delete();
        $order->payments()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}
