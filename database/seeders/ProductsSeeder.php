<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(10)->create();
        /*\DB::table('products')->insert([
            [
                'company_id' => '1',
                'product_name' => 'コーラ',
                'price' => '140',
                'stock' => '30',
                'comment' => '最も人気がある炭酸飲料です。',
            ],
            [
                'company_id' => '2',
                'product_name' => 'コーヒー',
                'price' => '150',
                'stock' => '26',
                'comment' => 'コーヒーです。',
            ],
            [
                'company_id' => '3',
                'product_name' => 'お茶',
                'price' => '130',
                'stock' => '20',
                'comment' => 'お茶です。',
            ],
        ]);*/
    }
}
