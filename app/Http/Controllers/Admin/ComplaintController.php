<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::query();
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('nomor_identitas', 'like', "%$search%");
            });
        }
        $complaints = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.complaints.index', [
            'complaints' => $complaints,
            'statuses' => ['pending' => 'Belum Diproses', 'processed' => 'Sedang Diproses', 'closed' => 'Selesai'],
        ]);
    }

    public function show(Complaint $complaint)
    {
        return view('admin.complaints.show', ['complaint' => $complaint]);
    }

    public function update(Request $request, Complaint $complaint)
    {
        $complaint->update(['status' => $request->status]);
        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
