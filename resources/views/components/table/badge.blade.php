@props([
    'value' => null,
    'label_true' => 'Yes',
    'label_false' => 'No',
])

<span class="px-4 badge badge-center bg-{{ $value === 1 ? 'success' : 'danger' }}">
    {{ $value === 1 ? $label_true : $label_false }}
</span>
