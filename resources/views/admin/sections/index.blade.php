<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div class="dashboard-header-content w-full">
                <div class="flex items-start gap-4">
                    <div class="rounded-xl section-icon-wrap" style="padding: 0.7rem; background-color: #dbeafe; margin-top: -55px; margin-left: 1.2rem;">
                        <img src="{{ asset('asset/section.png') }}" alt="Section" class="object-contain section-header-icon" style="width: 29px; height: 29px; max-width: 29px; max-height: 29px;">
                        <span class="section-icon-underline" aria-hidden="true"></span>
                    </div>
                    <div>
                        <h2 class="dashboard-title text-3xl font-bold text-gray-800 tracking-tight">Section Halaman</h2>
                        <p class="dashboard-welcome text-gray-500 mt-1">Kelola komponen section pada setiap halaman.</p>
                        <a href="{{ route('admin.sections.create') }}" class="btn btn-primary mt-4 inline-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                                <path d="M5 12h14"/>
                                <path d="M12 5v14"/>
                            </svg>
                            <span>Tambah Section</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="admin-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div>
            @if (session('status'))
                <div class="alert alert-success mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="mb-6">
                <div class="px-1 pt-1 pb-2">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Filter Menu Halaman</h3>
                    </div>

                    <div class="mt-3 rounded-xl border border-sky-100 bg-sky-50/40 p-2">
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('admin.sections.index') }}" class="btn btn-sm whitespace-nowrap {{ $activePageSlug === null ? 'btn-primary' : 'btn-secondary' }}">
                                Semua Menu
                            </a>

                            @foreach ($pageFilters as $pageFilter)
                                <a href="{{ route('admin.sections.index', ['page' => $pageFilter->slug]) }}" class="btn btn-sm whitespace-nowrap {{ $activePageSlug === $pageFilter->slug ? 'btn-primary' : 'btn-secondary' }}">
                                    {{ $pageFilter->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Halaman</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe / Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($sections as $section)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $section->page?->title ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $section->title ?? '-' }}</div>
                                        <div class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-semibold">{{ $section->type }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 font-mono">{{ $section->sort_order }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($section->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.sections.edit', $section) }}" class="btn btn-sm btn-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-pen-line"><path d="m18 5-3-3H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2"/><path d="M8 18h1"/><path d="M18.4 9.6a2 2 0 1 1 3 3L17 17l-4 1 1-4Z"/></svg>
                                                <span>Edit</span>
                                            </a>
                                            <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" onsubmit="return confirm('Yakin hapus section ini? Tindakan ini tidak dapat diurungkan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center py-16 px-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                                            <h3 class="mt-2 text-sm font-semibold text-gray-900">Belum Ada Section</h3>
                                            <p class="mt-1 text-sm text-gray-500">Mulai tata letak halaman dengan membuat section baru.</p>
                                            <div class="mt-6">
                                                <a href="{{ route('admin.sections.create') }}" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                                                        <path d="M5 12h14"/>
                                                        <path d="M12 5v14"/>
                                                    </svg>
                                                    <span>Tambah Section Baru</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($sections->hasPages())
                <div class="mt-6">
                    {{ $sections->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
