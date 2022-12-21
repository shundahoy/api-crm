<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ChartContoroller extends Controller
{
    public function day(Request $request)
    {
        $order = Order::query()->join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, SUM(order_product.quantity * products.price) as sum")
            ->groupBy('date')->get();

        return $order;
    }
    public function month(Request $request)
    {
        $order = Order::query()->join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m') as date, SUM(order_product.quantity * products.price) as sum")
            ->groupBy('date')->get();

        return $order;
    }
}
