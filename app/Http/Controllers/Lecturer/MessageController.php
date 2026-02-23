<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('lecturer.messages.index');
    }
}
