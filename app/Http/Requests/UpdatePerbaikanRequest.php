<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerbaikanRequest extends FormRequest
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
            'kerusakan_id' => 'required|exists:kerusakan,id', // Ambil dari laporan yg pending
            'tanggal_perbaikan' => 'required|date',
            'tindakan' => 'required|string', // Apa yang dilakukan
            'biaya' => 'required|numeric|min:0', // Request Dospem
            'teknisi' => 'required|string',
        ];
    }
}
