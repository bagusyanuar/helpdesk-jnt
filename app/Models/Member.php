<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected $fillable = [
        'user_id',
        'email',
        'nama',
        'no_hp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
