@props(['disabled' => false, 'id' => ''])

<div class="password-input-wrapper">
    <input 
        @disabled($disabled) 
        {{ $attributes->merge(['class' => 'border-slate-300 bg-white/90 text-slate-900 placeholder:text-slate-400 rounded-xl shadow-sm focus:border-sky-500 focus:ring-sky-500 pr-10']) }}
        type="password"
        data-password-input
    >
    <button 
        type="button" 
        class="password-toggle-btn"
        data-password-toggle
        onclick="togglePasswordVisibility(this)"
        tabindex="-1"
    >
        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        </svg>
        <svg class="eye-off-icon hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
            <line x1="1" y1="1" x2="23" y2="23"></line>
        </svg>
    </button>
</div>

<style>
.password-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.password-input-wrapper input {
    width: 100%;
    padding-right: 2.5rem; /* Make space for eye icon */
}

.password-toggle-btn {
    position: absolute;
    right: 0.75rem;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    transition: color 200ms ease;
    flex-shrink: 0;
}

.password-toggle-btn:hover {
    color: #475569;
}

.password-toggle-btn:focus {
    outline: none;
    color: #0ea5e9;
}

.eye-icon,
.eye-off-icon {
    width: 20px;
    height: 20px;
}

.eye-icon.hidden,
.eye-off-icon.hidden {
    display: none;
}
</style>

<script>
function togglePasswordVisibility(button) {
    // Cari input password terdekat
    const inputWrapper = button.closest('.password-input-wrapper');
    const passwordInput = inputWrapper.querySelector('[data-password-input]');
    const eyeIcon = inputWrapper.querySelector('.eye-icon');
    const eyeOffIcon = inputWrapper.querySelector('.eye-off-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.add('hidden');
        eyeOffIcon.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('hidden');
        eyeOffIcon.classList.add('hidden');
    }
}
</script>
