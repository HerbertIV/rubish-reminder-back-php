<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ScheduleController extends Controller
{
    public function __construct()
    {
    }

    public function index(): Response
    {
        return Inertia::render('Schedule/Schedule');
    }
}
