@extends('dashboard.index')

@section('title', 'Results')


@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Checkout</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class='col col-md-12'>
                    @if(Cart::getTotalQuantity() == 0)
                        <div class='not-available-label'>
                            <h3><i class="fa fa-shopping-cart"></i> You have no item in your cart</h3>
                        </div>
                    @else
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
