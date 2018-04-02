<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PagesController extends Controller
{
    //show all Pages
    public function showPage(){
        $all_page = Page::all();

        if(view()->exists('Admin.Allpage.pages')){
            $data = [
                'title'  => 'Landing Page',
                'title2' => 'Панель Адміністратора',
                'all_page' => $all_page,

            ];
            return view('Admin.Allpage.pages',$data);
        }
        return abort('404');
    }

    //add new Page
    public function addPage(Request $request){

        if($request->isMethod('post')){
            //dump($request);
            $input = $request->except('_token');
            //dd($input);
            //dump($input['name']);
            //validation
            $rules = [
                'name'   =>'required|max:255',
                'alias'  => 'required|unique:pages|max:10',
                'text'   => 'required',
            ];

            $messages = [
                'required' => 'Поле :attribute - не должно быть пустым!',
                'max'      => 'Максимальное колличество символов - 255,  для поля  :attribute ',
                'unique'    => 'Псевдоним уже существует в базе!'

            ];
            //Створюємо валідатор вручну
            //$res = Validator::make($input, $rules,$messages)->validate();//aвтоматичний redirect
            $res = Validator::make($input, $rules,$messages);
            //dump($res);

           if($res->fails()){
               return redirect()->route('addPage')->withErrors($res)->withInput();//ручний redirect
           }


            //працюємо з картинкою.якщо поле image має файл
            if($request->hasFile('image')){

                   $file = $request->file('image');
                   $input['image'] = $file->getClientOriginalName();//отримали імя файлу
                   //dd($input);
                $path = public_path().'/assets/img/';
                //dd($path);
                $file->move($path, $input['image']);//перекидаємо файл до нашої директорії

               }
               //dd($input);
            //зберігаємо дані в табличці pages

            Page::create([
                    'name'   => strip_tags(trim($request->input('name'))),
                    'alias'  => strip_tags(trim($request->input('alias'))),
                    'text'   => htmlspecialchars(trim($request->input('text'))),
                    'images' => $input['image'],

                ]);
                return redirect('admin')->with('status', 'Страница добавленна');


        }

        if(view()->exists('Admin.AddPage.add')){
            $data = [
                'title'  => 'Landing Page',
                'title2' => 'Панель Адміністратора',

            ];
            return view('Admin.AddPage.add',$data);
        }
        return abort('404');

    }

    //show edit page
    public function showEditPage(){
        $pages = Page::get(['id', 'name', 'text']);
        //dump($pages);

        if(view()->exists('Admin/EditPage.editPage')){
            $data = [
                'title'  => 'Landing Page',
                'title2' => 'Панель Адміністратора',
                'pages' => $pages,

            ];
            return view('Admin/EditPage.editPage', $data);
        }
    }

    //редагуємо сторінку
    public function editPage( Page $page, Request $request){

        //$page = Page::find($id_page);

        /*якщо передаємо id то Використовуємо модель Page.Вона згідно id дістане масив даних*/
        $old_data = $page->toArray();
        //dd($old_data);
        /*Зберігаємо нові дані у базу після валідації*/
            if($request->isMethod('post')){

                //validation
                $input = $request->except('_token');
                //dd($input);
                $rules = [
                        'name'  => 'required|max:255',
                        'alias' => 'required|max:10|unique:pages,alias,'.$old_data['id'],
                        'text'  => 'required',
                        ];
                $messages =[
                        'required' => 'Поле :attribute - не должно быть пустым!',
                        'max'      => 'Максимальное колличество символов - 255,  для поля  :attribute ',
                        'unique'    => 'Псевдоним уже существует в базе!'
                        ];


                 $validator = Validator::make($input, $rules, $messages);
                 if($validator->fails()){
                     //dump($old_data['id']);
                     return redirect()->route('editPage',$old_data['id'])->withErrors($validator)->withInput();
                 }

                 /*перевірка чи загружаємо файл*/
                 if($request->hasFile('images')){
                     $file = $request->file('images');
                     $input['images'] = $file->getClientOriginalName();
                     //dump($input['images']);
                     // наша директорія
                     $path = public_path().'/assets/img/';
                     $file->move($path, $input['images']);//перекидаємо файл якщо він загружаний в нашу директорію

                 }
                 else{
                     $input['images'] = $input['old_image'];
                 }

                        unset($input['old_image']);//видаляємо ячейку old_image
                    //dump($input);

                    /*записуємо в БД*/
                    $save_page = $page->update($input);
                    if($save_page){
                        return redirect()->route('admin')->with('status','Сторінка обновлена');
                    }
        }


        $data = [
            'title'  => 'Landing Page',
            'title2' => 'Панель Адміністратора',
            'data_page' => $old_data,
        ];
        return view('Admin/EditPage.editPage', $data);

}

    //видаляємо сторінку
    public function deletePage(Request $request, $id){

        if($request->isMethod('post') && $_POST['action'] === 'delete'){

                $del_page = Page::find($id);
                $del_page->delete();

        }
        return redirect()->route('pages');

    }
}
