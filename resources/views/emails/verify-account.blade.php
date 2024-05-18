<h3>Hi {{ $account->name }}</h3>

<p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. At facilis amet quo, dolor ipsa doloremque accusamus incidunt laborum reprehenderit consequuntur nesciunt quod aliquid, debitis veritatis perspiciatis ipsum labore animi excepturi.
</p>

<p>
    <a href="{{ route('account.verify', $account->email)}}">Click here ti verify your account</a>
</p>