<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            array('id' => '1','model_type' => 'App\\Models\\Brand','model_id' => '24','uuid' => 'c8ad631c-2224-46ee-b31a-6f76902cc779','collection_name' => 'brands','name' => '0TSS','file_name' => '0TSS.png','mime_type' => 'image/png','disk' => 'public','conversions_disk' => 'public','size' => '5433','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-15 11:12:53','updated_at' => '2022-04-15 11:12:53'),
            array('id' => '2','model_type' => 'App\\Models\\Brand','model_id' => '25','uuid' => 'a24cab2a-e402-4ad8-8f7d-e79a9f8faecd','collection_name' => 'brands','name' => '1','file_name' => '1.jpg','mime_type' => 'image/jpeg','disk' => 'public','conversions_disk' => 'public','size' => '81238','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-15 11:13:07','updated_at' => '2022-04-15 11:13:07'),
            array('id' => '3','model_type' => 'App\\Models\\Brand','model_id' => '26','uuid' => '874c8b93-1025-4710-88c0-dab1f5274482','collection_name' => 'brands','name' => '1_vvIq_zDcvP7DdivUY8k-Dw','file_name' => '1_vvIq_zDcvP7DdivUY8k-Dw.png','mime_type' => 'image/png','disk' => 'public','conversions_disk' => 'public','size' => '44835','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-15 11:13:19','updated_at' => '2022-04-15 11:13:19'),
            array('id' => '4','model_type' => 'App\\Models\\Brand','model_id' => '27','uuid' => '6ddbb809-5833-4eb0-8080-bc2830ad09a7','collection_name' => 'brands','name' => '470a19a36904fe200610cc1f41eb00d9','file_name' => '470a19a36904fe200610cc1f41eb00d9.jpg','mime_type' => 'image/jpeg','disk' => 'public','conversions_disk' => 'public','size' => '512928','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-15 11:13:38','updated_at' => '2022-04-15 11:13:38'),
            array('id' => '5','model_type' => 'App\\Models\\Brand','model_id' => '28','uuid' => 'f2533171-2d4d-40c0-a617-4f2591fedd84','collection_name' => 'brands','name' => '11898','file_name' => '11898.jpg','mime_type' => 'image/jpeg','disk' => 'public','conversions_disk' => 'public','size' => '78204','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-15 11:13:53','updated_at' => '2022-04-15 11:13:53'),
            array('id' => '6','model_type' => 'App\\Models\\Brand','model_id' => '29','uuid' => 'fcf4d5e0-a1aa-4a05-8ca2-9cee3968b89c','collection_name' => 'brands','name' => '2k4k04','file_name' => '2k4k04.png','mime_type' => 'image/png','disk' => 'public','conversions_disk' => 'public','size' => '543283','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-15 11:14:06','updated_at' => '2022-04-15 11:14:06'),
            array('id' => '7','model_type' => 'App\\Models\\Brand','model_id' => '30','uuid' => 'c3bc4943-88e6-4dba-a3e9-eb628691d313','collection_name' => 'brands','name' => '132734948_3834548973306844_3826674589409784684_n','file_name' => '132734948_3834548973306844_3826674589409784684_n.jpg','mime_type' => 'image/jpeg','disk' => 'public','conversions_disk' => 'public','size' => '161289','manipulations' => '[]','custom_properties' => '[]','generated_conversions' => '[]','responsive_images' => '[]','order_column' => '1','created_at' => '2022-04-15 11:14:21','updated_at' => '2022-04-15 11:14:21')
            );
          Media::insert($media);
    }
}
