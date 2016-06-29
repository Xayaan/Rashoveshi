<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Request;

class Create extends Request
{
    /**
     * Returns the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:roles'
        ];
    }
}
