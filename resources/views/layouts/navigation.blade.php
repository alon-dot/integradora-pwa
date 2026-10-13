<nav x-data="{ open: false }" class="bg-despacho-navy border-b border-despacho-gold/30">
    <!-- Primary Navigation Menu (Altura ampliada a h-28) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-28">
            <div class="flex items-center space-x-8">
                
                <!-- Logotipo Oficial del Despacho (Tamaño Maximizado h-24) -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('clientes.index') }}" class="flex items-center group py-2">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Téllez Ponce & Asociados" class="h-24 w-auto object-contain rounded-lg transition transform group-hover:scale-105 shadow-lg">
                    </a>
                </div>

                <!-- Enlace de Navegación -->
                <div class="hidden space-x-6 sm:-my-px sm:flex h-28">
                    <a href="{{ route('clientes.index') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-base font-medium transition duration-150 ease-in-out {{ request()->routeIs('clientes*') ? 'border-despacho-gold text-despacho-gold font-bold' : 'border-transparent text-gray-300 hover:text-despacho-gold hover:border-despacho-gold/50' }}">
                        Clientes e Igualas
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2.5 border border-despacho-gold/30 text-sm font-medium rounded-lg text-gray-200 bg-slate-900/90 hover:text-despacho-gold hover:border-despacho-gold focus:outline-none transition duration-150 shadow-sm">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1.5">
                                <svg class="fill-current h-4 w-4 text-despacho-gold" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Móvil) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-despacho-gold hover:bg-slate-900 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Móvil) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-despacho-navy border-t border-despacho-gold/20">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('clientes.index') }}" class="block ps-3 pe-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('clientes*') ? 'border-despacho-gold text-despacho-gold bg-slate-900' : 'border-transparent text-gray-300' }}">
                Clientes e Igualas
            </a>
        </div>
    </div>
</nav>