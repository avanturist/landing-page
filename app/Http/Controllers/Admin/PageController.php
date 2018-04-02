<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    //
    public function execute($alias){
        if(!$alias){
            abort('404');
        }
        $alias_clear = strip_tags(trim($alias));
        /*$pages= Page::where('alias','=',$alias)->get(['text','images']);*/
        $data =  Page::all()->where('alias','=',$alias_clear);
        //dd($serv);
        return view('site.buttonHome',['data'=>$data])->withTitle('LandingPage');
    }


}
