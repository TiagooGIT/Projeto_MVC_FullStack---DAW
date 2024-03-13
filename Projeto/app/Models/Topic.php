<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $connection = 'posts';
    protected $table = 'topic';
    protected $primaryKey = 'id_topic';
    protected $fillable = ['id_user', 'title_topic', 'description_topic'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
