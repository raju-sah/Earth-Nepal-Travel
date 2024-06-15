@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.email-templates.index')}}" model="Email Template" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.email-templates.update', $email_template->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <x-form.input type="text" label="Name" id="name" name="name" value="{{$email_template->name}}" />
                    <x-form.input type="text" label="Subject" id="subject" name="subject" value="{{$email_template->subject}}" />
                    <x-form.enum-select :req="true" col="3" label="Smart Tags" :options="$smartTags" name="smart_tag"></x-form.enum-select>

                    <x-form.textarea label="Body" id="body" name="body" value="{!! $email_template->body !!}" rows="5" cols="5"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EmailTemplateUpdateRequest') !!}
    <script type="text/javascript" src="https://milankyncl.github.io/jquery-copy-to-clipboard/jquery.copy-to-clipboard.js"></script>
    @include('_helpers.ck_editor', ['textarea_id' => 'body'])
    @include('_helpers.swal_alert')
    <script>
        $(document).ready(function () {
            $('#smart_tag').on('change', function (e) {
                let selectedValue = e.target.value;
                $('#smart_tag').CopyToClipboard();
                swalAlert('success', 'Copied to Clipboard!');
            })
        });
    </script>
@endpush
