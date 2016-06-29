<?php

namespace App\Http\Requests\Permissions;

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
            'name' => 'required|unique:permissions',
        ];
    }
}
