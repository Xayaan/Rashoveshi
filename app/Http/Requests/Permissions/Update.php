<?php

namespace App\Http\Requests\Permissions;

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
              'name'=> 'required|unique:permissions,name,'.$id,
        ];
    }
}
