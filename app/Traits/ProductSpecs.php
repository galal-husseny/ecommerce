<?php
namespace App\Traits;
use App\Models\ProductSpec;

trait ProductSpecs {
    public function storeSpecs(array $specs) :void
    {
        foreach ($specs as $spec) {
            $specData = [
                'product_id'=>$this->id,
                'spec_id' => $spec['spec_id'],
                'value' => [
                    'en' => $spec['en'],
                    'ar' => $spec['ar']
                ]
            ];
            ProductSpec::create($specData);
        }
    }
}
