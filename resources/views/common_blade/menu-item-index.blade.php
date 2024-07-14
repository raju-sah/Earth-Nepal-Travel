<style>
    .parent-item, .child-item {
        color: #333;
    }

    .parent-item ul {
        position: relative;
        list-style: none;
        padding: 10px 40px;

        &::before {
            position: absolute;
            height: 100%;
            width: 3px;
            background: #929292;
            content: '';
            left: 20px;
            top: 0;
        }

        li {
            position: relative;
            margin: 10px 0 0;
            padding-left: 20px;

            &::before {
                position: absolute;
                width: 15px;
                height: 15px;
                background: #0C83F1;
                border: 2px solid #fff;
                content: '';
                left: -26px;
                top: 2px;
                margin: auto;
                z-index: 1;
            }

            &::after {
                position: absolute;
                height: 3px;
                width: 30px;
                background: #929292;
                content: '';
                left: -20px;
                top: 7.5px;
                z-index: 0;
            }
        }
    }

    .parent-item ul .position-absolute {
        left: -20px;
    }

</style>
<div class="{{ $menuItem->children->isNotEmpty() ? 'parent-item' : 'child-item' }}">
    {{ $menuItem->title }}

    @if ($menuItem->children->isNotEmpty())
        <ul class="list-unstyled">
            @foreach ($menuItem->children as $child)
                <li>
                    @include('common_blade.menu-item-index', ['menuItem' => $child, 'level' => $level + 1])
                </li>
            @endforeach
        </ul>
    @endif
</div>
