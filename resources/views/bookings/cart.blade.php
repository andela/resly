@extends('layouts.master')

@section('title', 'Results')

@section('styles')
@endsection

@section('content')
    @include ('partials.alerts');
    <div class="row">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="container">

        <div class="col-lg-9 white">
            <table class='table'>
                <thead>
                    <tr>
                        <th>Table name</th>
                        <th>Cost</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::getContent() as $index=>$item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>$ {{$item->price}}</td>
                            <td><a href="{{url('/cart/delete/'.$item->id)}}"><i class='fa fa-times'></i></a></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>Total:</td>
                        <td colspan="2" >$ {{Cart::getTotal()}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <form action="{{url('cart/checkout')}}" method="POST">
                              <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_Foyuar1MpesypxunpJrRw5Yv"
                                data-amount="{{Cart::getTotal()*100}}"
                                data-name="Resly"
                                data-description="{{Cart::getTotalQuantity()}} Items in cart ({{'$'.number_format(Cart::getTotal(), 2)}})"
                                data-image="{{asset('img/money_icon.png')}}"
                                data-locale="auto">
                              </script>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript" src='{!! asset('js/jquery.datetimepicker.full.min.js') !!}'></script>
    <script type="text/javascript">
    jQuery('.bookDate').datetimepicker({
        format:'d.m.Y H:i',
        lang:'eng'
    });
    </script>
@endsection
