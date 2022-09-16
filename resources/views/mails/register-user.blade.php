<p> Hello {{$user->name}} </p>
<p> Please Click the link bellow to verifiy your account</p>
<p> this mail will expire in {{ config('auth.verification.expire') }} Minuest</p>
<p>
    <a href="{{$signedURL}}"> Active Account</a>
</p>
