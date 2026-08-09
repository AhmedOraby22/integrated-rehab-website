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
            'phone' => [$request->input('redirect_to') === 'home' ? 'required' : 'nullable', 'string', 'max:40'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:3000'],
            // honeypot field — real visitors never fill this in
            'company_website' => ['max:0'],
            'redirect_to' => ['nullable', 'in:home'],
            '_form' => ['nullable', 'string', 'max:40'],
        ]);

        $to = config('mail.contact_to', env('CONTACT_TO_EMAIL', 'info@integratedrehabandphysicaltherapy.com'));

        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'],
            'message' => $data['message'],
        ];

        try {
            Mail::to($to)->send(new ContactFormMail($payload));
        } catch (Throwable $e) {
            Log::error('Contact form mail failed: '.$e->getMessage());

            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'We could not send your message right now. Please call us directly or try again later.',
                ]);
        }

        $message = 'Thanks — your message is on its way. We usually reply within one business day.';

        if ($request->input('redirect_to') === 'home') {
            return redirect()
                ->route('home')
                ->with('status', $message)
                ->withFragment('contact-us');
        }

        return redirect()
            ->route('contact')
            ->with('status', $message);
    }
}
