<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function balance()
{
    return $this->hasOne(Balance::class);
}

public function transactions()
{
    return $this->hasMany(Transaction::class);
}

}

