<?php

namespace App\Http\Requests;

use App\Models\Drink;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class AddConsumptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'drink' => ['required']
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'drink.required' => 'Please provide drink.',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                if (!$this->isValidDrink($this->request->get('drink'))) {
                    $validator->errors()->add('drink', 'Invalid drink.');
                }
            });
        }
    }

    public function isValidDrink($id)
    {
        return Drink::where(['id' => $id])->first();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "message" => "Login user failed.",
            "error" => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
