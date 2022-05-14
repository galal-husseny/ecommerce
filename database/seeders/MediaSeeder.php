<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media = array(
            array('id' => '1','model_type' => 'App\\Models\\Brand','model_id' => '24','uuid' => '106aa46f-acf4-4ae7-933c-658279b17fac','collection_name' => 'brands','name' => '0x0','file_name' => '0x0.jpg','mime_type' => 'image/jpeg','disk' => 'public','conversions_disk' => 'public','size' => '863346','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-22 06:01:03','updated_at' => '2022-04-22 06:01:03'),
            array('id' => '2','model_type' => 'App\\Models\\Brand','model_id' => '25','uuid' => 'eb8bac65-e38d-4260-ba2a-477695494dad','collection_name' => 'brands','name' => '5d4db6e517a689e87c4266f61d77f803','file_name' => '5d4db6e517a689e87c4266f61d77f803.png','mime_type' => 'image/png','disk' => 'public','conversions_disk' => 'public','size' => '1403736','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-22 06:04:01','updated_at' => '2022-04-22 06:04:01'),
            array('id' => '3','model_type' => 'App\\Models\\Brand','model_id' => '26','uuid' => 'cce48865-584b-4dcf-b15b-fcaa3bcfa2e7','collection_name' => 'brands','name' => 'ew-car-png-car-png-for-picsart-11563113438irrl7ilth8','file_name' => 'ew-car-png-car-png-for-picsart-11563113438irrl7ilth8.png','mime_type' => 'image/png','disk' => 'public','conversions_disk' => 'public','size' => '560229','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-22 06:04:13','updated_at' => '2022-04-22 06:04:13'),
            array('id' => '4','model_type' => 'App\\Models\\Brand','model_id' => '27','uuid' => 'fc0ce7a7-e3b7-4827-b8c6-638b0cb76fc1','collection_name' => 'brands','name' => 'land-rover-range-rover-car-png-25','file_name' => 'land-rover-range-rover-car-png-25.png','mime_type' => 'image/png','disk' => 'public','conversions_disk' => 'public','size' => '104634','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-22 06:04:31','updated_at' => '2022-04-22 06:04:31'),
            array('id' => '5','model_type' => 'App\\Models\\Brand','model_id' => '28','uuid' => '62d0a071-a458-453b-abb8-8fc932678759','collection_name' => 'brands','name' => 'photo-1542362567-b07e54358753','file_name' => 'photo-1542362567-b07e54358753.jpg','mime_type' => 'image/jpeg','disk' => 'public','conversions_disk' => 'public','size' => '170529','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-22 06:04:46','updated_at' => '2022-04-22 06:04:46'),
            array('id' => '6','model_type' => 'App\\Models\\Brand','model_id' => '29','uuid' => '6f1a3a34-f3ed-4c9a-986a-ed31e2228729','collection_name' => 'brands','name' => 'photo-1605559424843-9e4c228bf1c2','file_name' => 'photo-1605559424843-9e4c228bf1c2.jpg','mime_type' => 'image/jpeg','disk' => 'public','conversions_disk' => 'public','size' => '132893','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-22 06:05:03','updated_at' => '2022-04-22 06:05:03'),
            array('id' => '7','model_type' => 'App\\Models\\Brand','model_id' => '30','uuid' => '78ab7bff-03cc-434a-adcc-6efc5cb2b6f5','collection_name' => 'brands','name' => 'png-clipart-hyundai-creta-car-mini-sport-utility-vehicle-hyundai-compact-car-car','file_name' => 'png-clipart-hyundai-creta-car-mini-sport-utility-vehicle-hyundai-compact-car-car.png','mime_type' => 'image/png','disk' => 'public','conversions_disk' => 'public','size' => '39590','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-22 06:05:18','updated_at' => '2022-04-22 06:05:18')
          );
          Media::insert($media);
    }
}
