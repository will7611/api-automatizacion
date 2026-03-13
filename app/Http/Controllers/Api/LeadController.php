<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    // ─── EXISTENTE: Crear lead desde formulario ───────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id'        => 'required|exists:properties,id',
            'name'               => 'required|string|max:255',
            'phone'              => 'required|string|max:50',
            'email'              => 'nullable|email|max:255',
            'preferred_schedule' => 'nullable|string|max:100',
            'source'             => 'nullable|string'
        ]);

        $lead = Lead::create([
            'property_id'        => $validated['property_id'],
            'name'               => $validated['name'],
            'phone'              => $validated['phone'],
            'email'              => $validated['email'],
            'preferred_schedule' => $validated['preferred_schedule'] ?? 'Sin preferencia',
            'source'             => $validated['source'] ?? 'organico',
            'status'             => 'nuevo'
        ]);

        $lead->load('property');

        $n8nPayload = [
            'lead_id'           => $lead->id,
            'cliente_nombre'    => $lead->name,
            'cliente_telefono'  => $lead->phone,
            'cliente_horario'   => $lead->preferred_schedule,
            'propiedad_interes' => $lead->property->title ?? 'Propiedad no especificada',
            'propiedad_precio'  => $lead->property->price ?? 0,
            'propiedad_id'      => $lead->property->id ?? null,
            'origen'            => $lead->source
        ];

        $n8nEnviado = false;
        $n8nMensaje = '';

        try {
            $webhookUrl = env('N8N_WEBHOOK_URL', 'https://n8n.srv1156021.hstgr.cloud/webhook/nuevo-lead-laravel');
            $response   = Http::timeout(3)->post($webhookUrl, $n8nPayload);

            if ($response->successful()) {
                $n8nEnviado = true;
                $n8nMensaje = 'Webhook enviado a n8n correctamente.';
            } else {
                $n8nMensaje = 'Error de n8n. Código HTTP: ' . $response->status();
            }
        } catch (\Exception $e) {
            $n8nMensaje = 'Excepción al conectar con n8n: ' . $e->getMessage();
            Log::error('Fallo al enviar el Lead a n8n: ' . $e->getMessage());
        }

        return response()->json([
            'message'    => 'Lead registrado con éxito',
            'n8n_enviado' => $n8nEnviado,
            'n8n_mensaje' => $n8nMensaje,
            'data'       => $lead
        ], 201);
    }

    // ─── NUEVO: Contexto completo para N8N/IA por teléfono ───────────
    public function contextoIA(Request $request)
    {
        $phone = $request->query('telefono');

        if (!$phone) {
            return response()->json(['error' => 'El parámetro telefono es requerido'], 422);
        }

        $lead = Lead::with(['property', 'assignee'])
            ->where('phone', $phone)
            ->latest()
            ->first();

        if (!$lead) {
            return response()->json(['error' => 'Lead no encontrado'], 404);
        }

        return response()->json([
            'lead_id'  => $lead->id,
            'nombre'   => $lead->name,
            'telefono' => $lead->phone,
            'horario'  => $lead->preferred_schedule,
            'origen'   => $lead->source,
            'status'   => $lead->status,
            'propiedad' => [
                'id'          => $lead->property->id          ?? null,
                'titulo'      => $lead->property->title       ?? 'Sin título',
                'precio'      => $lead->property->price       ?? 0,
                'descripcion' => $lead->property->description ?? '',
                'slug'        => $lead->property->slug        ?? '',
                'amenidades'  => $lead->property->amenities   ?? [],
            ],
            'asesor' => $lead->assignee ? [
                'nombre'    => $lead->assignee->name,
                'telefono'  => $lead->assignee->phone ?? null,
            ] : null,
        ]);
    }

    // ─── NUEVO: Agendar cita desde N8N ───────────────────────────────
    public function agendarCita(Request $request)
    {
        $validated = $request->validate([
            'telefono'        => 'required|string',
            'fecha_preferida' => 'nullable|string',
        ]);

        $lead = Lead::with(['property', 'assignee'])
            ->where('phone', $validated['telefono'])
            ->latest()
            ->first();

        if (!$lead) {
            return response()->json(['error' => 'Lead no encontrado'], 404);
        }

        $lead->update(['status' => 'cita_agendada']);

        return response()->json([
            'message'         => 'Cita agendada correctamente',
            'lead_id'         => $lead->id,
            'nombre'          => $lead->name,
            'propiedad'       => $lead->property->title ?? '',
            'horario'         => $lead->preferred_schedule,
            'asesor_telefono' => $lead->assignee->phone ?? null,
            'asesor_nombre'   => $lead->assignee->name  ?? 'Asesor disponible',
        ]);
    }
}
