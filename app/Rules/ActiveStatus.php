<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ActiveStatus implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public string $table;
    public string $column;
    public const ACTIVE_STATUS = 1;
    public function __construct(string $table,string $column = 'status')
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
        $data = DB::table($this->table)->where('id',$value)
        ->where($this->column,self::ACTIVE_STATUS)->get();
        return $data->isNotEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.active_status');
    }
}
