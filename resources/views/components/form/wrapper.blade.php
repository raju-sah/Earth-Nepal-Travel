@props([
  'method' => 'POST',
  'action'
])

<form action="{{$action}}" method="{{$method}}" {{ $attributes }} id="form">
    @csrf

    {{ $slot }}
</form>
