<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    const ACTIVE_STATUS = 1;
    const CANCELED_STATUS = 0;
    use HasFactory;
    protected $guarded = ['id'];
}
