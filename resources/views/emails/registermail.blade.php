@component('mail::message')
# Introduction

The body of your message.
<h3>Successfully Registered</h3>
@component('mail::button', ['url' => 'http://localhost:8000/user-dashboard'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
