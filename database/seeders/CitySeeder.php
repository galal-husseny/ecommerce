<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = array(
            array('id' => '1','name' => '{"en":"Cairo","ar":"القاهرة"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','name' => '{"en":"Giza","ar":"الجيزة"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','name' => '{"en":"Alexandria","ar":"الأسكندرية"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','name' => '{"en":"Beheira","ar":"البحيرة"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','name' => '{"en":"Matrouh","ar":"مطروح"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','name' => '{"en":"Ismailia","ar":"الإسماعلية"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','name' => '{"en":"Dakahlia","ar":"الدقهلية"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','name' => '{"en":"Gharbiya","ar":"الغربية"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','name' => '{"en":"Menofia","ar":"المنوفية"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','name' => '{"en":"Qaliubiya","ar":"القليوبية"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','name' => '{"en":"Sharkia","ar":"الشرقية"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','name' => '{"en":"Kafr Al sheikh","ar":"كفر الشيخ"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','name' => '{"en":"Red Sea","ar":"البحر الأحمر"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','name' => '{"en":"Suez","ar":"السويس"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','name' => '{"en":"Port Said","ar":"بورسعيد"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','name' => '{"en":"Damietta","ar":"دمياط"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','name' => '{"en":"South Sinai","ar":"جنوب سيناء"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '18','name' => '{"en":"North Sinai","ar":"شمال سيناء"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '19','name' => '{"en":"Fayoum","ar":"الفيوم"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '20','name' => '{"en":"Beni Suef","ar":"بني سويف"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '21','name' => '{"en":"Minya","ar":"المنيا"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '22','name' => '{"en":"Assiut","ar":"اسيوط"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '23','name' => '{"en":"New Valley","ar":"الوادي الجديد"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '24','name' => '{"en":"Sohag","ar":"سوهاج"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '25','name' => '{"en":"Qena","ar":"قنا"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '26','name' => '{"en":"Luxor","ar":"الأقصر"}','status' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '27','name' => '{"en":"Aswan","ar":"اسوان"}','status' => '0','created_at' => NULL,'updated_at' => NULL)
          );
          City::insert($cities);
    }
}
