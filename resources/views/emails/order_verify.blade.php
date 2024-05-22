<div style="border: 3px solid green; padding: 15px; background: lightgreen; width:600px; margin: auto">
    <h3>Hi {{ $order->customer->name }}</h3>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam quis et natus cupiditate, illo pariatur incidunt cumque non laudantium obcaecati dicta nostrum rerum qui repudiandae id sint. Id, obcaecati dolores.
    </p>

    <h4>Your order detail</h4>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>STT</th>
            <th>Product name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub Total</th>
        </tr>
        <?php $total = 0;?>
        @foreach ($order->details as $detail)
        <tr>
            <th>{{ $loop->index + 1 }}</th>
            <th>{{ $detail->product->name }}</th>
            <th>{{ $detail->price }}</th>
            <th>{{ $detail->quantity }}</th>
            <th>{{ number_format($detail->price * $detail->quantity) }}</th>
        </tr>
        <?php $total += $detail->price * $detail->quantity;?>
        @endforeach
        <tr>
            <th colspan="4">Taotal price</th>
            <th>{{ number_format($total) }}</th>
        </tr>
    </table>

    <p>
        <a href="{{ route('order.verify', $token) }}" style="display: inline-block; padding: 7px 25px; color: #fff; background: darkblue">Click here to verify order</a>
    </p>

</div>
