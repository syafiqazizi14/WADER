<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Halaman</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm border">
                <form action="{{ route('admin.pages.store') }}" method="POST">
                    @include('admin.pages._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
