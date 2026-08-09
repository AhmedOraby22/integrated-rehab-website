<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'message' => ['required', 'string', 'max:3000'],
            'company_website' => ['max:0'],
        ]);

        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'subject' => 'Live chat — website inquiry',
            'message' => $data['message'],
        ];

        $to = config('mail.contact_to', env('CONTACT_TO_EMAIL', 'info@integratedrehabandphysicaltherapy.com'));

        try {
            Mail::to($to)->send(new ContactFormMail($payload));
        } catch (Throwable $e) {
            Log::error('Live chat mail failed: '.$e->getMessage());

            return response()->json([
                'ok' => false,
                'message' => 'We could not send your message right now. Please call 718-332-3401 or try again later.',
            ], 422);
        }

        return response()->json([
            'ok' => true,
            'message' => 'Thanks — your message is on its way. We usually reply within one business day.',
        ]);
    }
}
