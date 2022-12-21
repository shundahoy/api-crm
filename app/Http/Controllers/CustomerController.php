<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $customer = Customer::with('progress')->orderBy('created_at', 'desc')->paginate(15);

        $search = $request->input('search');

        $query = Customer::query();

        if ($search) {

            $spaceConversion = mb_convert_kana($search, 's');

            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);


            foreach ($wordArraySearched as $value) {
                $query->where('name', 'like', '%' . $value . '%');
            }

            $customer = $query->with('progress')->paginate(15);
        }

        return response($customer, Response::HTTP_OK);
    }

    public function search(Request $request)
    {
        $customer = Customer::paginate(15);

        $search = $request->input('search');

        $query = Customer::query();

        if ($search) {

            $spaceConversion = mb_convert_kana($search, 's');

            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);


            foreach ($wordArraySearched as $value) {
                $query->where('name', 'like', '%' . $value . '%');
            }

            $customer = $query->paginate(15);
        } else {
            return response([]);
        }

        return response($customer, Response::HTTP_OK);
    }



    public function store(Request $request)
    {
        $customer = Customer::create(
            $request->only('name', 'memo', 'tel', 'email', 'url', 'progress_id')
        );
        return response($customer->load('progress'), Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $customer = Customer::with('orders.products')->with('progress')->find($id);
        return $customer;
    }


    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        $customer->update($request->only('name', 'memo', 'tel', 'email', 'url', 'progress_id'));
        return response($customer->load('progress'), Response::HTTP_ACCEPTED);
    }


    public function destroy($id)
    {
        $cusomer = Customer::destroy($id);
        return response($id);
    }
}
