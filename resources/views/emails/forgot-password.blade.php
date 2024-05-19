<div style="border: 3px solid green; padding: 15px; background: lightgreen; width:600px; margin: auto">
    <h3>Hi {{ $customer->name }}</h3>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam quis et natus cupiditate, illo pariatur incidunt cumque non laudantium obcaecati dicta nostrum rerum qui repudiandae id sint. Id, obcaecati dolores.
    </p>

    <p>
        <a href="{{ route('account.reset_password', $token) }}" style="display: inline-block; padding: 7px 25px; color: #fff; background: darkblue">Click here to get new password</a>
    </p>

</div>
