<?php

namespace Database\Seeders;

use App\Models\Models;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = array(
            array('id' =>1 , 'name' => '{"en":"Acura ","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>2 , 'name' => '{"en":"Alfa Romeo","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>3 , 'name' => '{"en":"AMC","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>4 , 'name' => '{"en":"Aston Martin","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>5 , 'name' => '{"en":"Audi","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>6 , 'name' => '{"en":"Avanti","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>7 , 'name' => '{"en":"Bentley","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>8 , 'name' => '{"en":"BMW","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>9 , 'name' => '{"en":"Buick","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>10 , 'name' => '{"en":"Cadillac","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>11 , 'name' => '{"en":"Chevrolet","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>12 , 'name' => '{"en":"Chrysler","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>13 , 'name' => '{"en":"Daewoo","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>14 , 'name' => '{"en":"Daihatsu","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>15 , 'name' => '{"en":"Datsun","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>16 , 'name' => '{"en":"DeLorean","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>17 , 'name' => '{"en":"Dodge","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>18 , 'name' => '{"en":"Eagle","ar":"Eagle"}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>19 , 'name' => '{"en":"Ferrari","ar":"Ferrari"}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>20 , 'name' => '{"en":"FIAT","ar":"FIAT"}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>21 , 'name' => '{"en":"Fisker","ar":"Fisker"}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>22 , 'name' => '{"en":"Ford","ar":"Ford"}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>23 , 'name' => '{"en":"Freightliner","ar":"Freightliner"}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>24 , 'name' => '{"en":"Geo","ar":"Geo"}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>25 , 'name' => '{"en":"GMC","ar":"GMC"}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>26 , 'name' => '{"en":"Honda","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>27 , 'name' => '{"en":"HUMMER","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>28 , 'name' => '{"en":"Hyundai","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>29 , 'name' => '{"en":"Infiniti","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>30 , 'name' => '{"en":"Isuzu","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>31 , 'name' => '{"en":"Jaguar","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>32 , 'name' => '{"en":"Jeep","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>33 , 'name' => '{"en":"Kia","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>34 , 'name' => '{"en":"Lamborghini","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>35 , 'name' => '{"en":"Lancia","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>36 , 'name' => '{"en":"Land Rover","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>37 , 'name' => '{"en":"Lexus","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>38 , 'name' => '{"en":"Lincoln","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>39 , 'name' => '{"en":"Lotus","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>40 , 'name' => '{"en":"Maserati","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>41 , 'name' => '{"en":"Maybach","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>42 , 'name' => '{"en":"Mazda","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>43 , 'name' => '{"en":"McLaren","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>44 , 'name' => '{"en":"Mercedes-Benz","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>45 , 'name' => '{"en":"Mercury","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>46 , 'name' => '{"en":"Merkur","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>47 , 'name' => '{"en":"MINI","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>48 , 'name' => '{"en":"Mitsubishi","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>49 , 'name' => '{"en":"Nissan","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>50 , 'name' => '{"en":"Oldsmobile","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>51 , 'name' => '{"en":"Peugeot","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>52 , 'name' => '{"en":"Plymouth","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>53 , 'name' => '{"en":"Pontiac","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>54 , 'name' => '{"en":"Porsche","ar":""}' ,'year' =>'2022' ,'status' => '0','slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>55 , 'name' => '{"en":"RAM","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>56 , 'name' => '{"en":"Renault","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>57 , 'name' => '{"en":"Rolls-Royce","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>58 , 'name' => '{"en":"Saab","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>59 , 'name' => '{"en":"Saturn","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>60 , 'name' => '{"en":"Scion","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>61 , 'name' => '{"en":"smart","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>62 , 'name' => '{"en":"SRT","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>63 , 'name' => '{"en":"Sterling","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>64 , 'name' => '{"en":"Subaru","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>65 , 'name' => '{"en":"Suzuki","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>66 , 'name' => '{"en":"Tesla","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>67 , 'name' => '{"en":"Toyota","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>68 , 'name' => '{"en":"Triumph","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>69 , 'name' => '{"en":"Volkswagen","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>70 , 'name' => '{"en":"Volvo","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
            array('id' =>71 , 'name' => '{"en":"Yugo","ar":""}' ,'year' =>'2022' ,'status' => '1','slug'=>Null,'brand_id'=>24,'slug'=>Null,'brand_id'=>24,'created_at' => NULL,'updated_at' => NULL),
          );
          Models::insert($models);
    }
}
