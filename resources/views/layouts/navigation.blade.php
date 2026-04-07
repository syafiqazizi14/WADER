<nav x-data="{ open: false }" class="sidebar-nav">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('asset/Wader.png') }}" alt="WADER" class="sidebar-brand-logo">
        </a>
        <button @click="open = !open" class="sidebar-toggle md:hidden">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div :class="{'block': open, 'hidden': !open}" class="hidden md:block">
        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}" :class="{'sidebar-menu-item-active': request()->routeIs('dashboard')}" class="sidebar-menu-item">
                <span class="sidebar-menu-icon">📊</span>
                <span class="sidebar-menu-label">Dashboard</span>
            </a>
            <a href="{{ route('admin.sections.index') }}" :class="{'sidebar-menu-item-active': request()->routeIs('admin.sections.*')}" class="sidebar-menu-item">
                <span class="sidebar-menu-icon">🔲</span>
                <span class="sidebar-menu-label">Section</span>
            </a>
            <a href="{{ route('admin.statistik-mojokerto.index') }}" :class="{'sidebar-menu-item-active': request()->routeIs('admin.statistik-mojokerto.*')}" class="sidebar-menu-item">
                <span class="sidebar-menu-icon">📈</span>
                <span class="sidebar-menu-label">Statistik Mojokerto</span>
            </a>
            <a href="{{ route('admin.media.index') }}" :class="{'sidebar-menu-item-active': request()->routeIs('admin.media.*')}" class="sidebar-menu-item">
                <span class="sidebar-menu-icon">🖼️</span>
                <span class="sidebar-menu-label">Media</span>
            </a>
            <a href="{{ route('admin.chat-requests.index') }}" :class="{'sidebar-menu-item-active': request()->routeIs('admin.chat-requests.*')}" class="sidebar-menu-item">
                <span class="sidebar-menu-icon">💬</span>
                <span class="sidebar-menu-label">Histori Chat</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" :class="{'sidebar-menu-item-active': request()->routeIs('admin.settings.*')}" class="sidebar-menu-item">
                <span class="sidebar-menu-icon">⚙️</span>
                <span class="sidebar-menu-label">Pengaturan (Segera)</span>
            </a>
        </div>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <span>👤</span>
            <div class="sidebar-user-info">
                <div class="text-xs font-semibold text-slate-700">{{ Auth::user()->name }}</div>
                <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <div class="sidebar-actions">
            <a href="{{ route('profile.edit') }}" class="sidebar-action-btn" title="Profile">
                <span>⚙️</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="sidebar-action-btn" title="Logout">
                    <span>🚪</span>
                </button>
            </form>
        </div>
    </div>
</nav>
