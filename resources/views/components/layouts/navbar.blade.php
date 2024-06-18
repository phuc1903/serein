<div class="navbar">
    <ul>
        <x-links.nav-link href="{{ route('home') }}" :active="request()->is('/')">Home</x-links.nav-link>
        <x-links.nav-link href="{{ route('shop') }}" :active="request()->is('shop*')">Shop</x-links.nav-link>
        <x-links.nav-link href="{{ route('about') }}" :active="request()->is('about')">About</x-links.nav-link>
        <x-links.nav-link href="{{ route('contact') }}" :active="request()->is('contact')">Contact</x-links.nav-link>
        <!-- <li><a href="posts">Posts</a></li> -->
    </ul>
</div>