<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    use HasFactory;
    protected $table = 'notification_users';

    protected $fillable = [
        'nu_notification_id', 'nu_user_id', 'nu_type_user', 'nu_status', 'created_at','updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nu_user_id', 'id');
    }
}
