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

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

            <div class="px-6 pt-6 pb-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Factories</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Manage your factory records</p>
                </div>

                <form action="{{ route('factories.create') }}" method="GET">
                    <x-primary-button>
                        + Add Factory
                    </x-primary-button>
                </form>
            </div>

            <div class="p-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr>
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
                        </tr>
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
                                        <a href="{{ route('factories.show', $item) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200">
                                            <x-icon.eye />
                                        </a>
                                        <a href="{{ route('factories.edit', $item) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-md hover:bg-indigo-100">
                                            <x-icon.pencil />
                                        </a>
                                        <form action="{{ route('factories.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Delete this factory?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded-md hover:bg-red-100">
                                                <x-icon.trash />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-400 text-sm">
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

    </div>
</x-app-layout>
