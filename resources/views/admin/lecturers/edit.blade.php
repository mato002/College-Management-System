<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Lecturer</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="post" action="{{ route('admin.lecturers.update', $lecturer) }}">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" class="block mt-1 w-full" value="{{ old('name', $lecturer->user->name) }}" required />
                        </div>
                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" value="{{ old('email', $lecturer->user->email) }}" required />
                        </div>
                        <div>
                            <x-input-label for="employee_id" value="Employee ID" />
                            <x-text-input id="employee_id" name="employee_id" class="block mt-1 w-full" value="{{ old('employee_id', $lecturer->employee_id) }}" required />
                        </div>
                        <div>
                            <x-input-label for="phone" value="Phone" />
                            <x-text-input id="phone" name="phone" class="block mt-1 w-full" value="{{ old('phone', $lecturer->phone) }}" />
                        </div>
                        <div>
                            <x-input-label for="department" value="Department" />
                            <x-text-input id="department" name="department" class="block mt-1 w-full" value="{{ old('department', $lecturer->department) }}" />
                        </div>
                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" class="block mt-1 w-full" value="{{ old('title', $lecturer->title) }}" />
                        </div>
                    </div>
                    <div class="mt-6 flex gap-2">
                        <x-primary-button>Update</x-primary-button>
                        <a href="{{ route('admin.lecturers.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
