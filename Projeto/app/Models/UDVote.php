<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UDVote extends Model
{
    use HasFactory;
    protected $connection = 'posts';
    protected $primaryKey = 'id_votes';
    protected $table = 'ud_votes';
    protected $fillable = ['id_post', 'id_user', 'vote'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
