<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    protected $hidden = [
        'sender_id',
        'receiver_id',
        'created_at',
        'updated_at',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
