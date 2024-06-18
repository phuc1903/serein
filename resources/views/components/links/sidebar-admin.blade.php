@props(['active' => false])

<a {{ $attributes }} @class(['header__admin-item','active' => $active]) >
    <p class="header__admin-item-icon"></p>
    <span class="heeader__admin-item-content">{{ $slot }}</span>
</a>
