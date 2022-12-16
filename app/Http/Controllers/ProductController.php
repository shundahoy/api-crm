<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    public function index()
    {
        return Product::all();
    }


    public function store(Request $request)
    {
        $customer = Product::create(
            $request->only('name', 'memo', 'price')
        );
        return response($customer, Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $customer = Product::find($id);
        return $customer;
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->update($request->only('name', 'memo', 'price'));
        return response($product, Response::HTTP_ACCEPTED);
    }


    public function destroy($id)
    {
        Product::destroy($id);
        return response('delete success', Response::HTTP_NO_CONTENT);
    }
}
