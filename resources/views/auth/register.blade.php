<x-guest-layout>
    @php
        $logoHeader = asset('asset/logo bps.png');
    @endphp

    <div class="auth-minimal-shell">
        <div class="auth-minimal-overlay"></div>

        <div class="auth-minimal-card auth-register-card">
            <div class="auth-minimal-brand">
                <img src="{{ $logoHeader }}" alt="BPS Kabupaten Mojokerto" class="auth-minimal-logo">
                <h1 class="auth-minimal-title">Buat Akun Baru</h1>
                <p class="auth-minimal-subtitle">Isi data di bawah untuk mendaftarkan akun admin.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-minimal-form">
                @csrf

                <div class="auth-minimal-field">
                    <label for="username">Username</label>
                    <x-text-input id="username" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Username akun" />
                    <x-input-error :messages="$errors->get('username')" class="form-error" />
                </div>

                <div class="auth-minimal-field">
                    <label for="email">Email</label>
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Email aktif" />
                    <x-input-error :messages="$errors->get('email')" class="form-error" />
                </div>

                <div class="auth-minimal-field">
                    <label for="password">Password</label>
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Buat password" />
                    <x-input-error :messages="$errors->get('password')" class="form-error" />
                </div>

                <div class="auth-minimal-field">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="form-error" />
                </div>

                <button type="submit" class="auth-minimal-submit">Daftar</button>

                <div class="auth-minimal-footer-link">
                    <span>Sudah punya akun?</span>
                    <a href="{{ route('login') }}">Kembali ke login</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
