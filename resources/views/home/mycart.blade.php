<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        .div_design {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        table {
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }

        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: bold;
            background-color: black;
        }

        td {
            border: 1px solid skyblue;

        }
        .cart_value{
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }
        .order_design{
            padding-right: 100px;
            margin-top: -20px;
        }
        label
        {
            display: inline-block;
            width: 150px;

        }
        .div_gap{
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="hero_area">

        @include('home.header')

            </div>
        <div class="div_design">
            <table>
                <tr>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th></th>
                </tr>
                <?php
                $value = 0;
                ?>
                @foreach ($cart as $cart)
                <tr>
                        <td>{{ $cart->product->title }}</td>
                        <td>{{ $cart->product->price }}</td>
                    <td>
                        <img width="150" src="/products/{{ $cart->product->image }}">
                    </td>
                    <td><a class="btn btn-danger" href="{{url('delete_cart',$cart->id)}}">Remove</a></td>
                </tr>
                <?php
                $value = $value + $cart->product->price;
                ?>
                @endforeach
            </table>
        </div>
        <div class="cart_value">
            <h3>Total Price: ${{ $value }}</h3>
        </div>
            <div class="order_design" style= "display:flex;justify-content:center; align-items:center;">
                <form action="{{url('confirm_order')}}" method="post">
                    @csrf
                    <div class="div_gap">
                        <label for="">Receiver Name</label>
                        <input type="text" name="name" value="{{Auth::user()->name}}"></input>
                    </div>
                    <div class="div_gap">
                        <label for="">Receiver Address</label>
                        <textarea name="address">{{Auth::user()->address}}</textarea>
                    </div>
                    <div class="div_gap">
                        <label for="">Receiver Phone</label>
                        <input type="text" name="phone" value="{{Auth::user()->phone}}"></input>
                    </div>
                    <div class="div_gap">
                        <input class="btn btn-primary" type="submit" value="Cash On Delivary"></input>
                        <a class="btn btn-success" href="{{url('stripe', $value )}}">Pay Using Card</a>
                    </div>
                </form>
            </div>

        @include('home.footer')
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
