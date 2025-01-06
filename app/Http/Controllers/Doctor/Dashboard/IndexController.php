<?php

namespace App\Http\Controllers\Doctor\Dashboard;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        $page_breadcrumbs = [
            ['page' => '#', 'title' => 'home', 'active' => false],
        ];

        return view('dashboard.doctor.index', [
            'page_title' => 'home',
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
}
