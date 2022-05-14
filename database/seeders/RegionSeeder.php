<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = array(
            array('id' => '1','name' => '{"en":"15 May","ar":"15 مايو"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => date('Y-m-d H:i:s'),'updated_at' => NULL),
            array('id' => '2','name' => '{"en":"Al Azbakeyah","ar":"الازبكية"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','name' => '{"en":"Al Basatin","ar":"البساتين"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','name' => '{"en":"Tebin","ar":"التبين"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','name' => '{"en":"El-Khalifa","ar":"الخليفة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','name' => '{"en":"El darrasa","ar":"الدراسة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','name' => '{"en":"Aldarb Alahmar","ar":"الدرب الاحمر"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','name' => '{"en":"Zawya al-Hamra","ar":"الزاوية الحمراء"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','name' => '{"en":"El-Zaytoun","ar":"الزيتون"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','name' => '{"en":"Sahel","ar":"الساحل"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','name' => '{"en":"El Salam","ar":"السلام"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','name' => '{"en":"Sayeda Zeinab","ar":"السيدة زينب"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','name' => '{"en":"El Sharabeya","ar":"الشرابية"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','name' => '{"en":"Shorouk","ar":"مدينة الشروق"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','name' => '{"en":"El Daher","ar":"الظاهر"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','name' => '{"en":"Ataba","ar":"العتبة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','name' => '{"en":"New Cairo","ar":"القاهرة الجديدة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '18','name' => '{"en":"Nasr City","ar":"مدينة نصر"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '19','name' => '{"en":"El Marg","ar":"المرج"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '20','name' => '{"en":"Ezbet el Nakhl","ar":"عزبة النخل"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '21','name' => '{"en":"Matareya","ar":"المطرية"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '22','name' => '{"en":"Maadi","ar":"المعادى"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '23','name' => '{"en":"Maasara","ar":"المعصرة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '24','name' => '{"en":"Mokattam","ar":"المقطم"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '25','name' => '{"en":"Manyal","ar":"المنيل"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '26','name' => '{"en":"Mosky","ar":"الموسكى"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '27','name' => '{"en":"Nozha","ar":"النزهة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '28','name' => '{"en":"Waily","ar":"الوايلى"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '29','name' => '{"en":"Bab al-Shereia","ar":"باب الشعرية"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '30','name' => '{"en":"Bolaq","ar":"بولاق"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '31','name' => '{"en":"Garden City","ar":"جاردن سيتى"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '32','name' => '{"en":"Hadayek El-Kobba","ar":"حدائق القبة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '33','name' => '{"en":"Helwan","ar":"حلوان"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '34','name' => '{"en":"Dar Al Salam","ar":"دار السلام"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '35','name' => '{"en":"Shubra","ar":"شبرا"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '36','name' => '{"en":"Tura","ar":"طره"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '37','name' => '{"en":"Abdeen","ar":"عابدين"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '38','name' => '{"en":"Abaseya","ar":"عباسية"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '39','name' => '{"en":"Ain Shams","ar":"عين شمس"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '40','name' => '{"en":"New Heliopolis","ar":"مصر الجديدة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '41','name' => '{"en":"Masr Al Qadima","ar":"مصر القديمة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '42','name' => '{"en":"Mansheya Nasir","ar":"منشية ناصر"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '43','name' => '{"en":"Badr City","ar":"مدينة بدر"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '44','name' => '{"en":"Obour City","ar":"مدينة العبور"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '45','name' => '{"en":"Cairo Downtown","ar":"وسط البلد"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '46','name' => '{"en":"Zamalek","ar":"الزمالك"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '47','name' => '{"en":"Kasr El Nile","ar":"قصر النيل"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '48','name' => '{"en":"Rehab","ar":"الرحاب"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '49','name' => '{"en":"Katameya","ar":"القطامية"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '50','name' => '{"en":"Madinty","ar":"مدينتي"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '51','name' => '{"en":"Rod Alfarag","ar":"روض الفرج"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '52','name' => '{"en":"Sheraton","ar":"شيراتون"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '53','name' => '{"en":"El-Gamaleya","ar":"الجمالية"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '54','name' => '{"en":"10th of Ramadan City","ar":"العاشر من رمضان"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '55','name' => '{"en":"Helmeyat Alzaytoun","ar":"الحلمية"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '56','name' => '{"en":"New Nozha","ar":"النزهة الجديدة"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '57','name' => '{"en":"New Capital","ar":"العاصمة الإدارية"}','status' => '0','latitude' => NULL,'longitude' => NULL,'radius' => NULL,'city_id' => '1','created_at' => NULL,'updated_at' => NULL)
          );
          Region::insert($regions);
    }
}
