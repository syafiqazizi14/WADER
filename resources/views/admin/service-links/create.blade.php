<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Link Layanan</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm border">
                <form action="{{ route('admin.service-links.store') }}" method="POST">
                    @php($link = null)
                    @include('admin.service-links._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
