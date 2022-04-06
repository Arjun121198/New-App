@component('mail::message')  
The body of your message. 
 <h3>Admin Register Your mail.</h3>
 <h3>Your Email Id is {{$details['email']}}</h3>
 <h3>Your Password is {{$details['password']}}</h3>
@component('mail::panel')
Email : {{$details['email']}}
@endcomponent
   
Thanks,<br>
{{ config('app.name') }}
@endcomponent
