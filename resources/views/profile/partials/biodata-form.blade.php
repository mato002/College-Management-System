<section>
    <header>
        <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa-solid fa-clipboard-user text-sm"></i></span>
            {{ __('Biodata') }}
            <span class="rounded-full bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-800">Required by college</span>
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Complete your biodata as required by the institution. All fields marked with * are mandatory.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.biodata.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <x-input-label for="phone" :value="__('Phone number')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $biodata->phone)" required placeholder="e.g. +254 700 000 000" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
            <div>
                <x-input-label for="phone_alt" :value="__('Alternate phone (optional)')" />
                <x-text-input id="phone_alt" name="phone_alt" type="text" class="mt-1 block w-full" :value="old('phone_alt', $biodata->phone_alt)" placeholder="e.g. +254 711 000 000" />
                <x-input-error class="mt-2" :messages="$errors->get('phone_alt')" />
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <x-input-label for="date_of_birth" :value="__('Date of birth')" />
                <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $biodata->date_of_birth?->format('Y-m-d'))" required />
                <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
            </div>
            <div>
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender" name="gender" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="">— Select —</option>
                    <option value="male" {{ old('gender', $biodata->gender) === 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('gender', $biodata->gender) === 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                    <option value="other" {{ old('gender', $biodata->gender) === 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <x-input-label for="nationality" :value="__('Nationality')" />
                <x-text-input id="nationality" name="nationality" type="text" class="mt-1 block w-full" :value="old('nationality', $biodata->nationality)" required placeholder="e.g. Kenyan" />
                <x-input-error class="mt-2" :messages="$errors->get('nationality')" />
            </div>
            <div>
                <x-input-label for="id_number" :value="__('ID / Passport number (optional)')" />
                <x-text-input id="id_number" name="id_number" type="text" class="mt-1 block w-full" :value="old('id_number', $biodata->id_number)" placeholder="National ID or passport" />
                <x-input-error class="mt-2" :messages="$errors->get('id_number')" />
            </div>
        </div>

        <div>
            <x-input-label for="address_line1" :value="__('Address line 1')" />
            <x-text-input id="address_line1" name="address_line1" type="text" class="mt-1 block w-full" :value="old('address_line1', $biodata->address_line1)" required placeholder="Street, building, P.O. Box" />
            <x-input-error class="mt-2" :messages="$errors->get('address_line1')" />
        </div>

        <div>
            <x-input-label for="address_line2" :value="__('Address line 2 (optional)')" />
            <x-text-input id="address_line2" name="address_line2" type="text" class="mt-1 block w-full" :value="old('address_line2', $biodata->address_line2)" placeholder="Apartment, suite, etc." />
            <x-input-error class="mt-2" :messages="$errors->get('address_line2')" />
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <x-input-label for="city" :value="__('City / Town')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $biodata->city)" required />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>
            <div>
                <x-input-label for="state" :value="__('State / County (optional)')" />
                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $biodata->state)" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>
            <div>
                <x-input-label for="postal_code" :value="__('Postal code (optional)')" />
                <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $biodata->postal_code)" />
                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
            </div>
            <div>
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $biodata->country ?? 'Kenya')" required placeholder="e.g. Kenya" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>
        </div>

        <div class="rounded-lg border border-gray-200 bg-gray-50/50 p-4">
            <h3 class="text-sm font-medium text-gray-900">{{ __('Emergency contact') }}</h3>
            <p class="mt-0.5 text-xs text-gray-600">{{ __('Someone we can contact in case of emergency.') }}</p>
            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <x-input-label for="emergency_contact_name" :value="__('Full name')" />
                    <x-text-input id="emergency_contact_name" name="emergency_contact_name" type="text" class="mt-1 block w-full" :value="old('emergency_contact_name', $biodata->emergency_contact_name)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_name')" />
                </div>
                <div>
                    <x-input-label for="emergency_contact_phone" :value="__('Phone number')" />
                    <x-text-input id="emergency_contact_phone" name="emergency_contact_phone" type="text" class="mt-1 block w-full" :value="old('emergency_contact_phone', $biodata->emergency_contact_phone)" required placeholder="e.g. +254 700 000 000" />
                    <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_phone')" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save biodata') }}</x-primary-button>
            @if(isset($biodata->id) && $biodata->isComplete())
                <span class="text-sm text-green-600">✓ Biodata complete</span>
            @endif
        </div>
    </form>
</section>
