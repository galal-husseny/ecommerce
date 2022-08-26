<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidQuantity implements Rule , DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    public string $table;
    public string $column;
    public $quantity;
    // ...

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Create a new rule instance.
     *
     * @return void
     */


    public function __construct(string $table,string $column)
    {
        $this->table = $table;
        $this->column = $column;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $attributeArray = explode('.',$attribute);
        $primaryKey = $this->data[$attributeArray[0]][$attributeArray[1]][$this->column] ?? null;
        $data = DB::table($this->table)->where('id',$primaryKey)->first();
        $this->quantity = $data?->quantity;
        return $value <= $data?->quantity;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.valid_quantity',['value'=>$this->quantity]);
    }
}
