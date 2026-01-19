<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKerusakanRequest extends FormRequest
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
            'tanggal_laporan' => 'required|date',
            'deskripsi_kerusakan' => 'required|string',
            'pelapor' => 'required|string|max:255', // Nama pelapor
            'status' => 'required|in:Pending,Proses,Selesai,Tidak Bisa Diperbaiki',
        ];
    }
}
