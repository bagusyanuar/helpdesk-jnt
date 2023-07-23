<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket';

    protected $fillable = [
        'user_id',
        'tanggal',
        'no_ticket',
        'no_resi',
        'deskripsi',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id');
    }

    public function getLastReplyAttribute()
    {
        $comments = $this->comments()->orderBy('created_at', 'DESC')->first();
        if ($comments && $comments->is_admin) {
            return 'admin';
        }
        return 'customer';
    }
}
