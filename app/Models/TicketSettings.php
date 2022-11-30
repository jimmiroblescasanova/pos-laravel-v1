<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'greetings', 
    ];

}
