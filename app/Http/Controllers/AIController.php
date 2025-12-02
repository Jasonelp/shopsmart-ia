<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use OpenAI;

class AIController extends Controller
{
    private $client;

    public function __construct()
    {
        // Inicializar cliente con tu API KEY
        $this->client = OpenAI::client(env('OPENAI_API_KEY'));
    }

    /**
     * 0️⃣ — TEST BÁSICO (para verificar conexión)
     */
    public function test()
    {
        $response = $this->client->chat()->create([
            'model' => 'gpt-4.1-mini',
            'messages' => [
                ['role' => 'user', 'content' => 'Hola IA, esto es una prueba desde Laravel.']
            ],
        ]);

        return $response['choices'][0]['message']['content'];
    }

    /**
     * 1️⃣ — CHAT GENERAL IA (texto → texto)
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $text = $request->message;

        $response = $this->client->chat()->create([
            'model' => 'gpt-4.1-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un asistente experto de ShopSmart IA. Responde de forma clara y útil.'],
                ['role' => 'user', 'content' => $text],
            ],
        ]);

        return response()->json([
            'reply' => $response['choices'][0]['message']['content']
        ]);
    }

    /**
     * 2️⃣ — IA para analizar un producto
     */
    public function productAnalysis($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $prompt = "
        Analiza este producto de forma profesional y clara:

        Nombre: {$product->name}
        Precio: {$product->price}
        Categoría: {$product->category->name}
        Descripción: {$product->description}
        Stock: {$product->stock}
        ";

        $response = $this->client->chat()->create([
            'model' => 'gpt-4.1',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un analista experto de comercio electrónico.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return response()->json([
            'reply' => $response['choices'][0]['message']['content']
        ]);
    }

    /**
     * 3️⃣ — IA VISIÓN: analiza imagen por URL
     */
    public function vision(Request $request)
    {
        $request->validate([
            'image_url' => 'required|string',
        ]);

        $image = $request->image_url;

        $response = $this->client->chat()->create([
            'model' => 'gpt-4.1-mini',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'input_text',
                            'text' => 'Describe esta imagen de producto en detalle.',
                        ],
                        [
                            'type' => 'input_image',
                            'image_url' => $image,
                        ]
                    ],
                ],
            ],
        ]);

        return response()->json([
            'reply' => $response['choices'][0]['message']['content']
        ]);
    }
}
