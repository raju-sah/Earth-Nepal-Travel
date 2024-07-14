@extends('layouts.master')
@section('title', 'Create Season')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.seasons.index')}}" model="Season" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.seasons.store')}}" method="POST">
                    <x-form.enum-select label="Season Type" :options="\App\Enums\SeasonType::cases()" :req="true" name="type"></x-form.enum-select>

                    <x-form.row>
                        <x-form.enum-select label="Starting Month" :options="\App\Enums\MonthType::cases()" :req="true" col="6" name="starting_month"></x-form.enum-select>
                        <x-form.enum-select label="Ending Month" :options="\App\Enums\MonthType::cases()" :req="true" col="6" name="ending_month"></x-form.enum-select>
                    </x-form.row>

                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\SeasonRequest') !!}
@endpush
