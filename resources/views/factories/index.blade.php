<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Factories</h2>
    </x-slot>

    <div class="py-8 px-6 max-w-6xl mx-auto">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-50 text-green-700 border border-green-200 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ===================== SHOW VIEW ===================== --}}
        @if (request()->query('tab') === 'show' && isset($factory))
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

                <div class="px-6 pt-6 pb-4 border-b border-gray-200 flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $factory->factory_name }}</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Factory Details</p>
                    </div>
                    <a href="{{ route('factories.index') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        ← Back
                    </a>
                </div>

                <div class="p-6 space-y-6">

                    {{-- Factory Info --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Factory Name</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $factory->factory_name }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Location</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $factory->location }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Email</p>
                            <p class="text-sm text-gray-700">{{ $factory->email ?? '—' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Website</p>
                            <p class="text-sm text-gray-700">{{ $factory->website ?? '—' }}</p>
                        </div>
                    </div>

                    {{-- Edit button --}}
                    <div>
                        <a href="{{ route('factories.index') }}?tab=show&id={{ $factory->id }}" x-data
                            @click.prevent="$dispatch('open-modal', 'edit-factory-{{ $factory->id }}')"
                            class="px-5 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 inline-block cursor-pointer">
                            Edit Factory
                        </a>

                    </div>

                    {{-- Employees under this factory --}}
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Employees</h4>
                            <span class="text-xs text-gray-400">{{ $factory->employees->count() }} total</span>
                        </div>

                        @if ($factory->employees->isEmpty())
                            <div class="bg-gray-50 rounded-lg p-6 text-center text-sm text-gray-400">
                                No employees assigned to this factory yet.
                            </div>
                        @else
                            <table class="w-full text-sm border border-gray-100 rounded-lg overflow-hidden">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="text-left py-2.5 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                            Name</th>
                                        <th
                                            class="text-left py-2.5 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                            Email</th>
                                        <th
                                            class="text-left py-2.5 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                            Phone</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($factory->employees as $emp)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-2.5 px-4 font-medium text-gray-900">
                                                {{ $emp->firstname }} {{ $emp->lastname }}
                                            </td>
                                            <td class="py-2.5 px-4 text-gray-500">{{ $emp->email ?? '—' }}</td>
                                            <td class="py-2.5 px-4 text-gray-500">{{ $emp->phone ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
            </div>

            {{-- Edit Modal (on show page) --}}
            <x-modal name="edit-factory-{{ $factory->id }}" focusable>
                <form action="{{ route('factories.update', $factory) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <h2 class="text-lg font-semibold text-gray-900 mb-5">Edit Factory</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Factory Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="factory_name"
                                value="{{ old('factory_name', $factory->factory_name) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('factory_name') ? 'border-red-400' : 'border-gray-300' }}">
                            @error('factory_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="location" value="{{ old('location', $factory->location) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('location') ? 'border-red-400' : 'border-gray-300' }}">
                            @error('location')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $factory->email) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('email') ? 'border-red-400' : 'border-gray-300' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" name="website" value="{{ old('website', $factory->website) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('website') ? 'border-red-400' : 'border-gray-300' }}">
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <x-primary-button type="submit" class="px-5 py-2 text-sm font-medium text-white rounded-lg">
                            Update Factory
                        </x-primary-button>
                        <x-secondary-button type="button" x-on:click="$dispatch('close')"
                            class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Cancel
                        </x-secondary-button>
                    </div>
                </form>
            </x-modal>

            {{-- ===================== LIST VIEW (default) ===================== --}}
        @else
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ openCreate: false }">

                <div class="px-6 pt-6 pb-4 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Factories</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Manage your factory records</p>
                    </div>
                    <x-primary-button
                        @click="openCreate = true; $nextTick(() => $dispatch('open-modal', 'create-factory'))"
                        class="px-4 py-2 text-sm font-medium text-whiterounded-lg">
                        + Add Factory
                    </x-primary-button>
                </div>

                <div class="p-6">
                    <table class="w-full text-sm">
                        <thead>
                            <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Factory Name</th>
                            <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Location</th>
                            <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Email</th>
                            <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Website</th>
                            <th class="text-center py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Employees</th>
                            <th class="text-right py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Actions</th>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($factories as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-3 font-medium text-gray-900">{{ $item->factory_name }}</td>
                                    <td class="py-3 px-3 text-gray-500">{{ $item->location }}</td>
                                    <td class="py-3 px-3 text-gray-500">{{ $item->email ?? '—' }}</td>
                                    <td class="py-3 px-3 text-gray-500">{{ $item->website ?? '—' }}</td>
                                    <td class="py-3 px-3 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                            {{ $item->employees_count }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3">
                                        <div class="flex gap-2 justify-end">
                                            <a href="{{ route('factories.index') }}?tab=show&id={{ $item->id }}"
                                                class="px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200">
                                                View
                                            </a>
                                            {{-- Edit button opens modal --}}
                                            <button x-data
                                                @click="$dispatch('open-modal', 'edit-factory-{{ $item->id }}')"
                                                class="px-3 py-1.5 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-md hover:bg-indigo-100">
                                                Edit
                                            </button>
                                            <form action="{{ route('factories.destroy', $item) }}" method="POST"
                                                onsubmit="return confirm('Delete this factory?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded-md hover:bg-red-100">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Edit Modal per row --}}
                                <x-modal name="edit-factory-{{ $item->id }}" focusable>
                                    <div class="p-6">
                                        <form action="{{ route('factories.update', $item) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <h2 class="text-lg font-semibold text-gray-900 mb-5">Edit Factory</h2>

                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Factory
                                                        Name <span class="text-red-500">*</span></label>
                                                    <input type="text" name="factory_name"
                                                        value="{{ old('factory_name', $item->factory_name) }}"
                                                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                        {{ $errors->has('factory_name') ? 'border-red-400' : 'border-gray-300' }}">
                                                    @error('factory_name')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Location
                                                        <span class="text-red-500">*</span></label>
                                                    <input type="text" name="location"
                                                        value="{{ old('location', $item->location) }}"
                                                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                        {{ $errors->has('location') ? 'border-red-400' : 'border-gray-300' }}">
                                                    @error('location')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                    <input type="email" name="email"
                                                        value="{{ old('email', $item->email) }}"
                                                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                        {{ $errors->has('email') ? 'border-red-400' : 'border-gray-300' }}">
                                                </div>

                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                                                    <input type="url" name="website"
                                                        value="{{ old('website', $item->website) }}"
                                                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                        {{ $errors->has('website') ? 'border-red-400' : 'border-gray-300' }}">
                                                </div>
                                            </div>

                                            <div class="flex gap-3 mt-6">
                                                <x-primary-button type="submit"
                                                    class="px-5 py-2 text-sm font-medium text-white rounded-lg">

                                                    Update Factory
                                                </x-primary-button>
                                                <x-secondary-button type="button" x-on:click="$dispatch('close')"
                                                    class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                                                    Cancel
                                                </x-secondary-button>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal>

                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-gray-400 text-sm">
                                        No factories yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $factories->links() }}
                    </div>
                </div>
            </div>

            {{-- Create Modal --}}
            <x-modal name="create-factory" focusable>
                <form action="{{ route('factories.store') }}" method="POST" class="p-6">
                    @csrf

                    <h2 class="text-lg font-semibold text-gray-900 mb-5">Add Factory</h2>

                    <div class="space-y-4">
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

                    <div class="flex gap-3 mt-6">
                        <x-primary-button type="submit" class="px-5 py-2 text-sm font-medium text-whiterounded-lg ">
                            Save Factory
                        </x-primary-button>
                        <x-secondary-button type="button" x-on:click="$dispatch('close')"
                            class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Cancel
                        </x-secondary-button>
                    </div>
                </form>
            </x-modal>

        @endif

    </div>
</x-app-layout>
