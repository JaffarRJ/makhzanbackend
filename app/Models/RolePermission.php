<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RolePermission extends Model
{
    use HasFactory;

    /**
     * Get the permission that owns the RolePermission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permissions(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
