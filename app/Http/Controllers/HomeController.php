<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // По умолчанию показываем страницу "О компании"
        return $this->about();
    }

    public function about()
    {
        $content = view('about')->render();
        return view('home', compact('content'));
    }

    // Добавьте другие методы для разных страниц
    public function contacts()
    {
        $content = view('contacts')->render();
        return view('home', compact('content'));
    }
}

