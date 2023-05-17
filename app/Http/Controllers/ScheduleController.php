<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function __construct()
    {
    }

    public function index(): View
    {
        return view('pages.schedule.index');
    }
}
