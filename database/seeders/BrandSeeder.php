<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = array(
            array('id' => '24','name' => '{"en":"BMW","ar":"بي ام دابليو"}','slug' => '{"en":"bmw","ar":"بي-ام-دابليو"}','status' => '0','created_at' => '2022-04-08 11:15:22','updated_at' => '2022-04-15 08:16:20'),
            array('id' => '25','name' => '{"en":"JEEP","ar":"جيب"}','slug' => '{"en":"jeep","ar":"جيب"}','status' => '1','created_at' => '2022-04-08 13:11:19','updated_at' => '2022-04-08 13:11:19'),
            array('id' => '26','name' => '{"en":"Hyundai","ar":"هيونداي"}','slug' => '{"en":"hyundai","ar":"هيونداي"}','status' => '1','created_at' => '2022-04-08 13:11:56','updated_at' => '2022-04-08 13:11:56'),
            array('id' => '27','name' => '{"en":"Mercides","ar":"مرسيدس"}','slug' => '{"en":"mercides","ar":"مرسيدس"}','status' => '1','created_at' => '2022-04-08 13:12:22','updated_at' => '2022-04-08 13:12:22'),
            array('id' => '28','name' => '{"en":"Honda","ar":"هوندا"}','slug' => '{"en":"honda","ar":"هوندا"}','status' => '1','created_at' => '2022-04-08 13:12:45','updated_at' => '2022-04-08 13:12:45'),
            array('id' => '29','name' => '{"en":"FORD","ar":"فورد"}','slug' => '{"en":"ford","ar":"فورد"}','status' => '1','created_at' => '2022-04-08 13:13:28','updated_at' => '2022-04-08 13:13:28'),
            array('id' => '30','name' => '{"en":"KIA","ar":"كيا"}','slug' => '{"en":"kia","ar":"كيا"}','status' => '1','created_at' => '2022-04-08 13:14:09','updated_at' => '2022-04-08 13:14:09')
          );
        Brand::insert($brands);
    }
}
