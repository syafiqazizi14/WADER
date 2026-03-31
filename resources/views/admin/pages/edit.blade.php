<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <h2 class="font-bold text-3xl text-gray-800">✏️ Edit Halaman</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
                <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                    @method('PUT')
                    @include('admin.pages._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
