<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Show fancy paper service page
     */
    public function fancyPaper()
    {
        $category = Category::where('name', 'LIKE', '%Fancy Paper%')->first();
        $products = $category ? $category->products()->active()->get() : collect();
        
        return view('services.fancy-paper', compact('products', 'category'));
    }

    /**
     * Show packaging service page
     */
    public function packaging()
    {
        $category = Category::where('name', 'LIKE', '%Packaging%')->first();
        $products = $category ? $category->products()->active()->get() : collect();
        
        return view('services.packaging', compact('products', 'category'));
    }

    /**
     * Show banner service page
     */
    public function banner()
    {
        $category = Category::where('name', 'LIKE', '%Banner%')->first();
        $products = $category ? $category->products()->active()->get() : collect();
        
        return view('services.banner', compact('products', 'category'));
    }

    /**
     * Show UV printing service page
     */
    public function uvPrinting()
    {
        $category = Category::where('name', 'LIKE', '%UV Printing%')->first();
        $products = $category ? $category->products()->active()->get() : collect();
        
        return view('services.uv-printing', compact('products', 'category'));
    }

    /**
     * Calculate price for service
     */
    public function calculatePrice(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity', 1);
            $options = $request->input('options', []);
            
            $product = Product::findOrFail($productId);
            
            // Base price calculation
            $basePrice = $product->price;
            $subtotal = $basePrice * $quantity;
            
            // Apply options pricing (if any)
            $optionsPrice = 0;
            foreach ($options as $optionKey => $optionValue) {
                // You can implement specific pricing logic for different options
                switch ($optionKey) {
                    case 'material':
                        $optionsPrice += $this->getMaterialPrice($optionValue);
                        break;
                    case 'size':
                        $optionsPrice += $this->getSizePrice($optionValue);
                        break;
                    case 'finishing':
                        $optionsPrice += $this->getFinishingPrice($optionValue);
                        break;
                }
            }
            
            $totalOptionsPrice = $optionsPrice * $quantity;
            $subtotalWithOptions = $subtotal + $totalOptionsPrice;
            
            // Apply promo code if provided
            $promoCode = $request->input('promo_code');
            $discount = 0;
            if ($promoCode) {
                $discount = $this->calculatePromoDiscount($promoCode, $subtotalWithOptions);
            }
            
            $subtotalAfterDiscount = $subtotalWithOptions - $discount;
            
            // Calculate shipping
            $shippingMethod = $request->input('shipping_method', 'standard');
            $shippingCost = $this->calculateShippingCost($shippingMethod, $quantity);
            
            // Calculate tax (10%)
            $tax = $subtotalAfterDiscount * 0.10;
            
            // Final total
            $total = $subtotalAfterDiscount + $shippingCost + $tax;
            
            return response()->json([
                'success' => true,
                'data' => [
                    'base_price' => $basePrice,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                    'options_price' => $totalOptionsPrice,
                    'subtotal_with_options' => $subtotalWithOptions,
                    'discount' => $discount,
                    'subtotal_after_discount' => $subtotalAfterDiscount,
                    'shipping_cost' => $shippingCost,
                    'tax' => $tax,
                    'total' => $total,
                    'formatted' => [
                        'base_price' => 'Rp ' . number_format($basePrice, 0, ',', '.'),
                        'subtotal' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
                        'options_price' => 'Rp ' . number_format($totalOptionsPrice, 0, ',', '.'),
                        'discount' => 'Rp ' . number_format($discount, 0, ',', '.'),
                        'shipping_cost' => 'Rp ' . number_format($shippingCost, 0, ',', '.'),
                        'tax' => 'Rp ' . number_format($tax, 0, ',', '.'),
                        'total' => 'Rp ' . number_format($total, 0, ',', '.'),
                    ]
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error calculating price: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Place order from service page
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'design_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,ai,psd,cdr|max:10240',
            'notes' => 'nullable|string|max:1000',
            'shipping_method' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();
        
        try {
            // Find or create customer
            $customer = Customer::firstOrCreate(
                ['email' => $request->customer_email],
                [
                    'name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
                ]
            );

            // Calculate pricing
            $priceData = $this->calculatePrice($request)->getData(true);
            if (!$priceData['success']) {
                throw new \Exception('Failed to calculate price');
            }

            $pricing = $priceData['data'];

            // Create order
            $order = Order::create([
                'customer_id' => $customer->id,
                'order_number' => 'ORD-' . date('Ymd') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT),
                'status' => 'pending',
                'total_amount' => $pricing['total'],
                'shipping_address' => $request->customer_address,
                'shipping_method' => $request->shipping_method,
                'shipping_cost' => $pricing['shipping_cost'],
                'notes' => $request->notes,
                'payment_method' => $request->payment_method,
                'is_paid' => false,
            ]);

            // Create order item
            $product = Product::findOrFail($request->product_id);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'unit_price' => $pricing['base_price'],
                'total_price' => $pricing['subtotal_with_options'],
                'specifications' => json_encode($request->input('options', [])),
            ]);

            // Handle file upload
            if ($request->hasFile('design_file')) {
                $file = $request->file('design_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('order-files', $filename, 'public');
                
                $order->update(['design_file_path' => $path]);
            }

            DB::commit();

            // Generate WhatsApp message
            $whatsappMessage = $this->generateWhatsAppMessage($order);
            $whatsappUrl = 'https://wa.me/6285156963404?text=' . urlencode($whatsappMessage);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat!',
                'data' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'total' => $pricing['formatted']['total'],
                    'whatsapp_url' => $whatsappUrl,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Helper methods for pricing calculations
     */
    private function getMaterialPrice($material)
    {
        $prices = [
            'hvs' => 0,
            'art_paper' => 2000,
            'linen' => 5000,
            'jasmine' => 7000,
            'concorde' => 8000,
            'hammer' => 6000,
            'vinyl_doff' => 3000,
            'vinyl_glossy' => 3500,
            'bontak' => 2500,
            'flexi_china' => 15000,
            'flexi_korea' => 25000,
            'backlit' => 35000,
            'albatros' => 45000,
        ];

        return $prices[$material] ?? 0;
    }

    private function getSizePrice($size)
    {
        // Size pricing multiplier
        $sizes = [
            'a4' => 1,
            'a3' => 2,
            'a2' => 4,
            'a1' => 8,
            'custom' => 1, // Will be calculated separately
        ];

        return $sizes[$size] ?? 1;
    }

    private function getFinishingPrice($finishing)
    {
        $prices = [
            'none' => 0,
            'laminating_doff' => 3000,
            'laminating_glossy' => 3000,
            'mata_ayam' => 5000,
            'selongsong' => 3000,
            'lem_keliling' => 2000,
        ];

        return $prices[$finishing] ?? 0;
    }

    private function calculatePromoDiscount($promoCode, $subtotal)
    {
        $promoCodes = [
            'HEMAT10' => ['type' => 'percentage', 'value' => 0.10],
            'NEWUSER15' => ['type' => 'percentage', 'value' => 0.15],
            'GRATIS50' => ['type' => 'fixed', 'value' => 50000],
        ];

        if (!isset($promoCodes[$promoCode])) {
            return 0;
        }

        $promo = $promoCodes[$promoCode];
        
        if ($promo['type'] === 'percentage') {
            return $subtotal * $promo['value'];
        } else {
            return min($promo['value'], $subtotal);
        }
    }

    private function calculateShippingCost($method, $quantity)
    {
        $shippingRates = [
            'pickup' => 0,
            'local' => 15000,
            'regional' => 25000,
            'national' => 50000,
            'express' => 75000,
        ];

        $baseCost = $shippingRates[$method] ?? 25000;
        
        // Add extra cost for large quantities
        if ($quantity > 10) {
            $baseCost += ($quantity - 10) * 2000;
        }

        return $baseCost;
    }

    private function generateWhatsAppMessage($order)
    {
        $message = "*🖨️ PESANAN BARU - RNR Digital Printing*\n\n";
        $message .= "📋 *Detail Pesanan:*\n";
        $message .= "• Nomor: {$order->order_number}\n";
        $message .= "• Total: Rp " . number_format($order->total_amount, 0, ',', '.') . "\n";
        $message .= "• Status: " . ucfirst($order->status) . "\n\n";
        
        $message .= "👤 *Data Pelanggan:*\n";
        $message .= "• Nama: {$order->customer->name}\n";
        $message .= "• Email: {$order->customer->email}\n";
        $message .= "• Phone: {$order->customer->phone}\n\n";
        
        $message .= "📦 *Detail Produk:*\n";
        foreach ($order->orderItems as $item) {
            $message .= "• {$item->product->name} x{$item->quantity}\n";
            $message .= "  Rp " . number_format($item->total_price, 0, ',', '.') . "\n";
        }
        
        if ($order->notes) {
            $message .= "\n📝 *Catatan:*\n{$order->notes}\n";
        }
        
        $message .= "\n🚚 *Pengiriman:* " . ucfirst($order->shipping_method);
        $message .= "\n💳 *Pembayaran:* " . ucfirst($order->payment_method);
        
        $message .= "\n\n_Mohon konfirmasi pesanan ini. Terima kasih!_";
        
        return $message;
    }

    /**
     * Store order data in session and redirect to checkout
     */
    public function storeOrderData(Request $request)
    {
        // Validate the order data
        $orderData = $request->all();
        
        // Calculate pricing based on product type or service type
        if (isset($orderData['service_type']) && $orderData['service_type'] === 'uv-printing') {
            $orderData = $this->calculateUvPrintingPricing($orderData);
        } elseif (isset($orderData['product_type'])) {
            if (in_array($orderData['product_type'], ['label_stiker', 'packaging_custom'])) {
                $orderData = $this->calculatePackagingPricing($orderData);
            } elseif (in_array($orderData['product_type'], ['banner', 'signage'])) {
                $orderData = $this->calculateBannerPricing($orderData);
            }
        }
        
        // Store in session
        $request->session()->put('order_data', $orderData);
        
        // Return JSON response for AJAX or redirect for form submission
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order data stored successfully',
                'redirect_url' => route('checkout')
            ]);
        }
        
        return redirect()->route('checkout');
    }
    
    /**
     * Calculate pricing for packaging/label orders
     */
    private function calculatePackagingPricing($orderData)
    {
        $basePrices = [
            'label_stiker' => 1000,
            'packaging_custom' => 5000
        ];
        
        $basePrice = $basePrices[$orderData['product_type']] ?? 0;
        $quantity = (int)($orderData['quantity'] ?? 1);
        $additionalCost = 0;
        $sizeMultiplier = 1;
        
        // Calculate material/type costs
        if ($orderData['product_type'] === 'label_stiker') {
            $materialPrices = [
                'vinyl_doff' => 3000,
                'vinyl_glossy' => 3500,
                'bontak' => 2500,
                'transparan' => 4000,
                'hologram' => 8000
            ];
            
            $cutPrices = [
                'kotak' => 0,
                'kiss_cut' => 1000,
                'die_cut' => 5000
            ];
            
            $sizeMultipliers = [
                '5x5' => 1,
                '7x7' => 1.5,
                '10x10' => 2,
                'custom' => 1
            ];
            
            $additionalCost += $materialPrices[$orderData['material_type'] ?? 'vinyl_doff'] ?? 0;
            $additionalCost += $cutPrices[$orderData['cut_type'] ?? 'kotak'] ?? 0;
            $sizeMultiplier = $sizeMultipliers[$orderData['sticker_size'] ?? '5x5'] ?? 1;
            
        } elseif ($orderData['product_type'] === 'packaging_custom') {
            $packagingPrices = [
                'mug_sublim' => 25000,
                'box_custom' => 15000,
                'paper_bag' => 8000,
                'standing_pouch' => 12000
            ];
            
            $finishingPrices = [
                'none' => 0,
                'laminating' => 2000,
                'emboss' => 5000,
                'hot_print' => 7000
            ];
            
            $sizeMultipliers = [
                'small' => 1,
                'medium' => 1.5,
                'large' => 2,
                'xl' => 2.5
            ];
            
            $additionalCost += $packagingPrices[$orderData['packaging_type'] ?? 'mug_sublim'] ?? 0;
            $additionalCost += $finishingPrices[$orderData['packaging_finishing'] ?? 'none'] ?? 0;
            $sizeMultiplier = $sizeMultipliers[$orderData['packaging_size'] ?? 'small'] ?? 1;
        }
        
        // Calculate shipping cost
        $shippingCosts = [
            'pickup' => 0,
            'local' => 15000,
            'regional' => 25000,
            'national' => 50000,
            'express' => 75000
        ];
        
        $shippingCost = $shippingCosts[$orderData['shipping_method'] ?? 'pickup'] ?? 0;
        
        // Calculate subtotal
        $itemPrice = $basePrice + $additionalCost;
        $subtotal = ($itemPrice * $sizeMultiplier) * $quantity;
        
        // Apply discount if promo code exists
        $discount = 0;
        if (!empty($orderData['promo_code'])) {
            $promoCodes = [
                'HEMAT10' => ['type' => 'percentage', 'value' => 0.10],
                'NEWUSER15' => ['type' => 'percentage', 'value' => 0.15],
                'GRATIS50' => ['type' => 'fixed', 'value' => 50000]
            ];
            
            $promoCode = strtoupper($orderData['promo_code']);
            if (isset($promoCodes[$promoCode])) {
                $promo = $promoCodes[$promoCode];
                if ($promo['type'] === 'percentage') {
                    $discount = $subtotal * $promo['value'];
                } else {
                    $discount = min($promo['value'], $subtotal);
                }
            }
        }
        
        $subtotalAfterDiscount = $subtotal - $discount;
        $tax = $subtotalAfterDiscount * 0.10; // 10% tax
        $total = $subtotalAfterDiscount + $shippingCost + $tax;
        
        // Add calculated values to order data
        $orderData['subtotal'] = $subtotal;
        $orderData['shipping_cost'] = $shippingCost;
        $orderData['discount'] = $discount;
        $orderData['tax_amount'] = $tax;
        $orderData['total'] = $total;
        
        return $orderData;
    }

    /**
     * Calculate pricing for banner/signage orders
     */
    private function calculateBannerPricing($orderData)
    {
        $basePrices = [
            'banner' => 35000,
            'signage' => 100000
        ];
        
        $basePrice = $basePrices[$orderData['product_type']] ?? 35000;
        $quantity = (int)($orderData['quantity'] ?? 1);
        $additionalCost = 0;
        $sizeMultiplier = 1;
        
        // Calculate costs based on product type
        if ($orderData['product_type'] === 'banner') {
            // Banner type prices
            $bannerTypePrices = [
                'x_banner' => 35000,
                'roll_banner' => 45000,
                'backdrop' => 75000,
                'spanduk' => 25000,
                'flag_banner' => 40000
            ];
            
            // Material prices
            $materialPrices = [
                'flexi_china' => 0,
                'flexi_korea' => 15000,
                'vinyl_cutting' => 25000,
                'kanvas' => 20000,
                'tetron' => 30000
            ];
            
            // Size multipliers
            $sizeMultipliers = [
                '60x160' => 1,
                '80x200' => 1.5,
                '100x200' => 2,
                '120x200' => 2.5,
                'custom' => 1
            ];
            
            // Finishing prices
            $finishingPrices = [
                'none' => 0,
                'laminating' => 10000,
                'eyelets' => 5000,
                'wind_resistant' => 15000
            ];
            
            $basePrice = $bannerTypePrices[$orderData['banner_type'] ?? 'x_banner'] ?? 35000;
            $additionalCost += $materialPrices[$orderData['banner_material'] ?? 'flexi_china'] ?? 0;
            $additionalCost += $finishingPrices[$orderData['banner_finishing'] ?? 'none'] ?? 0;
            $sizeMultiplier = $sizeMultipliers[$orderData['banner_size'] ?? '60x160'] ?? 1;
            
        } elseif ($orderData['product_type'] === 'signage') {
            // Signage type prices
            $signageTypePrices = [
                'neon_box' => 500000,
                'acrylic_sign' => 200000,
                'led_sign' => 750000,
                'metal_sign' => 300000,
                'wooden_sign' => 250000
            ];
            
            // Material prices
            $materialPrices = [
                'acrylic' => 0,
                'aluminum' => 50000,
                'stainless' => 100000,
                'brass' => 150000,
                'wood' => 25000
            ];
            
            $basePrice = $signageTypePrices[$orderData['signage_type'] ?? 'neon_box'] ?? 500000;
            $additionalCost += $materialPrices[$orderData['signage_material'] ?? 'acrylic'] ?? 0;
        }
        
        // Calculate shipping cost
        $shippingCosts = [
            'pickup' => 0,
            'local' => 25000,
            'regional' => 50000,
            'national' => 100000,
            'express' => 150000
        ];
        
        $shippingCost = $shippingCosts[$orderData['shipping_method'] ?? 'pickup'] ?? 0;
        
        // Calculate subtotal
        $itemPrice = $basePrice + $additionalCost;
        $subtotal = ($itemPrice * $sizeMultiplier) * $quantity;
        
        // Apply discount if promo code exists
        $discount = 0;
        if (!empty($orderData['promo_code'])) {
            $promoCodes = [
                'HEMAT10' => ['type' => 'percentage', 'value' => 0.10],
                'NEWUSER15' => ['type' => 'percentage', 'value' => 0.15],
                'GRATIS50' => ['type' => 'fixed', 'value' => 50000]
            ];
            
            $promoCode = strtoupper($orderData['promo_code']);
            if (isset($promoCodes[$promoCode])) {
                $promo = $promoCodes[$promoCode];
                if ($promo['type'] === 'percentage') {
                    $discount = $subtotal * $promo['value'];
                } else {
                    $discount = min($promo['value'], $subtotal);
                }
            }
        }
        
        $subtotalAfterDiscount = $subtotal - $discount;
        $tax = $subtotalAfterDiscount * 0.10; // 10% tax
        $total = $subtotalAfterDiscount + $shippingCost + $tax;
        
        // Add calculated values to order data
        $orderData['subtotal'] = $subtotal;
        $orderData['shipping_cost'] = $shippingCost;
        $orderData['discount'] = $discount;
        $orderData['tax_amount'] = $tax;
        $orderData['total'] = $total;
        
        return $orderData;
    }

    /**
     * Calculate pricing for UV printing orders
     */
    private function calculateUvPrintingPricing($orderData)
    {
        // UV Item base prices
        $uvItemPrices = [
            'id_card' => 7000,
            'lanyard' => 15000,
            'tiket_gelang' => 4000,
            'casing_hp' => 30000,
            'plakat_akrilik' => 50000,
            'gantungan_kunci' => 8000,
            'media_flatbed' => 25000
        ];
        
        $basePrice = $uvItemPrices[$orderData['uv_item_type'] ?? 'id_card'] ?? 7000;
        $quantity = (int)($orderData['quantity'] ?? 1);
        
        // Printing side additional cost
        $printingSideCost = 0;
        if (($orderData['printing_side'] ?? '1_sisi') === '2_sisi') {
            $printingSideCost = 15000;
        }
        
        // Calculate shipping cost
        $shippingCosts = [
            'pickup' => 0,
            'local' => 15000,
            'regional' => 25000,
            'national' => 50000,
            'express' => 75000
        ];
        
        $shippingCost = $shippingCosts[$orderData['shipping_method'] ?? 'pickup'] ?? 0;
        
        // Calculate subtotal
        $itemPrice = $basePrice + $printingSideCost;
        $subtotal = $itemPrice * $quantity;
        
        // Apply discount if promo code exists
        $discount = 0;
        if (!empty($orderData['promo_code'])) {
            $promoCodes = [
                'HEMAT10' => ['type' => 'percentage', 'value' => 0.10],
                'NEWUSER15' => ['type' => 'percentage', 'value' => 0.15],
                'GRATIS50' => ['type' => 'fixed', 'value' => 50000]
            ];
            
            $promoCode = strtoupper($orderData['promo_code']);
            if (isset($promoCodes[$promoCode])) {
                $promo = $promoCodes[$promoCode];
                if ($promo['type'] === 'percentage') {
                    $discount = $subtotal * $promo['value'];
                } else {
                    $discount = min($promo['value'], $shippingCost);
                    if ($promo['value'] >= $shippingCost) {
                        $shippingCost = 0;
                        $discount = $promo['value'];
                    }
                }
            }
        }
        
        $subtotalAfterDiscount = $subtotal - $discount;
        $tax = ($subtotalAfterDiscount + $shippingCost) * 0.11; // 11% tax (PPN)
        $total = $subtotalAfterDiscount + $shippingCost + $tax;
        
        // Add calculated values to order data
        $orderData['subtotal'] = $subtotal;
        $orderData['shipping_cost'] = $shippingCost;
        $orderData['discount'] = $discount;
        $orderData['tax_amount'] = $tax;
        $orderData['total'] = $total;
        
        return $orderData;
    }

    /**
     * Show checkout page
     */
    public function checkout(Request $request)
    {
        // Get order data from session or request
        $orderData = $request->session()->get('order_data', []);
        
        // Fallback: get data from URL parameters if session is empty
        if (empty($orderData) && $request->has(['product_type', 'customer_name'])) {
            $orderData = [
                'product_type' => $request->input('product_type'),
                'quantity' => $request->input('quantity', 1),
                'customer_name' => $request->input('customer_name'),
                'customer_email' => $request->input('customer_email'),
                'customer_phone' => $request->input('customer_phone'),
                'total' => $request->input('total', 0)
            ];
            
            // Store in session for consistency
            $request->session()->put('order_data', $orderData);
        }
        
        if (empty($orderData)) {
            return redirect()->route('services.banner')->with('error', 'Tidak ada data pesanan. Silakan buat pesanan terlebih dahulu.');
        }
        
        return view('checkout', compact('orderData'));
    }

    /**
     * Process checkout
     */
    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'payment_method' => 'required|in:bank_transfer,cash_on_delivery,e_wallet',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Create or find customer
            $customer = Customer::firstOrCreate(
                ['email' => $validated['customer_email']],
                [
                    'name' => $validated['customer_name'],
                    'phone' => $validated['customer_phone'],
                    'address' => $validated['customer_address'],
                ]
            );

            // Get order data from session
            $orderData = $request->session()->get('order_data', []);
            
            if (empty($orderData)) {
                throw new \Exception('Data pesanan tidak ditemukan');
            }

            // Create order
            $order = Order::create([
                'customer_id' => $customer->id,
                'service_type' => $orderData['service_type'] ?? 'fancy_paper',
                'product_type' => $orderData['product_type'] ?? '',
                'paper_type' => $orderData['paper_type'] ?? '',
                'size' => $orderData['size'] ?? '',
                'finishing' => $orderData['finishing'] ?? '',
                'quantity' => $orderData['quantity'] ?? 1,
                'unit_price' => $orderData['unit_price'] ?? 0,
                'sub_total_amount' => $orderData['subtotal'] ?? 0,
                'shipping_cost' => $orderData['shipping_cost'] ?? 0,
                'tax_amount' => $orderData['tax_amount'] ?? 0,
                'discount_amount' => $orderData['discount'] ?? 0,
                'grand_total_amount' => $orderData['total'] ?? 0,
                'shipping_method' => $orderData['shipping_method'] ?? 'pickup',
                'payment_method' => $validated['payment_method'],
                'promo_code' => $orderData['promo_code'] ?? null,
                'notes' => $validated['notes'],
                'status' => 'pending',
                'payment_status' => 'pending'
            ]);

            // Clear order data from session
            $request->session()->forget('order_data');

            DB::commit();

            return redirect()->route('checkout.success', ['order' => $order->id])
                           ->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show checkout success page
     */
    public function checkoutSuccess(Order $order)
    {
        return view('checkout-success', compact('order'));
    }
}
