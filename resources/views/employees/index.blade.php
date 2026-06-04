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

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

            <div class="px-6 pt-6 pb-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Employees</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Manage your employee records</p>
                </div>
                <form action="{{ route('employees.create') }}" method="GET">
                    <x-primary-button>
                        + Add Employee
                    </x-primary-button>
                </form>
            </div>

            <div class="p-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Name</th>
                            <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Factory</th>
                            <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Email</th>
                            <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Phone</th>
                            <th class="text-right py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wide">
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
                                        <a href="{{ route('employees.show', $item) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200">
                                            View
                                        </a>
                                        <a href="{{ route('employees.edit', $item) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-md hover:bg-indigo-100">
                                            Edit
                                        </a>
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

    </div>
</x-app-layout>
