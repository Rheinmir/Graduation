<h3>Hi {{ $account->name }}</h3>

<p>
    This is your verify mail!.
</p>

<p>
    <a href="{{ route('account.verify', $account->email)}}">Click here ti verify your account</a>
</p>