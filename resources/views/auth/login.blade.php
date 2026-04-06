<x-guest-layout>
    @php
        $logoHeader = asset('asset/logo bps.png');
    @endphp

    <div class="auth-minimal-shell">
        <div class="auth-minimal-overlay"></div>

        <div class="auth-minimal-card">
            <div class="auth-minimal-brand">
                <img src="{{ $logoHeader }}" alt="BPS Kabupaten Mojokerto" class="auth-minimal-logo">
                <h1 class="auth-minimal-title">BPS Kabupaten Mojokerto</h1>
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

                <div class="auth-minimal-field">
                    <label for="password">Password</label>
                    <x-password-input
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Password"
                    />
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
