<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Company;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->count(10)->create();
        /*\DB::table('companies')->insert([
            [
                'company_name' => 'コカコーラ',
                'street_address' => 'アメリカ',
                'representative_name' => 'トランプ',
            ],
            [
                'company_name' => 'ジョージア',
                'street_address' => 'ロシア',
                'representative_name' => 'プーチン',
            ],
            [
                'company_name' => '永谷園',
                'street_address' => '日本',
                'representative_name' => '阿部',
            ],
        ]);*/
    }
}
