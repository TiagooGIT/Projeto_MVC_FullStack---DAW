<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Language extends Model
{
    use HasFactory;

    protected $connection = 'posts';
    protected $table = 'language';
    protected $primaryKey = 'id_language';
    protected $fillable = ['language','language_voice'];

}
