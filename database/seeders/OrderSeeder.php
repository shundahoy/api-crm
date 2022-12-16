<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            $set_customer_id = Customer::select('id')->orderByRaw("RAND()")->first()->id;
            $set_status_id = Status::select('id')->orderByRaw("RAND()")->first()->id;
            $order = Order::create([
                "customer_id" => $set_customer_id,
                "status_id" => $set_status_id,
            ]);
            for ($j = 0; $j < rand(1, 5); $j++) {
                $set_product_id = Product::select('id')->orderByRaw("RAND()")->first()->id;
                $order->products()->attach($set_product_id);
            }
        }
    }
}
