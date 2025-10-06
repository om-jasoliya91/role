<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function index2()
    {
        return view('lang');
    }

    public function switch($lang = 'en')
    {
        $session = session();

        // Only allow supported languages
        $availableLanguages = ['en', 'gu'];

        if (in_array($lang, $availableLanguages)) {
            $session->set('lang', $lang);
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
}
