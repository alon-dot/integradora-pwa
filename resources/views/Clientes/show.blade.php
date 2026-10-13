<x-app-layout>
    <div class="py-8 bg-despacho-navy min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Ficha del Cliente -->
            <div class="bg-slate-900/90 border border-despacho-gold/30 rounded-xl shadow-2xl p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-despacho-gold/20 pb-4 mb-4 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-despacho-gold tracking-wide">{{ $cliente->razon_social }}</h2>
                        <p class="text-xs text-slate-400 mt-1">Expediente Digital e Información Fiscal</p>
                    </div>
                    <a href="{{ route('clientes.index') }}" class="inline-flex items-center justify-center bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold py-2 px-4 rounded-lg text-sm transition">
                        Volver al listado
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-slate-300 text-sm">
                    <div class="bg-slate-950/50 p-3 rounded-lg border border-slate-800">
                        <span class="text-xs text-slate-500 uppercase block font-semibold">RFC</span>
                        <span class="font-mono text-slate-200 text-base font-bold">{{ $cliente->rfc }}</span>
                    </div>
                    <div class="bg-slate-950/50 p-3 rounded-lg border border-slate-800">
                        <span class="text-xs text-slate-500 uppercase block font-semibold">Tipo de Persona</span>
                        <span class="text-slate-200 font-semibold">{{ $cliente->tipo_persona }}</span>
                    </div>
                    <div class="bg-slate-950/50 p-3 rounded-lg border border-slate-800">
                        <span class="text-xs text-slate-500 uppercase block font-semibold">Iguala Mensual</span>
                        <span class="text-despacho-gold font-bold text-base">${{ number_format($cliente->iguala_mensual, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Formulario de Subida (HU-05) -->
            <div class="bg-slate-900/90 border border-despacho-gold/30 rounded-xl shadow-2xl p-6">
                <h3 class="text-lg font-bold text-despacho-gold mb-4 border-b border-despacho-gold/20 pb-2">Adjuntar Documento al Expediente</h3>

                @if(session('success'))
                    <div class="bg-emerald-900/40 border border-emerald-500/50 text-emerald-300 px-4 py-3 rounded-lg mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-rose-900/40 border border-rose-500/50 text-rose-300 px-4 py-3 rounded-lg mb-4 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('clientes.expedientes.store', $cliente->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="titulo" class="block text-sm font-medium text-slate-300 mb-1">Título del Documento</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Ej. Acuse Declaración Anual" class="w-full rounded-lg bg-slate-950 border-slate-800 text-slate-100 placeholder-slate-600 focus:border-despacho-gold focus:ring-despacho-gold text-sm p-2.5" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tipo" class="block text-sm font-medium text-slate-300 mb-1">Tipo de Documento</label>
                            <select id="tipo" name="tipo" class="w-full rounded-lg bg-slate-950 border-slate-800 text-slate-100 focus:border-despacho-gold focus:ring-despacho-gold text-sm p-2.5" required>
                                <option value="PDF">PDF General</option>
                                <option value="Minuta">Minuta</option>
                                <option value="Acuse">Acuse</option>
                            </select>
                        </div>

                        <div>
                            <label for="archivo" class="block text-sm font-medium text-slate-300 mb-1">Archivo PDF (Máximo 5MB)</label>
                            <input type="file" id="archivo" name="archivo" accept="application/pdf" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-despacho-gold file:text-slate-950 hover:file:bg-despacho-goldHover file:cursor-pointer border border-slate-800 bg-slate-950 rounded-lg p-1" required>
                        </div>
                    </div>

                    <button type="submit" class="bg-despacho-gold hover:bg-despacho-goldHover text-slate-950 font-bold py-2.5 px-5 rounded-lg shadow-md transition duration-200 text-sm">
                        Subir Documento
                    </button>
                </form>
            </div>

            <!-- Listado de Documentos -->
            <div class="bg-slate-900/90 border border-despacho-gold/30 rounded-xl shadow-2xl p-6">
                <h3 class="text-lg font-bold text-despacho-gold mb-4 border-b border-despacho-gold/20 pb-2">Documentos Registrados</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-800">
                        <thead class="bg-slate-950">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-despacho-gold uppercase">Título</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-despacho-gold uppercase">Tipo</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-despacho-gold uppercase">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-despacho-gold uppercase">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 bg-slate-900/50">
                            @forelse($cliente->expedientes as $expediente)
                            <tr class="hover:bg-slate-800/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-slate-200 font-medium">{{ $expediente->titulo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-400">{{ $expediente->tipo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-400 font-mono text-sm">{{ $expediente->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ Storage::url($expediente->archivo_path) }}" target="_blank" class="text-sky-400 hover:text-sky-300 font-semibold text-sm transition">Ver PDF</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-slate-500 text-sm">No hay documentos registrados en el expediente.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>