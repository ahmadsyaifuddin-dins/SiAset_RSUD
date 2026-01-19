<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGudangMasukRequest extends FormRequest
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
            'barang_gudang_id' => 'required|exists:barang_gudang,id',
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'required|integer|min:1', // Minimal nambah 1
        ];
    }
}
