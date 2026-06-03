<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-6xl mx-auto space-y-6">

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 gap-4">

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Total Factories</p>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Factory::count() }}</p>
                <a href="{{ route('factories.index') }}"
                    class="inline-block mt-3 text-xs font-medium text-indigo-600 hover:underline">
                    View all →
                </a>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Total Employees</p>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Employee::count() }}</p>
                <a href="{{ route('employees.index') }}"
                    class="inline-block mt-3 text-xs font-medium text-indigo-600 hover:underline">
                    View all →
                </a>
            </div>

        </div>

        {{-- Recent Activity --}}
        <div class="grid grid-cols-2 gap-4">

            {{-- Recent Factories --}}
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 pt-5 pb-4 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Recent Factories</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Last 5 added</p>
                    </div>
                    <a href="{{ route('factories.index') }}"
                        class="text-xs font-medium text-indigo-600 hover:underline">View all</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse (\App\Models\Factory::latest()->take(5)->get() as $factory)
                        <div class="px-6 py-3 flex justify-between items-center hover:bg-gray-50 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $factory->factory_name }}</p>
                                <p class="text-xs text-gray-400">{{ $factory->location }}</p>
                            </div>
                            <span class="text-xs text-gray-400">
                                {{ $factory->created_at->diffForHumans() }}
                            </span>
                        </div>
                    @empty
                        <div class="px-6 py-6 text-center text-sm text-gray-400">No factories yet.</div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Employees --}}
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 pt-5 pb-4 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Recent Employees</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Last 5 added</p>
                    </div>
                    <a href="{{ route('employees.index') }}"
                        class="text-xs font-medium text-indigo-600 hover:underline">View all</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse (\App\Models\Employee::with('factory')->latest()->take(5)->get() as $employee)
                        <div class="px-6 py-3 flex justify-between items-center hover:bg-gray-50 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $employee->firstname }} {{ $employee->lastname }}
                                </p>
                                <p class="text-xs text-gray-400">{{ $employee->factory->factory_name ?? '—' }}</p>
                            </div>
                            <span class="text-xs text-gray-400">
                                {{ $employee->created_at->diffForHumans() }}
                            </span>
                        </div>
                    @empty
                        <div class="px-6 py-6 text-center text-sm text-gray-400">No employees yet.</div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
