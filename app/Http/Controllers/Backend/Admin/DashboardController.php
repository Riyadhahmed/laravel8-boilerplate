<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return View::make('backend.admin.home');
    }
}
