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
            <h2> ALl Pages</h2>
            <hr>
            @if($all_page)
                <div class="table-responsive">
                <table class="table tableH">
                    <thead >
                        <tr>
                            <th>#</th>
                            <th>Имя страници</th>
                            <th>Псевдоним страници</th>
                            <th>Текст</th>
                            <th>Дата создания</th>
                            <th>Удалить</th>
                        </tr>
                    </thead>
                    <tbody>
                           @foreach($all_page as $item)
                               <tr>
                                   <td>{{ $item->id }}</td>
                                   <td>{{ link_to_route('editPage', $item->name, ['id'=>$item->id], ['alt'=>$item->name]) }}</td>
                                   <td>{{ $item->alias }}</td>
                                   <td>{{ $item->text }}</td>
                                   <td>{{ $item->created_at }}</td>
                                   <td>
                                       {!! Form::open(['route'=>['deletePage', $item->id], 'class'=>'form-group']) !!}

                                       {!! Form::hidden('action', 'delete') !!}

                                       {!! Form::submit('X',['class'=>'btn btn-success']) !!}

                                       {!! Form::close() !!}
                                   </td>

                               </tr>
                           @endforeach

                    </tbody>
                </table>
                </div>
            @endif


        </div>
    </div>

</div>