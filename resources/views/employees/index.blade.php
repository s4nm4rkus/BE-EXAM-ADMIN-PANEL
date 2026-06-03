<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Employees</h2>
    </x-slot>

    <div class="py-8 px-6 max-w-6xl mx-auto">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-50 text-green-700 border border-green-200 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ===================== SHOW VIEW ===================== --}}
        @if (request()->query('tab') === 'show' && isset($employee))
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

                <div class="px-6 pt-6 pb-4 border-b border-gray-200 flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $employee->firstname }}
                            {{ $employee->lastname }}</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Employee Details</p>
                    </div>
                    <a href="{{ route('employees.index') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        ← Back
                    </a>
                </div>

                <div class="p-6 space-y-6">

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">First Name</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $employee->firstname }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Last Name</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $employee->lastname }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Factory</p>
                            <p class="text-sm text-gray-700">{{ $employee->factory->factory_name ?? '—' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Phone</p>
                            <p class="text-sm text-gray-700">{{ $employee->phone ?? '—' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 col-span-2">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Email</p>
                            <p class="text-sm text-gray-700">{{ $employee->email ?? '—' }}</p>
                        </div>
                    </div>

                    {{-- Edit button --}}
                    <div>
                        <a href="{{ route('employees.index') }}?tab=show&id={{ $employee->id }}" x-data
                            @click.prevent="$dispatch('open-modal', 'edit-employee-{{ $employee->id }}')"
                            class="px-5 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 inline-block cursor-pointer">
                            Edit Employee
                        </a>
                    </div>

                </div>
            </div>

            {{-- Edit Modal (on show page) --}}
            <x-modal name="edit-employee-{{ $employee->id }}" focusable>
                <form action="{{ route('employees.update', $employee) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    {{-- track which modal was open on error --}}
                    <input type="hidden" name="_edit" value="{{ $employee->id }}">

                    <h2 class="text-lg font-semibold text-gray-900 mb-5">Edit Employee</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="firstname" value="{{ old('firstname', $employee->firstname) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('firstname') ? 'border-red-400' : 'border-gray-300' }}">
                            @error('firstname')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="lastname" value="{{ old('lastname', $employee->lastname) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    {{ $errors->has('lastname') ? 'border-red-400' : 'border-gray-300' }}">
                            @error('lastname')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                                        {{ old('factory_id', $employee->factory_id) == $f->id ? 'selected' : '' }}>
                                        {{ $f->factory_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('factory_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $employee->email) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <x-primary-button type="submit" class="px-5 py-2 text-sm font-medium text-white rounded-lg">
                            Update Employee
                        </x-primary-button>
                        <x-secondary-button type="button" x-on:click="$dispatch('close')"
                            class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Cancel
                        </x-secondary-button>
                    </div>
                </form>
            </x-modal>

            {{-- Re-open show page edit modal on error --}}
            @if ($errors->any() && old('_edit') == $employee->id)
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        window.dispatchEvent(new CustomEvent('open-modal', {
                            detail: 'edit-employee-{{ $employee->id }}'
                        }));
                    });
                </script>
            @endif

            {{-- ===================== LIST VIEW (default) ===================== --}}
        @else
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

                <div class="px-6 pt-6 pb-4 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Employees</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Manage your employee records</p>
                    </div>
                    <x-primary-button x-data @click="$dispatch('open-modal', 'create-employee')"
                        class="px-4 py-2 text-sm font-medium text-white rounded-lg">
                        + Add Employee
                    </x-primary-button>
                </div>

                <div class="p-6">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th
                                    class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Name</th>
                                <th
                                    class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Factory</th>
                                <th
                                    class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Email</th>
                                <th
                                    class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Phone</th>
                                <th
                                    class="text-right py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($employees as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-3 font-medium text-gray-900">{{ $item->firstname }}
                                        {{ $item->lastname }}</td>
                                    <td class="py-3 px-3 text-gray-500">{{ $item->factory->factory_name ?? '—' }}</td>
                                    <td class="py-3 px-3 text-gray-500">{{ $item->email ?? '—' }}</td>
                                    <td class="py-3 px-3 text-gray-500">{{ $item->phone ?? '—' }}</td>
                                    <td class="py-3 px-3">
                                        <div class="flex gap-2 justify-end">
                                            <a href="{{ route('employees.index') }}?tab=show&id={{ $item->id }}"
                                                class="px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200">
                                                View
                                            </a>
                                            <button x-data
                                                @click="$dispatch('open-modal', 'edit-employee-{{ $item->id }}')"
                                                class="px-3 py-1.5 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-md hover:bg-indigo-100">
                                                Edit
                                            </button>
                                            <form action="{{ route('employees.destroy', $item) }}" method="POST"
                                                onsubmit="return confirm('Delete this employee?')">
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
                                <x-modal name="edit-employee-{{ $item->id }}" focusable>
                                    <div class="p-6">
                                        <form action="{{ route('employees.update', $item) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            {{-- track which modal was open on error --}}
                                            <input type="hidden" name="_edit" value="{{ $item->id }}">

                                            <h2 class="text-lg font-semibold text-gray-900 mb-5">Edit Employee</h2>

                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">First
                                                        Name <span class="text-red-500">*</span></label>
                                                    <input type="text" name="firstname"
                                                        value="{{ old('firstname', $item->firstname) }}"
                                                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                        {{ $errors->has('firstname') ? 'border-red-400' : 'border-gray-300' }}">
                                                    @error('firstname')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Last
                                                        Name <span class="text-red-500">*</span></label>
                                                    <input type="text" name="lastname"
                                                        value="{{ old('lastname', $item->lastname) }}"
                                                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                        {{ $errors->has('lastname') ? 'border-red-400' : 'border-gray-300' }}">
                                                    @error('lastname')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Factory
                                                        <span class="text-red-500">*</span></label>
                                                    <select name="factory_id"
                                                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                        {{ $errors->has('factory_id') ? 'border-red-400' : 'border-gray-300' }}">
                                                        <option value="">-- Select Factory --</option>
                                                        @foreach ($factories as $f)
                                                            <option value="{{ $f->id }}"
                                                                {{ old('factory_id', $item->factory_id) == $f->id ? 'selected' : '' }}>
                                                                {{ $f->factory_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('factory_id')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                    <input type="email" name="email"
                                                        value="{{ old('email', $item->email) }}"
                                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                </div>

                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                                    <input type="text" name="phone"
                                                        value="{{ old('phone', $item->phone) }}"
                                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                </div>
                                            </div>

                                            <div class="flex gap-3 mt-6">
                                                <x-primary-button type="submit"
                                                    class="px-5 py-2 text-sm font-medium text-white rounded-lg">
                                                    Update Employee
                                                </x-primary-button>
                                                <x-secondary-button type="button" x-on:click="$dispatch('close')"
                                                    class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                                                    Cancel
                                                </x-secondary-button>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal>

                                {{-- Re-open this edit modal if it had a validation error --}}
                                @if ($errors->any() && old('_edit') == $item->id)
                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            window.dispatchEvent(new CustomEvent('open-modal', {
                                                detail: 'edit-employee-{{ $item->id }}'
                                            }));
                                        });
                                    </script>
                                @endif

                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-gray-400 text-sm">
                                        No employees yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>

            {{-- Create Modal --}}
            <x-modal name="create-employee" focusable>
                <form action="{{ route('employees.store') }}" method="POST" class="p-6">
                    @csrf
                    {{-- track create modal open on error --}}
                    <input type="hidden" name="_edit" value="create">

                    <h2 class="text-lg font-semibold text-gray-900 mb-5">Add Employee</h2>

                    <div class="space-y-4">
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

                    <div class="flex gap-3 mt-6">
                        <x-primary-button type="submit" class="px-5 py-2 text-sm font-medium text-white rounded-lg">
                            Save Employee
                        </x-primary-button>
                        <x-secondary-button type="button" x-on:click="$dispatch('close')"
                            class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Cancel
                        </x-secondary-button>
                    </div>
                </form>
            </x-modal>

            {{-- Re-open create modal if it had a validation error --}}
            @if ($errors->any() && old('_edit') === 'create')
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        window.dispatchEvent(new CustomEvent('open-modal', {
                            detail: 'create-employee'
                        }));
                    });
                </script>
            @endif

        @endif

    </div>
</x-app-layout>
