<ul class="nav nav-pills nav-stacked nav-side">
    <li role="presentation" class="active" >
        <a role="button" data-toggle="collapse" href="#ActivitiesSubMenu" aria-expanded="false" aria-controls="ActivitiesSubMenu">
            <i class='fa fa-sliders'></i> Reservations
        </a>
        <ul id="ActivitiesSubMenu" class="collapse" >
            <li><a href="{{url('reservations/current')}}">Current</a></li>
            <li><a href="{{url('reservations/past')}}">Past </a></li>
            <li><a href="{{url('reservations/cancelled')}}">Cancelled</a></li>
        </ul>
    </li>
    <li role="presentation">
        <a data-toggle="collapse" href="#RestaurantsSubMenu" aria-expanded="false" aria-controls="RestaurantsSubMenu">
            <i class='fa fa-circle-o'></i> My Restaurants</a>
        <ul id='RestaurantsSubMenu' class="collapse">
            <li><a href="{{url('restaurants')}}">Restaurnts list</a></li>
            <li><a href="{{url('restaurants/create')}}">New Restaurant</a></li>
            <li><a href="#">Manage Restaurants</a></li>
        </ul>
    </li>
    <li >
        <a data-toggle="collapse" href="#AccountSubMenu" aria-expanded="false" aria-controls="AccountSubMenu">
            <i class='fa fa-cog'></i> My Account
        </a>
        <ul id='AccountSubMenu' class="collapse">
            <li>  <a href="{{url('user/profile/edit')}}">Account Settings</a></li>
        </ul>
    </li>
</ul>
