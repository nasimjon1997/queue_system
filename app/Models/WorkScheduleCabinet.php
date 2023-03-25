<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WorkScheduleCabinet extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cabinet_id',
        'from',
        'to'
    ];

    public function cabinet()
    {
        return $this->belongsTo(Cabinet::class, 'id', 'cabinet_id');
    }


}
