<?php

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $districtList = [
      '1' =>  'Osmangazi',
      '2' =>  'Nilüfer',
      '3' =>  'Büyükorhan',
      '4' =>  'Yıldırım',
      '5' =>  'Gemlik',
      '6' =>  'Gürsu',
      '7' =>  'Harmancık',
      '8' =>  'İnegöl',
      '9' =>  'İznik',
      '10' =>  'Karacabey',
      '11' =>  'Keles',
      '12' =>  'Kestel',
      '13' =>  'Mudanya',
      '14' =>  'Mustafakemalpaşa',
      '15' =>  'Orhaneli',
      '16' =>  'Orhangazi',
      '17' =>  'Yenişehir',
    ];

    foreach ($districtList as $key => $value) {
      District::create([
        'district_name' => $value,
        'province_id' => 16
      ]);
    }
  }
}
