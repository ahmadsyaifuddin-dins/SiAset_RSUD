<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGudangKeluarRequest extends FormRequest
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
            'ruangan_id' => 'required|exists:ruangan,id', // Barang dikasih ke siapa
            'tanggal_keluar' => 'required|date',
            'jumlah_keluar' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ];
    }
}
