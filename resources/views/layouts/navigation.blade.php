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

        .sidebar-nav .sidebar-menu-icon-image {
            width: 30px;
            height: 30px;
            object-fit: contain;
            display: block;
        }

        .sidebar-nav .sidebar-menu-item-active .sidebar-menu-icon-image {
            transform: scale(1.05);
        }

        .sidebar-nav .sidebar-active-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #0284c7;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.18);
            margin-left: 0.35rem;
            flex-shrink: 0;
        }
    </style>

    @php
        $isDashboardActive = request()->routeIs('dashboard') || request()->routeIs('admin.dashboard');
        $isSectionsActive = request()->routeIs('admin.sections.*');
        $isMediaActive = request()->routeIs('admin.media.*');
        $isChatActive = request()->routeIs('admin.chat-requests.*');
        $isSettingsActive = request()->routeIs('admin.settings.*');

        $hasAnyActive = $isDashboardActive || $isSectionsActive || $isMediaActive || $isChatActive || $isSettingsActive;

        if (! $hasAnyActive) {
            $isDashboardActive = true;
        }
    @endphp

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
            <a href="{{ route('dashboard') }}" class="sidebar-menu-item {{ $isDashboardActive ? 'sidebar-menu-item-active' : '' }}">
                <span class="sidebar-menu-icon">
                    <img src="{{ asset('asset/dashboard.png') }}" alt="Dashboard" class="sidebar-menu-icon-image">
                </span>
                <span class="sidebar-menu-label">Dashboard</span>
                @if ($isDashboardActive)
                    <span class="sidebar-active-dot" aria-hidden="true"></span>
                @endif
            </a>
            <a href="{{ route('admin.sections.index') }}" class="sidebar-menu-item {{ $isSectionsActive ? 'sidebar-menu-item-active' : '' }}">
                <span class="sidebar-menu-icon">
                    <img src="{{ asset('asset/section.png') }}" alt="Section" class="sidebar-menu-icon-image">
                </span>
                <span class="sidebar-menu-label">Section</span>
                @if ($isSectionsActive)
                    <span class="sidebar-active-dot" aria-hidden="true"></span>
                @endif
            </a>
            <a href="{{ route('admin.media.index') }}" class="sidebar-menu-item {{ $isMediaActive ? 'sidebar-menu-item-active' : '' }}">
                <span class="sidebar-menu-icon">
                    <img src="{{ asset('asset/media.png') }}" alt="Media" class="sidebar-menu-icon-image">
                </span>
                <span class="sidebar-menu-label">Media</span>
                @if ($isMediaActive)
                    <span class="sidebar-active-dot" aria-hidden="true"></span>
                @endif
            </a>
            <a href="{{ route('admin.chat-requests.index') }}" class="sidebar-menu-item {{ $isChatActive ? 'sidebar-menu-item-active' : '' }}">
                <span class="sidebar-menu-icon">
                    <img src="{{ asset('asset/history chat.png') }}" alt="Histori Chat" class="sidebar-menu-icon-image">
                </span>
                <span class="sidebar-menu-label">Histori Chat</span>
                @if ($isChatActive)
                    <span class="sidebar-active-dot" aria-hidden="true"></span>
                @endif
            </a>
            <a href="{{ route('admin.settings.index') }}" class="sidebar-menu-item {{ $isSettingsActive ? 'sidebar-menu-item-active' : '' }}">
                <span class="sidebar-menu-icon">
                    <img src="{{ asset('asset/settings.png') }}" alt="Pengaturan" class="sidebar-menu-icon-image">
                </span>
                <span class="sidebar-menu-label">Pengaturan (Segera)</span>
                @if ($isSettingsActive)
                    <span class="sidebar-active-dot" aria-hidden="true"></span>
                @endif
            </a>
        </div>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <img src="{{ asset('asset/admin.png') }}" alt="Admin" class="sidebar-menu-icon-image">
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
                    <img src="{{ asset('asset/logout.png') }}" alt="Logout" class="sidebar-menu-icon-image">
                </button>
            </form>
        </div>
    </div>
</nav>
