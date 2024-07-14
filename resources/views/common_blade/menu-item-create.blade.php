<option value="{{ $menuItem->id }}" {{ old('parent_id') === $menuItem->id ? 'selected' : '' }}>
    {!! str_repeat('&#8227;', $level) !!}{{ ucfirst($menuItem->title) }}
</option>

@if ($menuItem->children->count())
    @foreach ($menuItem->children as $child)
        @include('common_blade.menu-item-create', ['menuItem' => $child, 'level' => $level + 1])
    @endforeach
@endif
