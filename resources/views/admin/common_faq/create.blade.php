@extends('layouts.master')
@section('title', 'Create Common FAQ')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.common-faqs.index')}}" model="Common Faq" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.common-faqs.store')}}" method="POST">
                    <x-form.input type="text" :req="true" label="Question" id="question" name="question" value="{{ old('question') }}"/>
                    <x-form.textarea label="Answer" :req="true" id="answer" name="answer" value="{{ old('answer') }}" rows="5" cols="5"/>
                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CommonFaqRequest') !!}
@endpush
