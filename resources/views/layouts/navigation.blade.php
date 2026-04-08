<nav x-data="{ open: false }" class="sidebar-nav">
    <style>
        .sidebar-nav .sidebar-header {
            position: relative !important;
        }

        .sidebar-nav .sidebar-brand {
            position: absolute !important;
            left: 50% !important;
            top: 50% !important;
            transform: translate(-50%, -50%) !important;
            flex: none !important;
        }

        .sidebar-nav .sidebar-brand:hover {
            transform: translate(-50%, -50%) scale(1.02) !important;
        }

        .sidebar-nav .sidebar-brand-logo {
            width: 170px !important;
            max-width: 170px !important;
            min-width: 170px !important;
            height: auto !important;
            display: block !important;
            transform: none !important;
            transform-origin: center center;
        }

        .sidebar-nav .sidebar-action-logout {
            width: 100% !important;
            min-height: 56px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0.9rem 1rem !important;
            border: 1px solid rgba(244, 114, 182, 0.35) !important;
            border-radius: 12px !important;
            background: rgba(244, 114, 182, 0.18) !important;
            color: #be185d !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
        }

        .sidebar-nav .sidebar-action-logout:hover {
            background: #b91c1c !important;
            border-color: #7f1d1d !important;
            color: #ffffff !important;
            transform: translateY(-1px) !important;
        }

        .sidebar-nav .sidebar-action-logout:hover svg {
            stroke: #ffffff !important;
        }
    </style>
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
            <form method="POST" action="{{ route('logout') }}" style="display: block; width: 100%;">
                @csrf
                <button
                    type="submit"
                    class="sidebar-action-btn sidebar-action-logout"
                    title="Logout"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/><path d="M21 3v18"/></svg>
                </button>
            </form>
        </div>
    </div>
</nav>
