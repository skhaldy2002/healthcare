<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        $page_breadcrumbs = [
            ['page' => '#', 'title' => 'home', 'active' => false],
        ];

        return view('dashboard.admin.dashboard', [
            'page_title' => 'home',
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);


    }
}
