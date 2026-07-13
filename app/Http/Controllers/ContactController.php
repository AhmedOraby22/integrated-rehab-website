<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:3000'],
            // honeypot field — real visitors never fill this in
            'company_website' => ['max:0'],
        ]);

        $to = config('mail.contact_to', env('CONTACT_TO_EMAIL', 'info@integratedrehabandphysicaltherapy.com'));

        try {
            Mail::to($to)->send(new ContactFormMail($data));
        } catch (Throwable $e) {
            Log::error('Contact form mail failed: '.$e->getMessage());

            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'We could not send your message right now. Please call us directly or try again later.',
                ]);
        }

        return redirect()
            ->route('contact')
            ->with('status', 'Thanks — your message is on its way. We usually reply within one business day.');
    }
}
