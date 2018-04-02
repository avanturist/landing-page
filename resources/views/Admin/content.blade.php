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


                <a class="cursor" onclick="myPortfolio()"><span><i class="fa fa-briefcase"></i> Портфоліо</span>
                    <ul class="second_menu" id="portfolio" >
                       <li><a href="{{ route('portfolios') }}">All Portfolio</a></li>
                        <li><a href="">Add Portfolio</a></li>
                    </ul>

                </a>
                <a href=""><span><i class="fa fa-wrench"></i> Сервіси</span></a>

            </div>
        </div>
        <div class="col-md-10 content">
            <h2>Welcome on Admin Page  </h2>
            <h4>Something News</h4>
            <p id="test"></p>


            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

        </div>
    </div>

</div>
