<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorFormRequest extends FormRequest
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
        return [
            'tgl_transaksi' => 'required',
        ];
    }

    public function message()
    {
        return [
            'tgl_transaksi.required' => 'Tanggal Tidak boleh kosong',
        ];
    }
}
