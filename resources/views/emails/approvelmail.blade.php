@component('mail::message')
# Introduction

The body of your message.
<h3>Your Registration has been Approved Sucessfully</h3>
<p>Click the button to Login in your Dashboard</p>
@component('mail::button', ['url' => 'http://localhost:8000/user-dashboard'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
