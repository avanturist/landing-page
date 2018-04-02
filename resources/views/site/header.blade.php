<div class="container">
    <div class="header_box">
        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"></a></div>
        @if(isset($menu))

                    <nav class="navbar navbar-inverse" role="navigation">
                        <div class="navbar-header">
                            <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        <div id="main-nav" class="collapse navbar-collapse navStyle">
                            <ul class="nav navbar-nav" id="mainNav">
                                @foreach($menu as $value)
                                    {{--{{print_r($menu)}}--}}
                                    <li ><a style="float:left" href="#{{ $value['alias'] }}" class="scroll-link">{{$value['name'] }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </nav>

        @endif

    </div>

</div>

@if(session('status'))
    <div class="alert alert-danger">
       {{ session('status', 'Send Email') }}
    </div>
@endif

@if($errors)
    <ul>
    @foreach($errors->all() as $error)
        <li class="alert alert-danger">{{ $error }}</li>
    @endforeach
    </ul>
@endif
