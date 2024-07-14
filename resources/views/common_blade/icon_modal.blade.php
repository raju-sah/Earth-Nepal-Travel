<button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#add"><i class="bx bx-xs bx-plus"></i> Add Icon</button>

<div class="modal fade" id="add" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="modalCenterTitle">Add Icon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <x-form.wrapper action="{{route('admin.icons.store')}}" method="POST" id="icon-form" enctype="multipart/form-data">
                <div class="modal-body pb-3">
                    <x-form.input type="text" label="Name" :req="true" id="name" name="name" value="{{ old('name') }}"/>
                    <x-form.input type="file" label="Image" :req="true" id="image" name="image" alt="image" accept="image/*" :tooltip="true"
                                  tooltip_text="Please Upload SVG Icon" onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb"/>
                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </div>
            </x-form.wrapper>
        </div>
    </div>
</div>
