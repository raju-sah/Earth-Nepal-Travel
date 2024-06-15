@props([
    'menu'
])

<tr>
    <td>{{ $menu->title }} ({{ $menu->id }})</td>
</tr>

@if (optional($menu->children)->isNotEmpty())
    @foreach ($menu->children as $child)
        <tr>
            <td style="padding-left: 20px;">
                <x-table.menu :menu="$child"/>
            </td>
        </tr>
    @endforeach
@endif
