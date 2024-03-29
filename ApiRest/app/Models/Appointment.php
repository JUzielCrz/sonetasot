<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','last_name','email', 'phone', 'date', 'curp', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
