<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartyAccountTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'party_id',
        'transaction_id',
        'account_id',
        'sub_account_id',
        'dr',
        'amount'
    ];

    /**
     * The transaction that belong to the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partyTransaction(): BelongsTo
    {
        return $this->belongsTo(PartyTransaction::class, 'party_transaction_id', 'id');
    }
    /**
     * The transaction that belong to the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
