@extends('layouts.master')
@section('title', 'Edit Season')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.seasons.index')}}" model="Season" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.seasons.update', $season->id)}}" method="POST">
                    @method('PATCH')

                    <x-form.enum-select label="Season Type" :req="true" :model="$season->type" :options="\App\Enums\SeasonType::cases()" name="type"></x-form.enum-select>

                    <x-form.row>
                        <x-form.enum-select label="Starting Month" :req="true" col="6" :model="$season->starting_month" :options="\App\Enums\MonthType::cases()"
                                            name="starting_month"></x-form.enum-select>
                        <x-form.enum-select label="Ending Month" :req="true" col="6" :model="$season->ending_month" :options="\App\Enums\MonthType::cases()"
                                            name="ending_month"></x-form.enum-select>
                    </x-form.row>
                    <br>

                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$season->status ? 'checked' : ''"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\SeasonUpdateRequest') !!}
@endpush
