<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormatResponseFormRequest;
class StorePost extends FormRequest
{
    use FormatResponseFormRequest;
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'   => 'required|string',
            'author'  => 'required|string',
            'content' => 'required|string',
            'tags'    => 'required|array',
        ];
    }

}
