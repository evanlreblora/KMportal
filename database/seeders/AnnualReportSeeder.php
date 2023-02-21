<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnnualReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       \App\Models\AnnualReport::factory()->count(10)->create();
    //    Product::factory()->count(5)->create()
    }
}
