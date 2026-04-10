<x-guest-layout>
    @php
        $logoHeader = asset('asset/iconwader.png');
    @endphp

    <div class="auth-minimal-shell">
        <div class="auth-minimal-overlay"></div>

        <div class="auth-minimal-card">
            <div class="auth-minimal-brand">
                <img src="{{ $logoHeader }}" alt="WADER" class="auth-minimal-logo">
                <h1 class="auth-minimal-title">ADMIN WADER</h1>
            </div>

            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="auth-minimal-form">
                @csrf

                <div class="auth-minimal-field">
                    <label for="email">Email/Username</label>
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Email/Username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="form-error" />
                </div>

                <div class="auth-minimal-field" x-data="{ showPassword: false }">
                    <label for="password">Password</label>

                    <div style="position: relative; display: block; width: 100%;">
                        <x-text-input
                            id="password"
                            x-bind:type="showPassword ? 'text' : 'password'"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Password"
                            style="padding-right: 2.9rem;"
                        />
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            :aria-label="showPassword ? 'Sembunyikan password' : 'Tampilkan password'"
                            style="position: absolute; right: 0.7rem; top: 50%; transform: translateY(-50%); width: 1.75rem; height: 1.75rem; border: 0; background: transparent; color: #64748b; display: inline-flex; align-items: center; justify-content: center; padding: 0; cursor: pointer;"
                        >
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" x-cloak xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.042-3.368m2.11-1.787A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.964 9.964 0 01-4.206 5.018M15 12a3 3 0 00-4.12-2.784M3 3l18 18" />
                            </svg>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="form-error" />
                </div>

                <label for="remember_me" class="auth-minimal-remember">
                    <input id="remember_me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Simpan Login</span>
                </label>

                <button type="submit" class="auth-minimal-submit">Log in</button>
            </form>
        </div>
    </div>
</x-guest-layout>

