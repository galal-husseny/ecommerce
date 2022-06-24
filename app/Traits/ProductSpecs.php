<?php
namespace App\Traits;
use App\Models\ProductSpec;

trait ProductSpecs {
    public function storeSpecs(array $specs) :void
    {
        $specs = $this->specsForm($specs);
        $this->specs()->attach($specs);
    }
    public function updateSpecs(array $specs) :void
    {
        $specs = $this->specsForm($specs);
        $this->specs()->sync($specs);
    }

    private function specsForm(array $specs){
        $specsData = [];
        foreach ($specs as $spec) {
            $specData = [
                'spec_id' => $spec['spec_id'],
                'value' => [
                    'en' => $spec['en'],
                    'ar' => $spec['ar']
                ]
            ];
            $specsData[] = $specData;
        }
        return $specsData;
    }
}
