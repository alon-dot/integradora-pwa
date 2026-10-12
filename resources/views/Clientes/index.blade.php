<x-app-layout>
    <div class="py-8 bg-despacho-navy min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-emerald-900/40 border border-emerald-500/50 text-emerald-300 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Tarjeta Unificada -->
            <div class="bg-slate-900/90 border border-despacho-gold/30 rounded-xl shadow-2xl overflow-hidden">
                
                <!-- Encabezado integrado del Panel (Título a la izquierda + Botón a la derecha) -->
                <div class="p-6 border-b border-despacho-gold/20 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-950/60">
                    <div>
                        <h2 class="text-2xl font-bold text-despacho-gold tracking-wide">
                            Gestión de Clientes e Iguala Mensual
                        </h2>
                    </div>

                    @if(in_array(Auth::user()->email, ['admin@despacho.com', 'supervisor@despacho.com']))
                        <a href="{{ route('clientes.create') }}" class="inline-flex items-center justify-center bg-despacho-gold hover:bg-despacho-goldHover text-slate-950 font-bold py-2.5 px-5 rounded-lg shadow-md hover:shadow-despacho-gold/20 transition duration-200 text-sm whitespace-nowrap">
                            + Nuevo Cliente
                        </a>
                    @endif
                </div>

                <!-- Tabla de Datos -->
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-800">
                            <thead class="bg-slate-950">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-despacho-gold uppercase tracking-wider">Razón Social</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-despacho-gold uppercase tracking-wider">RFC</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-despacho-gold uppercase tracking-wider">Tipo Persona</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-despacho-gold uppercase tracking-wider">Iguala Mensual</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-despacho-gold uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/60 bg-slate-900/50">
                                @foreach($clientes as $cliente)
                                <tr class="hover:bg-slate-800/50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-100">{{ $cliente->razon_social }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-slate-400 font-mono text-sm">{{ $cliente->rfc }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-slate-300">{{ $cliente->tipo_persona }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-despacho-gold">${{ number_format($cliente->iguala_mensual, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                        <a href="{{ route('clientes.show', $cliente->id) }}" class="text-sky-400 hover:text-sky-300 font-semibold transition">Expediente (PDF)</a>
                                        @if(in_array(Auth::user()->email, ['admin@despacho.com', 'supervisor@despacho.com']))
                                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-amber-400 hover:text-amber-300 font-semibold transition">Editar</a>
                                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-400 hover:text-rose-300 font-semibold transition" onclick="return confirm('¿Estás seguro de dar de baja este cliente?')">Baja</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 pt-4 border-t border-slate-800">
                        {{ $clientes->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>