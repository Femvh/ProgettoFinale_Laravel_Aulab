<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function chat(Request $request)
    {
        $botMessage = null;

        if ($request->isMethod('post')) {
            $userMessage = $request->input('message');
            $apiKey = env('OPENROUTER_API_KEY');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'HTTP-Referer' => 'http://localhost:8000',
                'X-Title' => 'Laravel Chatbot',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                "model"=> "openrouter/auto",
                'messages' => [
                    ['role' => 'system', 'content' => 'Sei un assistente utile.'],
                    ['role' => 'user', 'content' => $userMessage],
                ]
            ]);

            if ($response->successful()) {
                $botMessage = $response->json()['choices'][0]['message']['content'] ?? 'Nessuna risposta.';
            } else {
                $botMessage = 'Errore: ' . json_encode($response->json());
            }
        }

        return view('chat', compact('botMessage'));
    }
}
