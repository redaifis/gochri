<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    

    // --------- Dashboard

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // --------- Profile

    public function editProfile($id)
    {
        return view('admin.editProfile');
    }

    // --------- Settings

    public function settings(){
        return view('admin.settings.index');
    }

    // --------- Shipping

    public function shipping(){
        return view('admin.settings.shipping');
    }

    // --------- Payment

    public function payment(){
        return view('admin.settings.payment');
    }
}
