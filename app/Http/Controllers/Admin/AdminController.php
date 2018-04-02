<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //

    public function execute(){

        if(view()->exists('views.auth.login')){

            return view('views.auth.login');
        }
        return abort('404');
    }



    public function show(){

        if(view()->exists('Admin.admin')){
            $data = [
                'title'  => 'Landing Page',
                'title2' => 'Панель Адміністратора',
            ];
            return view('Admin.admin', $data);
        }
        return abort('404');
    }
}
