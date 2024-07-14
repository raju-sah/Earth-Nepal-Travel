<button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#add"><i class='bx bx-up-arrow-circle'></i>Import Excel</button>

<div class="modal fade" id="add" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <x-form.button col="3" class="btn btn-sm btn-dark " style="margin-top: 0 !important;">
                    <a class="text-white" href="/excel/packages-sample.xlsx" download>
                        <i class="bx bxs-download text-white"></i> Download Sample
                    </a>
                </x-form.button>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <x-form.wrapper action="{{ route('admin.packages.import-excel') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body pb-3">
                    <x-form.input type="file" label="import" id="excel" name="excel" alt="excel" />
                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-up-arrow-circle'></i>Import</x-form.button>
                </div>
            </x-form.wrapper>
        </div>
    </div>
</div>


