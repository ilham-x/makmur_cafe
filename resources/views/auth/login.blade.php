<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status 
        class="mb-4 p-3 bg-green-300 border-4 border-black font-bold shadow-[4px_4px_0px_black]" 
        :status="session('status')" 
    />

    <form method="POST" action="{{ route('login') }}" 
          class="max-w-md mx-auto p-6 bg-yellow-300 border-4 border-black shadow-[10px_10px_0px_black] -rotate-1">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block font-extrabold text-black mb-2 uppercase">
                Email
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required autofocus autocomplete="username"
                   class="w-full p-3 border-4 border-black bg-white text-black font-bold focus:outline-none shadow-[5px_5px_0px_black]" />
            @error('email')
                <p class="mt-2 bg-red-400 border-2 border-black px-2 py-1 font-bold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-6">
            <label for="password" class="block font-extrabold text-black mb-2 uppercase">
                Password
            </label>
            <input id="password"
                   type="password"
                   name="password"
                   required autocomplete="current-password"
                   class="w-full p-3 border-4 border-black bg-white text-black font-bold focus:outline-none shadow-[5px_5px_0px_black]" />
            @error('password')
                <p class="mt-2 bg-red-400 border-2 border-black px-2 py-1 font-bold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mt-6 flex items-center">
            <input id="remember_me"
                   type="checkbox"
                   name="remember"
                   class="w-5 h-5 border-4 border-black accent-black">
            <label for="remember_me" class="ml-3 font-extrabold text-black uppercase">
                Remember
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-8">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="font-bold underline border-2 border-black px-2 py-1 bg-green-200 hover:bg-black hover:text-white transition">
                    Forgot?
                </a>
            @endif

            <button type="submit"
                    class="px-6 py-3 bg-green-500 text-black font-extrabold border-4 border-black shadow-[5px_5px_0px_black] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">
                LOGIN
            </button>
        </div>
    </form>
</x-guest-layout>