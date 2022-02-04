<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMapRequest extends FormRequest
{
    /**
     * @inheritDoc
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return [
            'title' => 'string|required|max:255',
            'uuid' => 'string|required|max:255|unique:maps',
            'guild_id' => 'string|required|max:255',
            'role_id' => 'string|required|max:255',
            'admin_role_id' => 'string|required|max:255'
        ];
    }
}
