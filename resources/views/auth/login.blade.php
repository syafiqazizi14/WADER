<x-guest-layout>
    <div class="auth-container">
        <!-- Left Panel -->
        <div class="auth-left-panel">
            <div class="auth-branding">
                <h1 class="auth-brand-title">WADER</h1>
                <p class="auth-brand-subtitle">Admin Dashboard</p>
            </div>
            
            <div class="auth-welcome">
                <h2 class="auth-welcome-title">Selamat Datang Kembali</h2>
                <p class="auth-welcome-text">Kelola konten WADER dengan mudah dan efisien melalui dashboard admin yang intuitif dan powerful.</p>
            </div>

            <div class="auth-features">
                <div class="auth-feature-item">
                    <span class="auth-feature-icon">📊</span>
                    <div>
                        <p class="auth-feature-title">Dashboard Analytics</p>
                        <p class="auth-feature-desc">Monitor semua aktivitas sistem real-time</p>
                    </div>
                </div>
                <div class="auth-feature-item">
                    <span class="auth-feature-icon">📄</span>
                    <div>
                        <p class="auth-feature-title">Manajemen Konten</p>
                        <p class="auth-feature-desc">Kelola halaman, section, dan media</p>
                    </div>
                </div>
                <div class="auth-feature-item">
                    <span class="auth-feature-icon">🔒</span>
                    <div>
                        <p class="auth-feature-title">Keamanan Terjamin</p>
                        <p class="auth-feature-desc">Enkripsi end-to-end untuk data Anda</p>
                    </div>
                </div>
            </div>

            <div class="auth-footer-text">
                <p>© 2026 WADER. Platform Admin Management.</p>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="auth-right-panel">
            <div class="auth-form-wrapper">
                <div class="auth-form-header">
                    <h2 class="auth-form-title">Masuk Akun Admin</h2>
                    <p class="auth-form-subtitle">Gunakan kredensial Anda untuk akses panel admin</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="auth-form">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <span class="form-label-icon">📧</span>
                            Email Address
                        </label>
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="admin@wader.local"
                            class="form-input"
                        />
                        <x-input-error :messages="$errors->get('email')" class="form-error" />
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <span class="form-label-icon">🔐</span>
                            Password
                        </label>
                        <div class="password-input-wrapper">
                            <x-text-input
                                id="password"
                                type="password"
                                name="password"
                                required 
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="form-input"
                            />
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility()">
                                <span id="password-toggle-icon">👁️</span>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="form-error" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-checkbox">
                        <input id="remember_me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                        <label for="remember_me" class="form-checkbox-label">Ingat saya di perangkat ini</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-lg w-full">
                        <span>🚀</span> Masuk Sekarang
                    </button>

                    <!-- Forgot Password Link -->
                    @if (Route::has('password.request'))
                        <div class="form-footer">
                            <a href="{{ route('password.request') }}" class="form-link">
                                ❓ Lupa password?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }
    </script>
</x-guest-layout>
