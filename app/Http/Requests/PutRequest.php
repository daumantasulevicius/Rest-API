<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class PutRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'index_start_at' => 'required_without_all:integer,float,name,surname,fullname,email,bool,comment|integer|digits_between:1,11',
            'integer' => 'required_without_all:index_start_at,float,name,surname,fullname,email,bool,comment|integer|digits_between:1,11',
            'float' => 'required_without_all:integer,index_start_at,name,surname,fullname,email,bool,comment|numeric|between:0.00,8.99',
            'name' => 'required_without_all:integer,float,index_start_at,surname,fullname,email,bool,comment|string|max:255',
            'surname' => 'required_without_all:integer,float,name,index_start_at,fullname,email,bool,comment|string|max:255',
            'fullname' => 'required_without_all:integer,float,name,surname,index_start_at,email,bool,comment|string|max:255',
            'email' => 'required_without_all:integer,float,name,surname,fullname,index_start_at,bool,comment|email|max:255',
            'bool' => 'required_without_all:integer,float,name,surname,fullname,email,index_start_at,comment|boolean|',
            'comment' => 'required_without_all:integer,float,name,surname,fullname,email,bool,index_start_at|string|max:255'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
