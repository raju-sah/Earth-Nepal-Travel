@props([
'download_path' => '',
'route' => ''
])

<button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add-excel">
    <i class='bx bx-xs bx-import'></i> Import Excel
</button>

<div class="modal fade" id="add-excel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <a class="btn btn-sm btn-success text-white" href="{{ $download_path }}" download>
                    <i class="bx bx-xs bxs-download"></i> Download Sample
                </a>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <x-form.wrapper :action="$route" method="POST" id="excel-import-form" enctype="multipart/form-data">
                <div class="modal-body pb-3">
                    <x-form.input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" label="import" :req="true" id="excel" name="excel" alt="excel" />
                    <x-form.button class="btn btn-sm btn-dark" type="submit">
                    <i class='bx bx-xs bx-import'></i> Import
                    </x-form.button>
                </div>
            </x-form.wrapper>
        </div>
    </div>
</div>
