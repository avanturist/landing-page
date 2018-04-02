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
            <h2> Edit Portfolio</h2>
            <hr>
        @if(isset($oldData))
            @foreach($oldData as $item )

            {!! Form::open(['route' => ['editPortfolio',$item->id], 'files' => true]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Название портфолио:', ['class'=>'form-label']) !!}
                    {!! Form::text('name',$item->name,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('filter', 'Название фильтра:', ['class'=>'form-label']) !!}
                    {!! Form::text('filter',$item->filter,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('old_img', 'Старое изображение:', ['class'=>'form-label']) !!}
                    {!! Html::image('assets/img/'.$item->images, $item->images, ['class'=>'img-responsive', 'width'=>'20%']) !!}
                    {!! Form::hidden('old_img', $item->images) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('images','Изображение',['class'=>'form-label']) !!}
                    {!! Form::file('images',['class'=>'filestyle', 'data-btnClass'=>'btn btn-primary', 'data-text'=>'Выберите изображение', 'data-placeholder'=>'Файл незагружен!' ]) !!}
                </div>

            {!! Form::submit('Edit Portfolio',['class'=>'btn btn-primary']) !!}
            @endforeach
        @endif
        </div>
    </div>

</div>