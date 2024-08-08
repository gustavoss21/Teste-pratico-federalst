<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\User;

class Veiculo extends Model
{
    protected $table = 'vehicle';
    protected $fillable = [
        'plate',
        'renew',
        'model',
        'brand',
        'year',
        'owner',
        'user_id'

    ];

    public function users():belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
