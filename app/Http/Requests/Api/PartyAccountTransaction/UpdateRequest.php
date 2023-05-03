<?php

namespace App\Http\Requests\Api\PartyAccountTransaction;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
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
            'id' => 'required|exists:party_account_transactions,id',
            'party_transaction_id' => 'required|exists:party_transactions,id',
            'account_id' => 'required|exists:accounts,id',
            'dr' => 'required',
            'cr' => 'required'
        ];
    }
}
