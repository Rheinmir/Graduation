@extends('master.main')

@section('main')
    <!-- main-area -->
    <main>
        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Order checkout</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order checkout</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- contact-area -->
        <section class="contact-area">

            <div class="contact-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input name="name" value="{{ $auth->name }}" type="text" class="form-control" placeholder="Your Name *" required>
                                    @error('name')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input name="email" value="{{ $auth->email }}"  type="email" class="form-control" placeholder="Your Email *" required>
                                    @error('email')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input name="phone" type="text" value="{{ $auth->phone }}"  class="form-control" placeholder="Your phone *" required>
                                    @error('phone')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input name="address" type="text" value="{{ $auth->address }}"  class="form-control" placeholder="Your address *" required>
                                    @error('address')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <br>
                                <button type="submit">Place Order</button>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($carts as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>
                                                <img src="uploads/product/{{ $item->prod->image }}" width="40">
                                            </td>
                                            <td>{{ $item->prod->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                {{ $item->quantity }}
                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->

@stop()
