<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DataPelayananPengaduanExport;
use App\Http\Controllers\Controller;
use App\Models\ChatRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ChatRequestController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->string('category')->toString();

        $query = ChatRequest::query();
        if (in_array($selectedCategory, ['pelayanan', 'pengaduan'], true)) {
            $query->where('request_category', $selectedCategory);
        }

        return view('admin.chat-requests.index', [
            'chatRequests' => $query->latest('submitted_at')->paginate(15)->withQueryString(),
            'selectedCategory' => $selectedCategory,
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
        $filename = 'history-chat-'.now('Asia/Jakarta')->format('Ymd-His').'.xlsx';
        return Excel::download(new DataPelayananPengaduanExport(), $filename);
    }
}
