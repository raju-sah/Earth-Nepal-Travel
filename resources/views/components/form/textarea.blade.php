@props([
'id' => $name,
'label' => 'Label',
'class' => 'form-control text-14',
'value' => '',
'type' => 'text',
'message' => '',
'col' => '12',
'req' => false,
'tooltip' => false,
'tooltip_text' => 'Tooltip on top',
'name'
])

<div class="col-md-{{$col}}">
    <label for="{{$id}}" class="col-form-label">{{$label}} @if($req === true)
        <span class="text-danger">*</span>
        @endif

        @if($tooltip === true)
        <i class='bx bx-xs bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="{{$tooltip_text}}"></i>
        @endif
    </label>

    <textarea name="{{$name}}" id="{{$id}}" {{ $attributes->merge(['class' => $class . ' form-control text-14']) }}>{{$value}}</textarea>
    @error($name) <span class="text-danger small">{{ $message }}</span> @enderror
</div>