<button class="btn btn-sm btn-outline-info mt-3" data-bs-toggle="modal" data-bs-target="#add">
    <i class='bx bx-reply'></i>
    Reply
</button>

<div class="modal fade" id="add" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="modalCenterTitle">Send Reply</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <x-form.wrapper action="{{route('admin.email-reply')}}" method="POST" id="reply-form">
                <div class="modal-body pb-3">
                    @csrf
                    <input type="hidden" name="model" value="{{$model}}">

                    <x-form.select name="name" label="Template Name" id="name" :options="$templates" :model="'Custom Template'"/>

                    <x-form.input type="text" :req="true" label="Email Subject" id="subject" name="subject" value="{{ old('subject') }}" />

                    <x-form.textarea :req="true" label="Email Body" id="body" class="body" name="body" value="{{ old('body') }}" rows="5" cols="5" />

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-mail-send bx-xs'></i> Send</x-form.button>
                </div>
            </x-form.wrapper>
        </div>
    </div>
</div>

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EmailTemplateStoreRequest') !!}

    <script>
        let editorInstance;

        function initializeCKEditor() {
            return ClassicEditor
                .create(document.querySelector("#body"), {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'MediaEmbed'],
                })
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        }

        $(document).ready(function () {
            $('#name').change(function () {
                let template_id = $(this).val();

                $.ajax({
                    url: "{{ route('admin.fetch-email-template') }}",
                    type: 'GET',
                    data: {
                        template_id: template_id,
                    },
                    success: function (response) {
                        if (editorInstance) {
                            editorInstance.setData(response.data.body);
                        } else {
                            initializeCKEditor().then(() => {
                                editorInstance.setData(response.data.body);
                            });
                        }

                        $('#subject').val(response.data.subject);
                    }
                });
            });
        });
    </script>
@endpush
