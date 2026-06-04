<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Employees</h2>
    </x-slot>

    <div class="py-8 px-6 max-w-6xl mx-auto">

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

            <div class="px-6 pt-6 pb-4 border-b border-gray-200 flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Add Employee</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Create a new employee record</p>
                </div>
                <a href="{{ route('employees.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                    ← Back
                </a>
            </div>

            <div class="p-6">
                <form action="{{ route('employees.store') }}" method="POST" class="max-w-lg space-y-5">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="firstname" value="{{ old('firstname') }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('firstname') ? 'border-red-400' : 'border-gray-300' }}">
                            @error('firstname')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="lastname" value="{{ old('lastname') }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('lastname') ? 'border-red-400' : 'border-gray-300' }}">
                            @error('lastname')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Factory <span
                                class="text-red-500">*</span></label>
                        <select name="factory_id"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                {{ $errors->has('factory_id') ? 'border-red-400' : 'border-gray-300' }}">
                            <option value="">-- Select Factory --</option>
                            @foreach ($factories as $f)
                                <option value="{{ $f->id }}"
                                    {{ old('factory_id') == $f->id ? 'selected' : '' }}>
                                    {{ $f->factory_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('factory_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button type="submit" class="px-5 py-2 text-sm font-medium text-white rounded-lg">
                            Save Employee
                        </x-primary-button>
                        <a href="{{ route('employees.index') }}"
                            class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
