<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\People;
use App\Portfolio;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderShipped;

class IndexController extends Controller
{
    //
    public function execute(Request $request){
        /*форма обработки данних*/
        if($request->isMethod('post')){
           /*перевірка даних ВАЛІДАЦІЯ*/
           $rules = [
               'name' =>'required|max:255',
               'email'=>'required|email',
               'text' => 'required'
           ];
           $messages = [
               'required' => 'Поле -:attribute - обовязкове для заповнення! ',
               'max'      => 'Максимальна кількість символів 255!',
               'email'    => 'Поле -attribute - понно відповідати email адресі!',

           ];
           $this->validate($request, $rules, $messages);
           //dump($request->email);

            /*получаємо дані*/
            $data = $request->all();

            /*відправка email на конкретний поштовий ящик*/
            // site.email- шаблон
            $result = Mail::send('site.email', ['data'=>$data], function ($message) use ($data){
                $mail_admin = env('MAIL_ADMIN');
               $message->from($data['email'], $data['name']);
               $message->to($mail_admin)->subject('Question');


            });
            //dd($result);
            if($result){
                return redirect('home')->with('status', 'Повідомлення відправленно!!!');
            }

        }



        $pages = Page::all();
        $portfolios = Portfolio::get(['name','filter','images']);
        $services = Service::where('id','<',20)->get();
        $people = People::all();
        //dd($people);
        $menu = array();
        foreach ($pages as $page){
           $item = array('name'=>$page->name,'alias'=>$page->alias);
           array_push($menu, $item);
        }
      //dd($menu);

        /*унікальні імена для кнопок  фільтру*/
        $filters = DB::table('portfolios')->select('filter')->distinct()->get();
        //dd($filters);
        //решта меню
        $items = array(
                        array('name'=>'Services','alias'=>'service'),
                        array('name'=>'Portfolio','alias'=>'Portfolio'),
                        array('name'=>'Team','alias'=>'team'),
                        array('name'=>'Contact','alias'=>'contact'),
                        );
        foreach ($items as $item){
            array_push($menu,$item);
        }
        //dd($menu);

        return view('site.index' ,array(
                                            'menu'      =>$menu,
                                            'pages'     =>$pages,
                                            'portfolio' =>$portfolios,
                                            'filter'    => $filters,
                                            'services'  =>$services,
                                            'people'    =>$people,

                                        ))->withTitle('Landing Page');
    }
}
