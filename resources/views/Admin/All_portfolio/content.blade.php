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
            <h2> ALL Portfolio</h2>
            <hr>
            <!-- Повідомлення що створене нове портфоліо -->
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                @if(isset($portfolios))
                    <div class="table-responsive">
                        <table class="table tableH">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name Portfolio</th>
                                    <th>Images</th>
                                    <th>filter</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($portfolios as $value)
                                    <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ link_to_route('editPortfolio',$value->name, ['id'=>$value->id], ['class'=>'link']) }}</td>
                                            <td>{!! Html::image('assets/img/'.$value->images, 'foto', ['class'=>'small_img']) !!}</td>
                                            <td>{{ $value->filter }}</td>
                                            <td>
                                                {!! Form::open(['route'=>['editPortfolio',$value->id]]) !!}

                                                {!! Form::hidden('action','delete') !!}

                                                {!! Form::submit('X',['class'=>'btn btn-danger']) !!}

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