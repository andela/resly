<link rel="stylesheet" type="text/css" href="{{asset('css/navbar-search.css')}}">
<div class="search-form">
    <form action="{{ route('searchsite') }}" class="navbar-form" role="search">
        <div class="row search-row">
            <div class="col-md-1 search-left">
                <span class="glyphicon glyphicon-search search-icon" style="color:#fff; width: 100%;"></span>
            </div>
            <div class="col-md-11 search-right">
                <input type="text" width="100%" style="width:100%; height:100%;" class="form-control search-text" required id="query" name="query" placeholder="">
            </div>
        </div>
    </form>
</div>
