<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'owner'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
