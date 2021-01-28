<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['uid','appid','language','os'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class,'client_token_id');
    }
}
