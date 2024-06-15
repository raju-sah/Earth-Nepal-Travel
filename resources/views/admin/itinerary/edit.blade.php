@extends('layouts.master')
@section('title', 'Edit Itinerary')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.itineraries.index')}}" model="Itinerary" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.itineraries.update', $itinerary->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <x-form.input type="text" label="Title" id="title" name="title" value="{{$itinerary->title}}"/>
                    <x-form.input type="text" label="Slug" id="slug" name="slug" value="{{$itinerary->slug}}"/>
                    <x-form.input type="text" label="Day" id="day" name="day" value="{{$itinerary->day}}"/>
                    <x-form.textarea label="Description" id="description" name="description" value="{{$itinerary->description}}" rows="5" cols="5"/>
                    <x-form.input type="text" label="Max_altitude" id="max_altitude" name="max_altitude" value="{{$itinerary->max_altitude}}"/>
                    <x-form.input type="text" label="Meals" id="meals" name="meals" value="{{$itinerary->meals}}"/>
                    <x-form.input type="text" label="Accommodation" id="accommodation" name="accommodation" value="{{$itinerary->accommodation}}"/>
                    <x-form.input type="text" label="Transportation" id="transportation" name="transportation" value="{{$itinerary->transportation}}"/>
                    <x-form.input type="text" label="Order" id="order" name="order" value="{{$itinerary->order}}"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ItineraryUpdateRequest') !!}

@endpush
