<?php

namespace App\Http\Controllers;

use App\Models\ChatRequest;
use Illuminate\Http\Request;

class ChatRequestController extends Controller
{
    public function store(Request $request)
    {
        $formData = $request->input('form_data', []);
        if (is_string($formData)) {
            $formData = json_decode($formData, true) ?: [];
        }

        $messages = $request->input('messages', []);
        if (is_string($messages)) {
            $messages = json_decode($messages, true) ?: [];
        }

        $request->merge([
            'form_data' => $formData,
            'messages' => $messages,
        ]);

        $validated = $request->validate([
            'request_category' => ['nullable', 'string', 'in:pelayanan,pengaduan'],
            'form_data' => ['required', 'array'],
            'messages' => ['required', 'array', 'min:1'],
            'messages.*.from' => ['required', 'string', 'in:bot,user'],
            'messages.*.text' => ['required', 'string'],
            'evidence_files' => ['nullable', 'array'],
            'evidence_files.*' => ['file', 'max:10240', 'mimes:jpg,jpeg,png,webp,pdf,doc,docx'],
        ]);

        $form = $validated['form_data'];
        $uploadedEvidence = [];

        foreach ($request->file('evidence_files', []) as $file) {
            $path = $file->store('chat-requests/evidence', 'public');

            $uploadedEvidence[] = [
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ];
        }

        if (! empty($uploadedEvidence)) {
            $form['evidence_uploads'] = $uploadedEvidence;
        }

        $chatRequest = ChatRequest::create([
            'requester_name' => $form['name'] ?? null,
            'email' => $form['email'] ?? null,
            'phone' => $form['phone'] ?? null,
            'gender' => $form['gender'] ?? null,
            'age' => isset($form['age']) && is_numeric($form['age']) ? (int) $form['age'] : null,
            'institution' => $form['institution'] ?? null,
            'address' => $form['address'] ?? null,
            'request_category' => $validated['request_category'] ?? 'pelayanan',
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
