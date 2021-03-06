<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.elements.head')
</head><!--/head-->

<body>
<!--header-->
    <header id="header">
    <!--header_top-->
        <div class="header_top">
            @include('pages.elements.header-top')
        </div>
    <!--/header_top--> 
    <!--header-middle-->
        <div class="header-middle">
            @include('pages.elements.header-middle')
        </div>
    <!--/header-middle-->
    <!--header-bottom-->
        <div class="header-bottom">
            @include('pages.elements.header-bottom')
        </div>
    <!--/header-bottom-->
    </header>
<!--/header-->

    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 padding-right">
                    <section id="cart_items">
                        <div class="container">
                            <div class="breadcrumbs">
                                <ol class="breadcrumb">
                                  <li><a href="#">Home</a></li>
                                  <li class="active">Shopping Cart</li>
                                </ol>
                            </div>
                        
                            <table class="table">
                                <thead class="thead">
                                  <tr style="background-color: black; color: white">
                                    <th scope="col">#</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Cập nhật</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Xóa</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $stt = 0;
                                        $folder = "public/customers/images/"; 
                                        $content = Cart::content();
                                    @endphp
                                   @foreach ($content as $item)
                                   <?php $stt++ ?>
                                       <tr>
                                            <td>{{ $stt }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <img src="{{ $folder. $item->options->image }}" alt="" style="width: 70px; height: 50px;">
                                            </td>
                                            <td>{{ number_format($item->price) }} đ.</td>
                                            <form action="{{ Route('updateCart') }}" method="post">
                                                <td>
                                                @csrf
                                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                                <input type="number" class="form-control qty" value="{{ $item->qty }}" style="width: 70px;" name="qty_cart">
                                                <input class="form-control" type="hidden" value="{{ $item->rowId }}" name="rowIdCart">
                                                
                                                </td>
                                                <td>
                                                    <button type="submit" style="margin-top: 2px" class="btn btn-primary">Cập nhật</button>
                                                </td>
                                            </form>
                                            <td>
                                                <?php 
                                                    $tongtien = $item->price*$item->qty;
                                                    echo number_format($tongtien);  
                                                ?>
                                            </td>
                                            <td><a style="margin-top: 2px" href="{{ URL::to('delete-cart/'. $item->rowId) }}" class="btn btn-primary">Xóa</a> </td>
                                       </tr>
                                   @endforeach
                                  
                                </tbody>
                              </table>
                            @if ( Session::has('Thanhtoan') )
                                <p style="color: red; text-align: center; margin-top: 20px;">{{ Session::get('Thanhtoan') }}</p>   
                            @endif
                        </div>
                    </section> <!--/#cart_items-->

                    <section id="do_action">
                        <div class="container">
                           
                            <div class="row">
                            <form action="{{ Route('payment') }}" method="post">
                                    @csrf
                                <div class="col-sm-6">
                                    <div class="total_area" style="border: none; margin-top: 30px">
                                        <ul>
                                            <li>Tổng tiền<span>{{ Cart::subtotal() }}</span></li>
                                            <li>Thuế <span>{{ Cart::tax() }}</span></li>
                                            <li>Thành tiền <span>{{ Cart::total() }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6 total_area" style="border: none; margin-top: 30px">
                                    <ul>
                                        <li>
                                            <div class="form-group">
                                                <label for="my-input">Họ và tên:</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="my-input">Email:</label>
                                                <input type="email" name="email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="my-input">Số điện thoại:</label>
                                                <input type="text" name="sdt" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="my-input">Địa chỉ:</label>
                                                <input type="text" name="address" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="my-input">Ghi chú:</label>
                                                <textarea name="notes" id="" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </li>
                                    </ul>
                                    <button class="btn btn-default update">Thanh toán</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </section><!--/#do_action-->
                
                </div>
            </div>
        </div>
    </section>

<footer id="footer"><!--Footer-->
@include('pages.elements.footer')
</footer>
<!--/Footer-->



<!--/jscrip-->
@include('pages.elements.jscrip')
{{-- <script src="{{asset('public/customers/js/my.js')}}"></script> --}}

</body>
</html>       
 