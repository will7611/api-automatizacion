<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead; // Tu modelo Lead que creaste con la migración
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
   public function store(Request $request)
    {
        // 1. Validamos según tu migración
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'preferred_schedule' => 'nullable|string|max:100',
            'source' => 'nullable|string'
        ]);

        // 2. Guardamos el Lead en la Base de Datos
        $lead = Lead::create([
            'property_id' => $validated['property_id'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'preferred_schedule' => $validated['preferred_schedule'] ?? 'Sin preferencia',
            'source' => $validated['source'] ?? 'organico',
            'status' => 'nuevo'
        ]);

        // 3. Cargamos la relación de la propiedad (para enviarle el nombre/precio a la IA)
        $lead->load('property');

        // 4. Preparamos el Payload (JSON) que le enviaremos a n8n
        $n8nPayload = [
            'lead_id' => $lead->id,
            'cliente_nombre' => $lead->name,
            'cliente_telefono' => $lead->phone,
            'cliente_horario' => $lead->preferred_schedule,
            'propiedad_interes' => $lead->property->title ?? 'Propiedad no especificada',
            'propiedad_precio' => $lead->property->price ?? 0,
            'origen' => $lead->source
        ];

        // Variables para rastrear si se envió a n8n
        $n8nEnviado = false;
        $n8nMensaje = '';

        // 5. Enviamos los datos al Webhook de n8n
        try {
            $webhookUrl = env('N8N_WEBHOOK_URL', 'https://n8n.srv1156021.hstgr.cloud/webhook-test/nuevo-lead-laravel');
            
            // Guardamos la respuesta de la petición HTTP en la variable $response
            $response = Http::timeout(3)->post($webhookUrl, $n8nPayload);
            
            // Si la respuesta es exitosa (código 200)
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

        // 6. Retornamos la respuesta exitosa al Frontend incluyendo el estado de n8n
        return response()->json([
            'message' => 'Lead registrado con éxito',
            'n8n_enviado' => $n8nEnviado,
            'n8n_mensaje' => $n8nMensaje,
            'data' => $lead
        ], 201);
    }
}
