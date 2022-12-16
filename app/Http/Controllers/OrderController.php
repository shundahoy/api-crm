<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{

    public function index()
    {
        return Order::with('products')->with('status')->with('customer')->get();
    }


    public function store(Request $request)
    {
        $order = Order::create(
            $request->only('status_id', 'customer_id')
        );

        foreach ($request->input('products') as $product) {
            $order->products()->attach($product['product_id'], ['quantity' => $product['quantity']]);
        };
        return response(
            $order->load('products', 'status', 'customer'),
            Response::HTTP_CREATED
        );
    }


    public function show($id)
    {
        $order = Order::with('products')->with('status')->with('customer')->find($id);
        return $order;
    }


    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->only('status_id', 'customer_id'));
        $order->products()->detach();
        foreach ($request->input('products') as $product) {
            $order->products()->attach($product['product_id'], ['quantity' => $product['quantity']]);
        };
        return response(
            $order->load('products', 'status', 'customer'),
            Response::HTTP_ACCEPTED
        );
    }


    public function destroy($id)
    {
        Order::destroy($id);
        return response('delete success', Response::HTTP_NO_CONTENT);
    }
}
