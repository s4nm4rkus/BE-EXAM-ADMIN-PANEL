<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Factories</h2>
    </x-slot>

    <div class="py-8 px-6 max-w-6xl mx-auto">

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

            <div class="px-6 pt-6 pb-4 border-b border-gray-200 flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Add Factory</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Create a new factory record</p>
                </div>
                <a href="{{ route('factories.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                    ← Back
                </a>
            </div>

            <div class="p-6">
                <form action="{{ route('factories.store') }}" method="POST" class="max-w-lg space-y-5">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Factory Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="factory_name" value="{{ old('factory_name') }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('factory_name') ? 'border-red-400' : 'border-gray-300' }}">
                            @error('factory_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('location') ? 'border-red-400' : 'border-gray-300' }}">
                            @error('location')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" name="website" value="{{ old('website') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button type="submit" class="px-5 py-2 text-sm font-medium text-white rounded-lg">
                            Save Factory
                        </x-primary-button>
                        <a href="{{ route('factories.index') }}"
                            class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
