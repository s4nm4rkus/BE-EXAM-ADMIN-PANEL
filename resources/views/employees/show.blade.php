<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Employees</h2>
    </x-slot>

    <div class="py-8 px-6 max-w-6xl mx-auto">

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

                <div>
                    <form action="{{ route('employees.edit', $employee) }}" method="POST">
                        @csrf
                        @method('GET')
                        <x-primary-button>
                            Edit Employee
                        </x-primary-button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
