<?php

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Province::create([
      'id' => 16,
      'province_name' => 'Bursa'
    ]);
  }
}
