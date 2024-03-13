<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'posts';
    protected $table = 'posts';
    protected $primaryKey = 'id_post';
    protected $fillable = ['titulo', 'conteudo', 'id_user', 'id_language', 'id_topic'];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'id_language', 'id_language');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'id_topic', 'id_topic');
    }

    public function votes()
    {
        return $this->hasMany(UDVote::class, 'id_post', 'id_post');
    }

    public function interactions()
    {
        return $this->hasMany(PostInteraction::class, 'id_post');
    }
}
