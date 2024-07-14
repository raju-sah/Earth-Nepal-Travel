<option value="{{ $menuItem->id }}" {{ $menuItem->id == $parentId ? 'selected' : '' }}>
    {!! str_repeat('&#8227;', $level) !!}{{ ucfirst($menuItem->title) }}
</option>

@if ($menuItem->children->count())
    @foreach ($menuItem->children as $child)
        @include('common_blade.menu-item-edit', ['menuItem' => $child, 'level' => $level + 1, 'parentId' => $parentId])
    @endforeach
@endif
