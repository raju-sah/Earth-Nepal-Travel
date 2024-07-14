@extends('layouts.master')
@section('title', 'Edit Common FAQ')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.common-faqs.index')}}" model="CommonFaq" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.common-faqs.update', $common_faq->id)}}" method="POST">
                    @method('PATCH')
                    <x-form.input type="text" label="Question" :req="true" id="question" name="question" value="{{$common_faq->question}}"/>
                    <x-form.textarea label="Answer" id="answer" :req="true" name="answer" value="{{$common_faq->answer}}" rows="5" cols="5"/>
                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes"
                                     :isChecked="$common_faq->status ? 'checked' : ''"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CommonFaqUpdateRequest') !!}

@endpush
