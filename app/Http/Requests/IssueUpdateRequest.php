<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssueUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'complainant_id' => 'nullable|exists:users,id',
            'investigator_id' => 'nullable|exists:users,id',
            'issue' => 'required|max:15000',
            'date' => 'required',
            'area' => 'required|in:Aguho,Magtanggol,Martires del 96,Poblacion,San Pedro,San Roque,Santa Ana,Santo Rosario Kanluran,Santo Rosario Silangan,Tabacalera',
            'type' => 'required',
            'severity' => 'required|in:Normal,Severe,Critical',
            'status' => 'required|in:Open,Processing,Completed'
        ];
    }
}
