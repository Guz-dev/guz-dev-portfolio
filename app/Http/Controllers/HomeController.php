<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
    
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function projects()
    {
        return view('projects');
    }

    public function contact()
    {
        return view('contact');
    }
}
