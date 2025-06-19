<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    public function index()
    {
        // Заглушка: позже добавим реальные документы
        $documents = [
            ['name' => 'Договор аренды', 'date' => '2023-05-15'],
            ['name' => 'Акт приема-передачи', 'date' => '2023-05-20'],
        ];

        return view('tenant.documents.index', compact('documents'));
    }
}
