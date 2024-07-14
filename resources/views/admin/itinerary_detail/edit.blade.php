@extends('layouts.master')
@section('title', 'Itinerary Detail')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.itinerary-details.index')}}" model="ItineraryDetail" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.itinerary-details.update', $itinerary_detail->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        <x-form.input type="text" label="Icon" id="icon" name="icon" value="{{$itinerary_detail->icon}}"/>
<x-form.input type="text" label="Duration_value" id="duration_value" name="duration_value" value="{{$itinerary_detail->duration_value}}"/>
<x-form.input type="text" label="Duration_unit" id="duration_unit" name="duration_unit" value="{{$itinerary_detail->duration_unit}}"/>
<x-form.input type="text" label="Order" id="order" name="order" value="{{$itinerary_detail->order}}"/>
<x-form.input type="text" label="Package_id" id="package_id" name="package_id" value="{{$itinerary_detail->package_id}}"/>
<x-form.input type="text" label="Itinerary_id" id="itinerary_id" name="itinerary_id" value="{{$itinerary_detail->itinerary_id}}"/>

                        <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ItineraryDetailUpdateRequest') !!}
    
@endpush
