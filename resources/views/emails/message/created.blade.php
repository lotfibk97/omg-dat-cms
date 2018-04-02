@component('mail::message')

     Hello {{ $name }},
    <p>
     Your signup process has been initiated. Please click the link below to
      complete your registration and start getting paid.
    </p>

  <a href="{!!route('confirmation',['token' => $token])!!}">
      Confirm Account Now
</a>

     Thanks,<br>
          {{ config('app.name') }} Team
      @endcomponent
