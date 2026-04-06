<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <h2 class="font-bold text-3xl text-gray-800">📈 Tambah Statistik Mojokerto</h2>
                <p class="mt-1 text-sm text-gray-500">Unggah foto dan atur item statistik untuk halaman publik.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <form action="{{ route('admin.statistik-mojokerto.store') }}" method="POST" enctype="multipart/form-data">
                    @include('admin.statistik-mojokerto._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
