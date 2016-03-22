
<form action="{{ route('searchsite') }}" class="navbar-form navbar-search" role="search">
    <div class="row">
        <div class="col-md-1">
                <span class="glyphicon glyphicon-search flip" style="color:#fff; width: 100%;"></span>
        </div>
        <div class="col-md-11">
            <div class="row search-panel">
                <div class="col-md-12" id="search-text">
                    <input type="text" width="100%" style="width:100%; height:100%; display:none;" class="form-control search-text" required id="query" name="query" placeholder="Search for restaurant... name or location">
                </div>
            </div>
        </div>
    </div>
</form>
