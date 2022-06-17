<?php
namespace App\Services;

use App\Models\Product;

class ProductCode {
    private string $categoryName;
    private string $brandName;

    /**
     * Set the value of categoryName
     *
     * @return  self
     */
    public function setCategoryName($categoryName)
    {
        if(str_contains($categoryName," ")){
            $categoryName = str_replace(" ","",$categoryName);
        }
        if(str_contains($categoryName,"\r\n")){
            $categoryName = str_replace("\r\n","",$categoryName);
        }
        $this->categoryName = strtolower($categoryName);

        return $this;
    }

    /**
     * Set the value of brandName
     *
     * @return  self
     */
    public function setbrandName($brandName)
    {
        if(str_contains($brandName," ")){
            $brandName = str_replace(" ","",$brandName);
        }
        if(str_contains($brandName,"\r\n")){
            $brandName = str_replace("\r\n","",$brandName);
        }
        $this->brandName = strtolower($brandName);

        return $this;
    }

    public function generate() :string
    {
        $maxId = Product::max('id')+1;
        $firstBrandChar = substr($this->brandName,0,1);
        $firstCategoryChar = substr($this->categoryName,0,1);
        $code = "{$firstCategoryChar}{$firstBrandChar}-$maxId";
        return $code;
    }
}
