<div class="sidebar-heading"><h2>{{ __('Blog') }}</h2></div>
<div class="list-group list-group-flush">
    @foreach(config('menu.menu') as $menu)
        <a href="{{ url($menu['url']) }}" class="list-group-item list-group-item-action bg-light">{{ __($menu['text']) }}</a>
    @endforeach
</div>
