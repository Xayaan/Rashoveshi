<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Request;

class Update extends Request
{
    /**
     * Returns the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->getParameter('id');

        return [
            'name' => 'required',
            'slug' => 'required|unique:roles,slug,'.$id,
        ];
    }
}
