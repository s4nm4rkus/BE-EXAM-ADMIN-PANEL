<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Factories</h2>
    </x-slot>

    <div class="py-8 px-6 max-w-6xl mx-auto">

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
                    <form action="{{ route('factories.edit', $factory) }}" method="POST">
                        @csrf
                        @method('GET')
                        <x-primary-button>
                            Edit Factory
                        </x-primary-button>
                    </form>
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

    </div>
</x-app-layout>
