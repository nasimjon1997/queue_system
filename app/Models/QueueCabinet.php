<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class QueueCabinet extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'cabinet_id',
        'from',
        'to'
    ];

    public function cabinet()
    {
        return $this->belongsTo(Cabinet::class, 'id', 'cabinet_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }


}
