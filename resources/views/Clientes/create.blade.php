<x-app-layout>
    <style>
        /* Desactiva las flechas nativas en campos de número */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <div class="py-8 bg-despacho-navy min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900/90 border border-despacho-gold/30 rounded-xl shadow-2xl overflow-hidden">
                <!-- Header integrado con botón estilizado de "Volver al listado" -->
                <div class="p-6 border-b border-despacho-gold/20 bg-slate-950/60 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-despacho-gold tracking-wide">Registrar Nuevo Cliente</h2>
                        <p class="text-xs text-slate-400 mt-1">Alta de cliente y asignación de iguala mensual</p>
                    </div>
                    <a href="{{ route('clientes.index') }}" class="inline-flex items-center justify-center bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold py-2 px-4 rounded-lg text-sm transition shadow-sm">
                        Volver al listado
                    </a>
                </div>

                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4 bg-rose-900/40 border border-rose-500/50 text-rose-300 px-4 py-3 rounded-lg text-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('clientes.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="razon_social" class="block text-sm font-medium text-slate-300 mb-1">Razón Social</label>
                            <input type="text" id="razon_social" name="razon_social" value="{{ old('razon_social') }}" placeholder="Ej. Consultoría Tlaxcala S.A. de C.V." class="w-full rounded-lg bg-slate-950 border-slate-800 text-slate-100 placeholder-slate-600 focus:border-despacho-gold focus:ring-despacho-gold text-sm p-2.5" required>
                        </div>

                        <div>
                            <label for="rfc" class="block text-sm font-medium text-slate-300 mb-1">RFC</label>
                            <input type="text" id="rfc" name="rfc" maxlength="13" value="{{ old('rfc') }}" placeholder="Ej. CST240101ABC" class="w-full rounded-lg bg-slate-950 border-slate-800 text-slate-100 placeholder-slate-600 focus:border-despacho-gold focus:ring-despacho-gold text-sm p-2.5 font-mono uppercase" required>
                        </div>

                        <div>
                            <label for="tipo_persona" class="block text-sm font-medium text-slate-300 mb-1">Tipo de Persona</label>
                            <select id="tipo_persona" name="tipo_persona" class="w-full rounded-lg bg-slate-950 border-slate-800 text-slate-100 focus:border-despacho-gold focus:ring-despacho-gold text-sm p-2.5" required>
                                <option value="Física">Física</option>
                                <option value="Moral">Moral</option>
                            </select>
                        </div>

                        <div>
                            <label for="iguala_mensual" class="block text-sm font-medium text-slate-300 mb-1">Costo de Iguala Mensual ($)</label>
                            <input type="number" step="0.01" id="iguala_mensual" name="iguala_mensual" value="{{ old('iguala_mensual') }}" placeholder="0.00" class="w-full rounded-lg bg-slate-950 border-slate-800 text-slate-100 placeholder-slate-600 focus:border-despacho-gold focus:ring-despacho-gold text-sm p-2.5" required>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-slate-800">
                            <button type="submit" class="bg-despacho-gold hover:bg-despacho-goldHover text-slate-950 font-bold py-2.5 px-5 rounded-lg shadow-md transition duration-200 text-sm">
                                Guardar Cliente
                            </button>
                            <a href="{{ route('clientes.index') }}" class="text-slate-400 hover:text-slate-200 text-sm transition">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>