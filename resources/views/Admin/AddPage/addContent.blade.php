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
            <h2> ADD Page</h2>
            <hr>


            {!! Form::open(['route'=>'addPage', 'files'=>true ]) !!}

                <div class="form-group">
                    {!! Form::label('Название Страници:',null,['class'=>'control-label']) !!}
                    {!! Form::text('name', old("name") ,['class'=>'form-control']) !!}
                    @if($errors->has('name'))
                        <small class="danger">{{ $errors->first('name') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('Пвсевдоним:',null,['class'=>'control-label']) !!}
                    {!! Form::text('alias', old("alias") ,['class'=>'form-control']) !!}
                    @if($errors->has('alias'))
                        <small class="danger">{{ $errors->first('alias') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('Content:',null,['class'=>'control-label']) !!}
                    {!! Form::textarea('text', old("text") ,['id'=>'editor','class'=>'form-control']) !!}
                    @if($errors->has('text'))
                        <small class="danger">{{ $errors->first('text') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('Изображение', null, ['class'=>'control-label']) !!}
                    {!! Form::file('image', ['class'=>'filestyle', 'data-Text'=>'Выберите изображение', 'data-btnClass'=>'btn-primary', 'data-placeholder'=>'Файла нет!'])  !!}



                </div>

            <div class="form-group">
                    {!! Form::submit('Add Page', ['class'=>'btn btn-success add_Btn']) !!}
                </div>

            {!! Form::close() !!}



        </div>
    </div>

</div>