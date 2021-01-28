<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientToken extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['device_id','token'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class,'client_token_id');
    }
}
