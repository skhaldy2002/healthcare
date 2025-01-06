<?php

namespace App\Http\Controllers\Patient\Dashboard;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $page_breadcrumbs = [
            ['page' => '#', 'title' => 'home', 'active' => false],
        ];

        return view('dashboard.patient.index', [
            'page_title' => 'home',
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
}
