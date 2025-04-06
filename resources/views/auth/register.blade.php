<head><script src="https://cdn.tailwindcss.com"></script></head>

    <div class="min-h-screen flex flex-col justify-center items-center bg-blue-50 px-4">
        <!-- Header -->
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-semibold text-blue-700 flex items-center justify-center gap-2">
            <h1 class="text-4xl font-bold text-blue-800">📚 BookHub</h1>
            </h1>
            <p class="text-gray-600 mt-1 text-sm">Create your free account</p>
        </div>

        <!-- Card -->
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-md border border-blue-100">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" class="text-blue-800" />
                    <x-text-input id="name" class="block mt-1 w-full bg-white border border-blue-200 text-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-500" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-blue-800" />
                    <x-text-input id="email" class="block mt-1 w-full bg-white border border-blue-200 text-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500" />
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <x-input-label for="phone" :value="__('Phone')" class="text-blue-800" />
                    <x-text-input id="phone" class="block mt-1 w-full bg-white border border-blue-200 text-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-1 text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-blue-800" />
                    <x-text-input id="password" class="block mt-1 w-full bg-white border border-blue-200 text-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-blue-800" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full bg-white border border-blue-200 text-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 rounded-md shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-500" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <a class="text-sm text-blue-500 hover:underline" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md shadow">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


