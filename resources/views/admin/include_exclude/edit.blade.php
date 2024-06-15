@extends('layouts.master')
@section('title', 'Edit Include Exclude')
@section('content')

    <div class="container-xxl">

        <ul class="nav nav-pills nav-fill mb-3">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('admin.packages.edit', $package->id)}}">Package</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.itineraries.create', $package->id)}}">Itinerary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.itinerary-details.create', $package->id)}}">Itinerary Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active">Include Exclude</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.packages-gallery.create', $package->id)}}">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.package_faqs.create', $package->id)}}">FAQ's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.essential-infos.create', $package->id)}}">Essential Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.equipment.create', $package->id)}}">Equipments</a>
            </li>
        </ul>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.packages.include-excludes.update',[$package->id, $include_exclude->id])}}" method="POST">
                    @method('PATCH')
                    <x-form.textarea label="Includes" id="includes" name="includes" value="{!! $include_exclude->includes !!}" :tooltip="true" tooltip_text="Please use list item"
                                     rows="5" cols="5"/>
                    <x-form.textarea label="Excludes" id="excludes" name="excludes" value="{!! $include_exclude->excludes !!}" :tooltip="true" tooltip_text="Please use list item"
                                     rows="5" cols="5"/>

                    <div class="d-flex justify-content-between">
                        <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                        <button class="btn btn-danger btn-sm mt-3 delete-repeating-item" data-item-id="{{$include_exclude->id}}"><i class='bx bx-xs bx-trash'></i>Delete</button>
                    </div>

                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    @include('_helpers.ck_editor', ['textarea_id' => 'includes'])
    @include('_helpers.ck_editor', ['textarea_id' => 'excludes'])
    @include('_helpers.delete_repeating_item', ['model' => 'IncludeExclude'])
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $(document).on('refreshPage', function () {
            location.reload();
        });
    </script>
@endpush
