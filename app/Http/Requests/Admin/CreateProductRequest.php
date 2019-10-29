<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $items = [];

//        foreach ($this->category->allAttributes() as $attribute) {
//            $rules = [
//                $attribute->required ? 'required' : 'nullable',
//            ];
//            if ($attribute->isInteger()) {
//                $rules[] = 'integer';
//            } elseif ($attribute->isFloat()) {
//                $rules[] = 'numeric';
//            } else {
//                $rules[] = 'string';
//                $rules[] = 'max:255';
//            }
//
//            if ($attribute->isSelect()) {
//                $rules[] = Rule::in($attribute->variants);
//            }
//
//            $items['attribute.' . $attribute->id] = $rules;
//
//        }
        return array_merge([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ], $items);
    }
}
