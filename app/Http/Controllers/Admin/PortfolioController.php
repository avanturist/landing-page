<?php

namespace App\Http\Controllers\Admin;

use App\Portfolio;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    //
    public function execute(){
        $portf = Portfolio::all();
        //dump($portf);

        if(view()->exists('Admin.All_portfolio.portfolio')){
            $data = [
                'title'  => 'Landing Page',
                'title2' => 'Панель Адміністратора',
                'portfolios' => $portf,
            ];
            return view('Admin.All_portfolio.portfolio', $data);
        }

    }
    //addPorfolio
    public function addPortfolio(Portfolio $portfolio, Request $request){
        if($request->isMethod('post')){

            $input = $request->except('_token');
            //dump($input);

            //validation
            $rules = [
                'name' => 'required|unique:portfolios|max:20',
                'filter' => 'required|max:20'

            ];
            $messages =[
                'required' => 'Поле :attribute обязательно к заполнению',
                'unique'   => 'Поле :attribute существует в базе!',
                'max'      => 'Максимальное колличество символов - 20,  для поля  :attribute',
            ];
            $data = Validator::make($input, $rules, $messages);
            if($data->fails()){
                return redirect()->route('addPortfolio')->withErrors($data)->withInput();
            }

            //загрузка картинки
            //перевірка чи файл є картинкою (jpeg, png, bmp, gif, or svg)
            $val_img =  Validator::make($input, ['images' => ['required','image']],
                            ['image'=>'Только следующие формати файла (jpeg, png, bmp, gif, or svg)','required'=>'Файл не загружен!']);

            if($val_img->fails()){
                return redirect()->route('addPortfolio')->withErrors($val_img)->withInput();
            }

            if($request->hasFile('images')){
                $file = $request->images;
                $input['images'] = $file->getClientOriginalName();
                //dump($input['images']);
                $path = public_path().'/assets/img/';
                $file->move($path, $input['images']);

            }

            //запис даних в базу

            $save = $portfolio->fill($input);
            if($save->save()){
                //dump($save);
                return redirect()->route('portfolios')->with('status','Новое Портфолио добавленно!');
            }
        }


        if(view()->exists('Admin.AddPortfolio.addPortfolio')){

            $data = [
                    'title'  => 'Landing Page',
                    'title2' => 'Панель Адміністратора',

                ];
            return view('Admin.AddPortfolio.addPortfolio', $data);
        }
    }

    //editPortfolio
    public function editPortfolio(Request $request,$id){
        //delete
        if($request->isMethod('post') && $request->action == 'delete'){
            $port = Portfolio::find($id);
            $port->delete();

            return redirect()-route('portfolios');
        }

        $old_data = Portfolio::all()->where('id',$id);
        //dump($old_data);

        if($request->isMethod('post')){
            $input = $request->except('_token');
            //dump($input);

            //валідація даних
            $rules = [
                'name' => 'required|unique:portfolios|max:20',
                'filter' => 'required|max:20'

            ];
            $messages =[
                'required' => 'Поле :attribute обязательно к заполнению',
                'unique'   => 'Поле :attribute существует в базе!',
                'max'      => 'Максимальное колличество символов - 20,  для поля  :attribute',
            ];
            $res = Validator::make($input, $rules, $messages);

            if($request->hasFile('images')){
                $file = $request->images;
                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path().'/assets/img/',$input['images']);

            }
            else{
                $input['images'] = $input['old_img'];
            }
            unset($input['old_img']);
            //dump($input);

            //update в базу
               $update_data = Portfolio::find($id)->update($input);

                //dump($input['name']);
            if($update_data) {
                return redirect()->route('portfolios')->with('status', 'Портфолио обновленно!');
           }

        }


        //view
        if(view()->exists('Admin.EditPortfolio.editPortfolio')){
            $data = [
                'title'  => 'Landing Page',
                'title2' => 'Панель Адміністратора',
                'oldData'   => $old_data,

            ];
           $vid = view('Admin.EditPortfolio.editPortfolio', $data);


            /*return response($vid)->header('Avtor', 'Ohnitskiy Vitaliy')
                                 ->header('Avtor', 'Ohnitskiy Vitaliy',false);*/

            /*header('Location: http://landing.com/admin/portfolio');
            exit;*/
            return $vid;



        }
        return abort(404, 'Страница не нейдена');



    }
}
