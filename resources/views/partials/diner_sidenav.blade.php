<ul>
    <li>
        <a href="#"><i class='fa fa-sliders'></i>Reservations</a>
        <ul>
            <li><a href="{{url('reservations/current')}}">Current</a></li>
            <li><a href="{{url('reservations/past')}}">Past </a></li>
            <li><a href="{{url('reservations/cancelled')}}">Cancelled</a></li>
        </ul>
    </li>
    <li>
        <a href="#"> <i class='fa fa-circle-o'></i> Restaurants</a>
        <ul>
            <li><a href="{{url('restaurants/visited')}}">Restaurants visited</a></li>
        </ul>
    </li>
    <li>
        <a href="#"><i class='fa fa-user'></i> My Accont</a>
        <ul>
            <li>  <a href="{{url('user/profile/edit')}}">Account Settings</a></li>
        </ul>
    </li>
</ul>
