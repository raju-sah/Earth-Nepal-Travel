<li class="{{$menuItem->parent_id!== null? 'sub-dropdown' : ''}}">
    <a target="{{$menuItem->target}}" class="top-a"
        href="{{ $menuItem->is_clickable? url($menuItem->url): 'javascript:;' }}">{{ $menuItem->title }}
        @if ($menuItem->children->isNotEmpty())
        <span class="caret"></span>
        @endif
    </a>

    @if ($menuItem->children->isNotEmpty())
    <ul class="dropdown-menu {{$menuItem->parent_id === null? 'dropdown-submenu' : ''}}">
        @foreach ($menuItem->children as $child)
        <li class="{{$child->parent_id!== null? 'sub-dropdown' : ''}}">
            @if($child->children->isEmpty())
            <a target="{{$child->target}}" href="{{ $child->is_clickable? url($child->url): 'javascript:;'  }}">{{
                $child->title }}</a>
            @endif
            @if ($child->children->isNotEmpty())
            @include('front._menu._link', ['menuItem' => $child, 'level' => $level + 1])
            @endif
        </li>
        @endforeach
    </ul>
    @endif
</li>

{{-- HOW TO USE IT--}}

{{--
    <div class="navbar navbar-default" role="navigation" style="display:block;">
    @php
        $menus = \App\Models\Menu::tree(1);
    @endphp
    <div class="side_nav">
        <ul class="nav navbar-nav" style="align-items: center;">

        @foreach($menus as $menu)
            @include('common_blade.front-menu-item', ['menuItem' => $menu, 'level' => 0])
        @endforeach

        </ul>
    </div>
--}}

{{-- CSS CHANGES
    
    .navbar-default ul.navbar-nav li:hover > ul.dropdown-menu {
    visibility: visible;
    opacity: 1;
    transition: all 0.5s;
    -moz-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -o-transition: all 0.5s;
    /* transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -webkit-transform: scale(1); */
}
.navbar-default ul.navbar-nav li:hover > ul.dropdown-menu .sub-dropdown {
position: relative;

&:hover {
        >.dropdown-submenu {
        display: block;
        opacity: 1;
        left: 100%;
        top: 0;
        }
    }
} --}}


