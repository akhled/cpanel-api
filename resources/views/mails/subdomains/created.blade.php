@component('mail::message')
# Domain was created successfully

@component('mail::table')
| Key | Value |
| ------------- |:-------------:|
| Domain | {{ $domain }} |
| Subdomain | {{$subdomain}}.{{ $domain }} |
| Path | {{ $path }} |
@endcomponent

@component('mail::panel')
The SSL certificate could take sometime to be active
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent