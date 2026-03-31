<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ChatRequestsExport;
use App\Http\Controllers\Controller;
use App\Models\ChatRequest;
use Maatwebsite\Excel\Facades\Excel;

class ChatRequestController extends Controller
{
    public function index()
    {
        return view('admin.chat-requests.index', [
            'chatRequests' => ChatRequest::query()->latest('submitted_at')->paginate(15),
        ]);
    }

    public function show(ChatRequest $chatRequest)
    {
        return view('admin.chat-requests.show', [
            'chatRequest' => $chatRequest,
        ]);
    }

    public function export()
    {
        $filename = 'chat-requests-'.now()->format('Ymd-His').'.xlsx';
        return Excel::download(new ChatRequestsExport(), $filename);
    }
}
