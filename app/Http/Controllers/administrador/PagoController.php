<?php

namespace App\Http\Controllers\administrador;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\MetodoPago;
use App\Models\Pago;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PagoController extends Controller
{
    public function index(): View
    {
        $pagos = Pago::with([
                'cita.cliente.user',
                'cita.barbero.user',
                'cita.servicios',
                'metodoPago',
            ])
            ->orderByDesc('fecha_pago')
            ->get();

        return view('administrador.pagos.index', compact('pagos'));
    }

    public function create(Request $request): View
    {
        $citaId = $request->query('cita');

        $citaSeleccionada = null;

        if ($citaId) {
            $citaSeleccionada = Cita::with([
                    'cliente.user',
                    'barbero.user',
                    'servicios',
                    'pago',
                ])
                ->findOrFail($citaId);

            if ($citaSeleccionada->estado_cita !== 'completada') {
                abort(403, 'Solo puedes generar pagos de citas completadas.');
            }

            if ($citaSeleccionada->pago) {
                abort(403, 'Esta cita ya tiene un pago registrado.');
            }
        }

        $citasCompletadasSinPago = Cita::with([
                'cliente.user',
                'barbero.user',
                'servicios',
            ])
            ->where('estado_cita', 'completada')
            ->whereDoesntHave('pago')
            ->orderByDesc('fecha_cita')
            ->orderByDesc('hora_inicio')
            ->get();

        $metodoEfectivo = MetodoPago::where('nombre_metodo', 'efectivo')->first();

        $metodosPago = MetodoPago::orderBy('nombre_metodo')->get();

        return view('administrador.pagos.create', compact(
            'citaSeleccionada',
            'citasCompletadasSinPago',
            'metodoEfectivo',
            'metodosPago'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_cita' => [
                'required',
                'integer',
                'exists:citas,id',
                Rule::unique('pagos', 'id_cita'),
            ],
            'id_metodo_pago' => [
                'required',
                'integer',
                'exists:metodo_pago,id',
            ],
            'monto' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'estado_pago' => [
                'required',
                Rule::in(['pendiente', 'pagado', 'cancelado']),
            ],
            'referencia_transaccion' => [
                'nullable',
                'string',
                'max:150',
            ],
            'concepto' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $cita = Cita::with(['servicios', 'pago'])
            ->findOrFail($validatedData['id_cita']);

        if ($cita->estado_cita !== 'completada') {
            return back()
                ->withInput()
                ->with('error', 'Solo puedes generar pagos para citas completadas.');
        }

        if ($cita->pago) {
            return back()
                ->withInput()
                ->with('error', 'Esta cita ya tiene un pago registrado.');
        }

        $montoCalculado = $cita->servicios->sum(function ($servicio) {
            return $servicio->citas_servicios->precio_aplicado ?? 0;
        });

        if ((float) $validatedData['monto'] !== (float) $montoCalculado) {
            return back()
                ->withInput()
                ->with('error', 'El monto no coincide con el total de los servicios de la cita.');
        }

        $pago = Pago::create([
            'id_cita' => $cita->id,
            'id_metodo_pago' => $validatedData['id_metodo_pago'],
            'monto' => $validatedData['monto'],
            'fecha_pago' => now(),
            'estado_pago' => $validatedData['estado_pago'],
            'referencia_transaccion' => $validatedData['referencia_transaccion'] ?? null,
            'concepto' => $validatedData['concepto'] ?? 'Pago en caja de la cita #' . $cita->id,
        ]);

        return redirect()
            ->route('administrador.pagos.show', $pago->id)
            ->with('status', 'Pago registrado correctamente.');
    }

    public function show(int $id): View
    {
        $pago = Pago::with([
                'cita.cliente.user',
                'cita.barbero.user',
                'cita.servicios',
                'metodoPago',
            ])
            ->findOrFail($id);

        return view('administrador.pagos.show', compact('pago'));
    }
}