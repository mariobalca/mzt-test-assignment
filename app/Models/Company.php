<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $with = ['wallet:id,coins,company_id'];

    /**
     * Relationship definition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Helper method to directly return the amount of coins a company's wallet has
     *
     * @return mixed
     */
    public function coins()
    {
        return $this->wallet->coins;
    }
}
