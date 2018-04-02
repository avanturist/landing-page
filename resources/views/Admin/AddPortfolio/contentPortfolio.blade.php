<div class="container-fluid">

    <div class="row">
        <div class="col-md-2">
            <div class="menu">
                <a href="{{ route('admin') }}"><i class="fa fa-home"></i> Home</a>

                <a class="cursor" onclick="myPage()"><span><i class="fa fa-file"></i> Сторінки</span>
                    <ul class="second_menu" id="page">
                        <li><a href="{{ route('pages') }}">All Pages</a></li>
                        <li><a href="{{ route('addPage') }}">Add Page</a></li>
                        <li><a href="{{ route('editP') }}">Edit Page</a></li>
                    </ul>

                </a>


                <a class="cursor"><span><i class="fa fa-briefcase"></i> Портфоліо</span>
                    <ul class="second_menu" >
                        <li><a href="{{ route('portfolios') }}">All Portfolio</a></li>
                        <li><a href="{{ route('addPortfolio') }}">Add Portfolio</a></li>
                    </ul>

                </a>
                <a href=""><span><i class="fa fa-wrench"></i> Сервіси</span></a>

            </div>
        </div>
            <div class="col-md-10 content">
                <h2> ADD Portfolio</h2>
                <hr>
                {!! Form::open(['route'=>'addPortfolio','files'=>true]) !!}
                    <div class="form-group">
                        {!! Form::label('name','Название портфолио:',['class'=>'control-label'] ) !!}
                        {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
                        @if($errors->has('name'))
                            <small class="danger">{{ $errors->first('name') }}</small>
                            @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('filter', 'Название фильтра:',['class'=>'control-label']) !!}
                        {!! Form::text('filter', old('filter'),['class'=>'form-control']) !!}
                        @if($errors->has('filter'))
                            <small class="danger">{{ $errors->first('filter') }}</small>
                            @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('images','Изображение',['class'=>'control-label']) !!}
                        {!! Form::file('images',['class'=>'filestyle', 'data-btnClass'=>'btn-primary', 'data-text'=>'Выберите изображение', 'data-placeholder'=>'Файл незагружен!']) !!}
                    @if($errors->has('images'))
                        <small class="danger">{{ $errors->first('images') }}</small>
                    @endif
                    </div>

                    <div class="form-group">
                        {!! Form::submit('New Portfolio',['class'=>'btn btn-success']) !!}
                    </div>


                {!! Form::close() !!}

            </div>







        </div>
    </div>

</div>