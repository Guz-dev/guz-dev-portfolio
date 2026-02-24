<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function languageToggle(Request $request)
    {
        $newLocale = App::getLocale() === 'es' ? 'en' : 'es';
        Session::put('locale', $newLocale);
        App::setLocale($newLocale);

        return redirect()->back();
    }
    
    public function about()
    {
        return view('about');
    }

    public function projects()
    {
        $projects = Project::all();
        return view('projects', compact('projects'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Here you would typically send the email using a Mailable class.
        // For simplicity, we'll just simulate a successful send.
        
        try {
            Mail::to(env('MAIL_USERNAME'))->send(new ContactFormMail($validatedData));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('There was an error sending your message. Please try again later.'));
        }
        return redirect()->back()->with('message', __('Your message has been sent successfully!'));
    }

    public function getResume()
    {
        if (App::getLocale() === 'es') {
            return response()->download(storage_path('app/public/Curriculum Gustavo Olivares.pdf'), 'Gustavo_Olivares_CV.pdf');
        } else {
            return response()->download(storage_path('app/public/Resume Gustavo Olivares.pdf'), 'Gustavo_Olivares_Resume.pdf');
        }
    }
}
