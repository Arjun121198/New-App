@component('mail::message')

# Introduction

The body of your message.
<h3>Successfully Registered</h3>
<img src="{{asset('img/undraw_rocket.svg')}}" alt="" width="300" style="height:auto;display:block;" />
@component('mail::button', ['url' => 'http://localhost:8000/customerview'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}\




@endcomponent
