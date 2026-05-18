<aside class="flex flex-col h-screen w-64 bg-slate-900 text-slate-300 border-r border-slate-800">

    <div class="px-6 py-6 border-b border-slate-800">
        <h2 class="text-xl font-bold text-white tracking-wide">Kos Admin</h2>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        
        <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->is('dashboard*') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <svg class="w-5 h-5 {{ request()->is('dashboard*') ? 'opacity-100' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="/penghuni" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->is('penghuni*') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <svg class="w-5 h-5 {{ request()->is('penghuni*') ? 'opacity-100' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span>Penghuni</span>
        </a>

        <a href="/kamar" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->is('kamar*') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <svg class="w-5 h-5 {{ request()->is('kamar*') ? 'opacity-100' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span>Kamar</span>
        </a>

        <a href="/pembayaran" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->is('pembayaran*') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <svg class="w-5 h-5 {{ request()->is('pembayaran*') ? 'opacity-100' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <span>Pembayaran</span>
        </a>

    </nav>

    <div class="p-4 border-t border-slate-800 mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-lg text-sm font-medium text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>

</aside>