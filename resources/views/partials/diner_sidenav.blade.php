<ul class="nav nav-pills nav-stacked nav-side">
    <li role="presentation" class="active" >
        <a role="button" data-toggle="collapse" href="#ActivitiesSubMenu" aria-expanded="false" aria-controls="ActivitiesSubMenu">
            <i class='fa fa-list'></i> Reservations
        </a>
        <ul id="ActivitiesSubMenu" class="collapse" >
            <li><a href="{{url('reservations/current')}}">Current</a></li>
            <li><a href="{{url('reservations/past')}}">Past </a></li>
            <li><a href="{{url('reservations/cancelled')}}">Cancelled</a></li>
        </ul>
    </li>
    <li>
        <a href="{{ route('userProfile', ['username' => auth()->user()->username]) }}"><i class='fa fa-user'></i> My Account</a>
        <ul>
            <li>  <a href="{{url('user/profile/edit')}}">Account Settings</a></li>
        </ul>
    </li>
</ul>
