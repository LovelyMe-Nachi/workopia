<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Job;

class HomeController extends Controller
{
    public function index(): View
    {
        $jobs = Job::latest()->limit(6)->get();

        return view('pages.index')->with('jobs', $jobs);
    }
}
