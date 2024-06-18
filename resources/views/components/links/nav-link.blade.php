@props(['active' => false])

<li><a {{ $attributes }} @class(['active' => $active]) href="index.html"> {{ $slot }}</a></li>