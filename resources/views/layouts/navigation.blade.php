<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed z-30 inset-y-0 left-0 w-72 transition duration-300 transform bg-sidebar overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 border-r border-gray-800 font-sans">

    <div class="flex items-center justify-center mt-8 pb-6">
        <div class="flex flex-col items-center gap-2">
            <div
                class="bg-white p-1 rounded-full h-16 w-16 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <i class="fa-solid fa-hospital text-indigo-600 text-3xl"></i>
            </div>
            <span class="text-white text-lg font-bold tracking-wider mt-2">RSUD HBK</span>
        </div>
    </div>

    <nav class="mt-4 px-4 pb-20 space-y-4">

        <div>
            <a href="{{ route('dashboard') }}"
                class="flex items-center w-full py-3 px-4 rounded-xl transition-all duration-200 
               {{ request()->routeIs('dashboard') ? 'menu-header-active' : 'text-gray-400 hover:text-white' }}">
                <span class="w-8"><i class="fa-solid fa-gauge-high text-lg"></i></span>
                <span class="mx-1 text-sm font-medium">Dashboard System</span>
            </a>
        </div>

        <div x-data="{ open: {{ request()->is('master*') || request()->routeIs('users.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center w-full py-3 px-4 transition-all duration-300 group rounded-xl relative overflow-hidden"
                :class="open ? 'menu-header-active shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:text-white'">

                <span class="w-8 relative z-10"><i class="fa-solid fa-city text-lg"></i></span>
                <span class="mx-1 text-sm font-medium relative z-10">Master Data</span>
                <i class="fa-solid fa-chevron-down text-xs ml-auto transition-transform duration-300 relative z-10"
                    :class="{ 'rotate-180': open }"></i>
            </button>

            <div x-show="open" x-collapse class="mt-2 ml-4 pl-0 border-l-2 border-gray-700 space-y-1">

                <div class="relative pl-2">
                    <a href="{{ route('users.index') }}"
                        class="flex items-center py-3 pl-4 pr-4 transition-all duration-200 text-sm font-medium
                       {{ request()->routeIs('users.*') ? 'fluid-active' : 'text-gray-400 hover:text-gray-200' }}">
                        <span class="w-6"><i class="fa-solid fa-users-gear"></i></span>
                        <span>Data Pengguna</span>
                    </a>
                </div>

                <div class="relative pl-2">
                    <a href="{{ route('ruangan.index') }}"
                        class="flex items-center py-3 pl-4 pr-4 transition-all duration-200 text-sm font-medium
                       {{ request()->routeIs('ruangan.*') ? 'fluid-active' : 'text-gray-400 hover:text-gray-200' }}">
                        <span class="w-6"><i class="fa-solid fa-hospital-user"></i></span>
                        <span>Ruangan</span>
                    </a>
                </div>

                <div class="relative pl-2">
                    <a href="{{ route('barang.index') }}"
                        class="flex items-center py-3 pl-4 pr-4 transition-all duration-200 text-sm font-medium
                       {{ request()->routeIs('barang.*') ? 'fluid-active' : 'text-gray-400 hover:text-gray-200' }}">
                        <span class="w-6"><i class="fa-solid fa-box"></i></span>
                        <span>Barang</span>
                    </a>
                </div>

                <div class="relative pl-2">
                    <a href="{{ route('barang-gudang.index') }}"
                        class="flex items-center py-3 pl-4 pr-4 transition-all duration-200 text-sm font-medium
                       {{ request()->routeIs('barang-gudang.*') ? 'fluid-active' : 'text-gray-400 hover:text-gray-200' }}">
                        <span class="w-6"><i class="fa-solid fa-boxes-stacked"></i></span>
                        <span>Barang Gudang</span>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <a href="{{ route('inventaris.index') }}"
                class="flex items-center w-full py-3 px-4 rounded-xl transition-all duration-200 
               {{ request()->routeIs('inventaris.*') ? 'menu-header-active' : 'text-gray-400 hover:text-white' }}">
                <span class="w-8"><i class="fa-solid fa-clipboard-list text-lg"></i></span>
                <span class="mx-1 text-sm font-medium">Inventaris Barang</span>
            </a>
        </div>

        <div x-data="{ open: {{ request()->is('gudang*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center w-full py-3 px-4 transition-all duration-300 group rounded-xl relative"
                :class="open ? 'menu-header-active shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:text-white'">
                <span class="w-8 relative z-10"><i class="fa-solid fa-warehouse text-lg"></i></span>
                <span class="mx-1 text-sm font-medium relative z-10">Gudang</span>
                <i class="fa-solid fa-chevron-down text-xs ml-auto transition-transform duration-300 relative z-10"
                    :class="{ 'rotate-180': open }"></i>
            </button>

            <div x-show="open" x-collapse class="mt-2 ml-4 pl-0 border-l-2 border-gray-700 space-y-1">
                <div class="relative pl-2">
                    <a href="#"
                        class="flex items-center py-3 pl-4 pr-4 transition-all duration-200 text-sm font-medium text-gray-400 hover:text-gray-200">
                        <span class="w-6"><i class="fa-solid fa-layer-group"></i></span>
                        <span>Stok Gudang</span>
                    </a>
                </div>
                <div class="relative pl-2">
                    <a href="#"
                        class="flex items-center py-3 pl-4 pr-4 transition-all duration-200 text-sm font-medium text-gray-400 hover:text-gray-200">
                        <span class="w-6"><i class="fa-solid fa-download"></i></span>
                        <span>Barang Masuk</span>
                    </a>
                </div>
                <div class="relative pl-2">
                    <a href="#"
                        class="flex items-center py-3 pl-4 pr-4 transition-all duration-200 text-sm font-medium text-gray-400 hover:text-gray-200">
                        <span class="w-6"><i class="fa-solid fa-upload"></i></span>
                        <span>Barang Keluar</span>
                    </a>
                </div>
            </div>
        </div>

        <div x-data="{ open: {{ request()->is('perbaikan*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center w-full py-3 px-4 transition-all duration-300 group rounded-xl relative"
                :class="open ? 'menu-header-active shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:text-white'">
                <span class="w-8 relative z-10"><i class="fa-solid fa-screwdriver-wrench text-lg"></i></span>
                <span class="mx-1 text-sm font-medium relative z-10">Perbaikan</span>
                <i class="fa-solid fa-chevron-down text-xs ml-auto transition-transform duration-300 relative z-10"
                    :class="{ 'rotate-180': open }"></i>
            </button>

            <div x-show="open" x-collapse class="mt-2 ml-4 pl-0 border-l-2 border-gray-700 space-y-1">
                <div class="relative pl-2">
                    <a href="#"
                        class="flex items-center py-3 pl-4 pr-4 text-gray-400 hover:text-gray-200 transition-all duration-200 text-sm font-medium">
                        <span class="w-6"><i class="fa-solid fa-rotate"></i></span>
                        <span>Permintaan</span>
                    </a>
                </div>
                <div class="relative pl-2">
                    <a href="#"
                        class="flex items-center py-3 pl-4 pr-4 text-gray-400 hover:text-gray-200 transition-all duration-200 text-sm font-medium">
                        <span class="w-6"><i class="fa-solid fa-hammer"></i></span>
                        <span>Tindakan</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="space-y-1 pt-2">
            <a href="#"
                class="flex items-center w-full py-3 px-4 rounded-xl transition-all duration-200 text-gray-400 hover:text-white">
                <span class="w-8"><i class="fa-solid fa-handshake text-lg"></i></span>
                <span class="mx-1 text-sm font-medium">Serah Terima</span>
            </a>

            <a href="#"
                class="flex items-center w-full py-3 px-4 rounded-xl transition-all duration-200 text-gray-400 hover:text-white">
                <span class="w-8"><i class="fa-solid fa-circle-exclamation text-lg"></i></span>
                <span class="mx-1 text-sm font-medium">Barang Rusak Berat</span>
            </a>

            <a href="#"
                class="flex items-center w-full py-3 px-4 rounded-xl transition-all duration-200 text-gray-400 hover:text-white">
                <span class="w-8"><i class="fa-solid fa-file-contract text-lg"></i></span>
                <span class="mx-1 text-sm font-medium">Laporan</span>
            </a>
        </div>

    </nav>
</div>
