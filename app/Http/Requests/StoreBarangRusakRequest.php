<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRusakRequest extends FormRequest
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
            'inventaris_id' => 'required|exists:inventaris,id',
            'tanggal_penghapusan' => 'required|date',
            'keterangan' => 'required|string', // Alasan penghapusan (Hancur/Hilang/Lelang)
        ];
    }
}
