<?php

namespace App\Http\Controllers;

use App\Models\ChatRequest;
use Illuminate\Http\Request;

class ChatRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'form_data' => ['required', 'array'],
            'messages' => ['required', 'array', 'min:1'],
            'messages.*.from' => ['required', 'string', 'in:bot,user'],
            'messages.*.text' => ['required', 'string'],
        ]);

        $form = $validated['form_data'];

        $chatRequest = ChatRequest::create([
            'requester_name' => $form['name'] ?? null,
            'email' => $form['email'] ?? null,
            'phone' => $form['phone'] ?? null,
            'gender' => $form['gender'] ?? null,
            'age' => isset($form['age']) && is_numeric($form['age']) ? (int) $form['age'] : null,
            'institution' => $form['institution'] ?? null,
            'address' => $form['address'] ?? null,
            'service_type' => $form['service'] ?? null,
            'status' => 'submitted',
            'form_data' => $form,
            'conversation_data' => $validated['messages'],
            'submitted_at' => now(),
        ]);

        return response()->json([
            'message' => 'Permintaan berhasil disimpan.',
            'id' => $chatRequest->id,
        ], 201);
    }
}
