@props(['id' => $id ?? '', 'options' => [], 'selected' => ''])

<select name="status" class="form-control" data-id="{{ $id }}">
    @foreach ($options as $key => $value)
        <option value="{{ $key }}" {{ $key == $selected ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>

