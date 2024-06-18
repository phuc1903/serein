@props(['title' => env('APP_NAME')])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-links.css-link/>
    
    <title>{{ $title }}</title>
</head>

<body>

    <x-layouts.header/>

    {{ $slot }}

    <x-layouts.footer/>

    @php
        $notifications = [
            'success' => ['Thành công!', 4000],
            'error' => ['Có lỗi!', 4000],
            'info' => ['Info!', 3000],
            'warning' => ['Cảnh báo!', 5000],
        ];
    @endphp

    @foreach ($notifications as $type => $details)
    @session($type)
        <x-notifications.notification  
            timeOut="{{ $details[1] }}" 
            typeNoti="{{ $type }}"
            title="{{ $details[0]}}"
            active="{{ Session::has($type) }}" 
            message="{{ Session::get($type) }}"
        />
    @endsession
    @endforeach
</body>

</html>