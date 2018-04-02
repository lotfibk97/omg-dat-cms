@component('mail::message')

     Hello {{ $name }},
    <p>
     Welcome in Omg-Dat-Cms, Your signup process has been initiated. In order to
     complete the regristration please click in the link below :
    </p>

  <a href="{!!route('confirmation',['token' => $token])!!}">
      Confirm Account Now
  </a>

      Hope you enjoy easiness in managing content, and don't hesitate to scream
      loudly "OH MY GOD THAT CMS IS AMASING"
     <br>
     <br>
      {{ config('app.name') }} Team
      @endcomponent
