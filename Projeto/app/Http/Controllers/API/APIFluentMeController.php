<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\WEB\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\Language;


//API David: 96a2eff699mshb73118b6b069700p1584b5jsnd6a427ec3b4f
//API Tiago: 2bf2a87011mshe9eb698da18b6dcp1900cejsn7577b285df45
class APIFluentMeController extends Controller
{
    public function fetchAndStoreLanguages()
    {
        // Verifica se a tabela Language está vazia
        if (Language::count() === 0) {
            $responseLanguages = Http::withHeaders([
                'content-type' => 'application/json',
                'X-RapidAPI-Key' => '2bf2a87011mshe9eb698da18b6dcp1900cejsn7577b285df45',
                'X-RapidAPI-Host' => 'thefluentme.p.rapidapi.com',
            ])->get('https://thefluentme.p.rapidapi.com/language');

            $languages = $responseLanguages->json()['supported_languages'];

            // Certifica-se de que o array não está vazio e contém as chaves 'language_name' e 'language_voice'
            if (!empty($languages)) {
                foreach ($languages as $language) {

                    // Obtém o nome e a voz do idioma
                    $languageName = $language['language_name'];
                    $languageVoice = $language['language_voice'];

                    // Armazena o idioma na tabela Language
                    Language::create(['language' => $languageName, 'language_voice' => $languageVoice]);
                }
            }
        }
    }

    public function sendPost($titulo, $conteudo, $id_language)
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-RapidAPI-Key' => '2bf2a87011mshe9eb698da18b6dcp1900cejsn7577b285df45',
            'X-RapidAPI-Host' => 'thefluentme.p.rapidapi.com',
        ])->post('https://thefluentme.p.rapidapi.com/post', [
            'post_language_id' => $id_language,
            'post_title' => $titulo,
            'post_content' => $conteudo,
        ]);

        return $response;
    }

    public function sendPostToTranslate($api_post_id, $id_language)
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-RapidAPI-Key' => '2bf2a87011mshe9eb698da18b6dcp1900cejsn7577b285df45',
            'X-RapidAPI-Host' => 'thefluentme.p.rapidapi.com',
        ])->post('https://thefluentme.p.rapidapi.com/translate/' . $api_post_id, [
            'target_language_id' => $id_language,
        ]);

        return $response;
    }
}
