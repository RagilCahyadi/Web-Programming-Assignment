<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the public homepage (no auth required)
     */
    public function home()
    {
        // Get statistics for homepage
        $stats = [
            'customers' => Customer::count() . '+',
            'orders' => Order::count() . '+',
            'products' => Product::count() . '+',
        ];

        return view('home', compact('stats'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['home']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get dashboard statistics
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('is_paid', true)->sum('grand_total_amount');
        
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        
        // Recent orders
        $recentOrders = Order::with(['customer', 'orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Monthly revenue chart data
        $monthlyRevenue = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(grand_total_amount) as revenue')
        )
        ->where('is_paid', true)
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->pluck('revenue', 'month')
        ->toArray();
        
        // Popular products
        $popularProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCustomers', 
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'processingOrders',
            'completedOrders',
            'recentOrders',
            'monthlyRevenue',
            'popularProducts'
        ));
    }

    /**
     * Get dashboard statistics for AJAX
     */
    public function stats()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_customers' => Customer::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('is_paid', true)->sum('grand_total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'monthly_revenue' => Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(grand_total_amount) as revenue')
            )
            ->where('is_paid', true)
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('revenue', 'month'),
        ];

        return response()->json($stats);
    }
}
