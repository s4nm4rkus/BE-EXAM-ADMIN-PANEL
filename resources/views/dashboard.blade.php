<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-6xl mx-auto space-y-6">

        {{-- Welcome --}}
        <div class="bg-white rounded-xl border border-gray-200 px-6 py-5">
            <h3 class="text-sm font-semibold text-gray-900">Welcome back, {{ auth()->user()->name }} 👋</h3>
            <p class="text-sm text-gray-500 mt-0.5">Here's a quick overview of your system.</p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 gap-4">

            <div class="bg-white rounded-xl border border-gray-200 p-6 flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Total Factories</p>
                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Factory::count() }}</p>
                    <a href="{{ route('factories.index') }}"
                        class="inline-block mt-3 text-xs font-medium text-indigo-600 hover:underline">
                        View all →
                    </a>
                </div>
                <div class="p-2 bg-indigo-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Total Employees</p>
                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Employee::count() }}</p>
                    <a href="{{ route('employees.index') }}"
                        class="inline-block mt-3 text-xs font-medium text-indigo-600 hover:underline">
                        View all →
                    </a>
                </div>
                <div class="p-2 bg-indigo-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
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
                        class="text-xs font-medium text-indigo-600 hover:underline">
                        View all
                    </a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse (\App\Models\Factory::latest()->take(5)->get() as $factory)
                        <div class="px-6 py-3 flex justify-between items-center hover:bg-gray-50 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $factory->factory_name }}</p>
                                <p class="text-xs text-gray-400">{{ $factory->location }}</p>
                            </div>
                            <span class="text-xs text-gray-400 whitespace-nowrap ml-4">
                                {{ $factory->created_at->diffForHumans() }}
                            </span>
                        </div>
                    @empty
                        <div class="px-6 py-6 text-center text-sm text-gray-400">
                            No factories yet.
                        </div>
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
                        class="text-xs font-medium text-indigo-600 hover:underline">
                        View all
                    </a>
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
                            <span class="text-xs text-gray-400 whitespace-nowrap ml-4">
                                {{ $employee->created_at->diffForHumans() }}
                            </span>
                        </div>
                    @empty
                        <div class="px-6 py-6 text-center text-sm text-gray-400">
                            No employees yet.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
