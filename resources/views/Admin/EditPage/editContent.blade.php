<div class="container-fluid">

    <div class="row">
        <div class="col-md-2">
            <div class="menu">
                <a href="{{ route('admin') }}"><i class="fa fa-home"></i> Home</a>

                <a class="cursor"><span><i class="fa fa-file"></i> Сторінки</span>
                    <ul class="second_menu">
                        <li><a href="{{ route('pages') }}">All Pages</a></li>
                        <li><a href="{{ route('addPage') }}">Add Page</a></li>
                        <li><a href="{{ route('editP') }}">Edit Page</a></li>
                    </ul>

                </a>

                <a class="cursor" onclick="myPortfolio()"><span><i class="fa fa-briefcase"></i> Портфоліо</span>
                    <ul class="second_menu" id="portfolio" >
                        <li><a href="{{ route('portfolios') }}">All Portfolio</a></li>
                        <li><a href="{{ route('addPortfolio') }}">Add Portfolio</a></li>
                    </ul>

                </a>
                <a href=""><span><i class="fa fa-wrench"></i> Сервіси</span></a>

            </div>
        </div>
        <div class="col-md-10 content">
            <h2> Edit Page</h2>
            <hr>
                @if(isset($pages))
                    @foreach($pages as $k => $page)

                            @if($k == 0 && $k%3 ==0)
                                <div class="row">
                            @endif
                                <div class="col-md-4 list {{ ($k%3 != 0) ? "border_left" :'' }}">
                                    <a href="{{ route('editPage', $page->id) }}"><div class="edit_block">
                                        <h3>{{ $page->name }}</h3>
                                        <p>{{ $page->text }}</p>
                                    </div></a>
                                </div>
                            @if( ($k+1)%3 == 0)
                                </div>
                            @endif

                @endforeach
            @endif

           {{-- якщо існує сторінка то редагуємо її --}}
            @if(isset($data_page))


            {!! Form::open(['route'=>['editPage', $data_page['id']], 'files'=>true]) !!}

               <div class="form-group">
                   {!! Form::label('Название страници:', null, ['class'=>'control-label']) !!}
                   {!! Form::text('name', $data_page["name"], ['class'=>'form-control']) !!}
                   @if($errors->has('name'))
                       <small class="danger">{{ $errors->first('name') }}</small>
                   @endif
               </div>

               <div class="form-group">
                    {!! Form::label('alias', 'Псевдоним:', ['class'=>'control-label']) !!}
                    {!! Form::text('alias', $data_page["alias"], ['class'=>'form-control']) !!}
                   @if($errors->has('alias'))
                       <small class="danger">{{ $errors->first('alias') }}</small>
                   @endif
                </div>

               <div class="form-group">
                    {!! Form::label('Content:', null, ['class'=>'control-label']) !!}
                    {!! Form::textarea('text',$data_page["text"],['class'=>'form-control','id'=>'editor'] ) !!}
                   @if($errors->has('text'))
                       <small class="danger">{{ $errors->first('text') }}</small>
                   @endif
               </div>

               <div class="form-group">
                   <!--Показуємо old_image-->
                   {!! Form::label('old_image','Старое изображение:',['class'=>'control-label'] ) !!}
                   {!! Html::image('assets/img/'.$data_page['images'],$data_page['images'],['class'=>'img-responsive','width'=>'20%']) !!}
                   {!! Form::hidden('old_image',$data_page['images']) !!}
               </div>

                <div class="form-group">
                    {!! Form::label('Изображение:', null, ['class'=>'control-label']) !!}
                    {!! Form::file('images', ['class'=>'filestyle', 'data-btnClass'=>'btn-success', 'data-text'=>'Выберите изображение', 'data-placeholder'=>$data_page["images"]]) !!}
                </div>

                <div class="form-group">
                   {!! Form::submit('Edit Page', ['class'=>'btn btn-success add_Btn']) !!}
               </div>



            {!! Form::close() !!}

            @endif

        </div>
    </div>

</div>
