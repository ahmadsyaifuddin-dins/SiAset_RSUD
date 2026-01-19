<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSerahTerimaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'perbaikan_id' => 'required|exists:perbaikan,id', // Ambil dari perbaikan yg Selesai
            'tanggal_serah' => 'required|date',
            'penerima' => 'required|string', // Nama orang ruangan yg nerima
            'keterangan' => 'nullable|string',
        ];
    }
}
