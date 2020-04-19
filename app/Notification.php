<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'sender_id', 'recipient_id', 'text',
        'system_notification', 'opened',
    ];
}
