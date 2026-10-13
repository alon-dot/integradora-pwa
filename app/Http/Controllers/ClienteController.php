<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ExpedienteCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // <-- ¡Asegúrate de agregar esta línea!

class ClienteController extends Controller
{
    /**
     * Restringe el acceso exclusivo para Admin y Supervisor en operaciones de escritura/modificación.
     */
    private function verificarAccesoAdminSupervisor()
    {
        $emailActual = Auth::user()->email;
        $permitidos = ['admin@despacho.com', 'supervisor@despacho.com'];
        
        if (!in_array($emailActual, $permitidos)) {
            abort(403, 'No tienes autorización para realizar esta acción. Módulo exclusivo para Administradores y Supervisores.');
        }
    }

    public function index()
    {
        $clientes = Cliente::where('activo', true)->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $this->verificarAccesoAdminSupervisor();
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $this->verificarAccesoAdminSupervisor();

        $request->validate([
            'razon_social' => 'required|string|max:255',
            'rfc' => 'required|string|max:13|unique:clientes',
            'tipo_persona' => 'required|in:Física,Moral',
            'iguala_mensual' => 'required|numeric|min:0',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado exitosamente.');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('expedientes');
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $this->verificarAccesoAdminSupervisor();
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $this->verificarAccesoAdminSupervisor();

        $request->validate([
            'razon_social' => 'required|string|max:255',
            'rfc' => 'required|string|max:13|unique:clientes,rfc,' . $cliente->id,
            'tipo_persona' => 'required|in:Física,Moral',
            'iguala_mensual' => 'required|numeric|min:0',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $this->verificarAccesoAdminSupervisor();

        // Baja lógica recomendada
        $cliente->update(['activo' => false]);
        return redirect()->route('clientes.index')->with('success', 'Cliente dado de baja correctamente.');
    }

    // Método para manejar el Expediente Digital (HU-05) - Accesible para contadores también
    public function subirExpediente(Request $request, Cliente $cliente)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|in:PDF,Minuta,Acuse',
            // Límite de peso estricto por archivo (ej. 5120 KB = 5MB)
            'archivo' => 'required|mimes:pdf|max:5120', 
        ]);

        if ($request->hasFile('archivo')) {
            $path = $request->file('archivo')->store('expedientes_clientes', 'public');

            ExpedienteCliente::create([
                'cliente_id' => $cliente->id,
                'titulo' => $request->titulo,
                'archivo_path' => $path,
                'tipo' => $request->tipo,
            ]);
        }

        return back()->with('success', 'Documento adjuntado correctamente al expediente.');
    }
}