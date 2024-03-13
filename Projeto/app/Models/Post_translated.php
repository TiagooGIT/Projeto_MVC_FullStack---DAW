<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_translated extends Model
{
    use HasFactory;

    protected $connection = 'posts';
    protected $table = 'post_translated';
    protected $primaryKey = 'id_post_translated';
    protected $fillable = ['id_post', 'id_language', 'titulo', 'conteudo', 'validacao', 'comentario_validacao', 'id_user'];


    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'id_language', 'id_language');
    }
}
