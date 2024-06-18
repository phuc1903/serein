@props(['active' => false])

<a {{ $attributes }} @class(['header__admin-item','active' => $active]) >
    <span class="heeader__admin-item-content">{{ $slot }}</span>
</a>
