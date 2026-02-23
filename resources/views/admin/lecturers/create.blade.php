<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Lecturer</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="post" action="{{ route('admin.lecturers.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" class="block mt-1 w-full" value="{{ old('name') }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" value="{{ old('email') }}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" name="password" type="password" class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" value="Confirm Password" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full" required />
                        </div>
                        <div>
                            <x-input-label for="employee_id" value="Employee ID" />
                            <x-text-input id="employee_id" name="employee_id" class="block mt-1 w-full" value="{{ old('employee_id') }}" required />
                            <x-input-error :messages="$errors->get('employee_id')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="phone" value="Phone" />
                            <x-text-input id="phone" name="phone" class="block mt-1 w-full" value="{{ old('phone') }}" />
                        </div>
                        <div>
                            <x-input-label for="department" value="Department" />
                            <x-text-input id="department" name="department" class="block mt-1 w-full" value="{{ old('department') }}" />
                        </div>
                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" class="block mt-1 w-full" value="{{ old('title') }}" />
                        </div>
                    </div>
                    <div class="mt-6 flex gap-2">
                        <x-primary-button>Create Lecturer</x-primary-button>
                        <a href="{{ route('admin.lecturers.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
