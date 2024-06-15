@extends('layouts.master')
@section('title', 'Edit Package FAQ')
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
                <a class="nav-link" href="{{route('admin.packages.include-excludes.create', $package->id)}}">Include Exclude</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.packages-gallery.create', $package->id)}}">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active">FAQ's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.essential-infos.create', $package->id)}}">Essential Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.equipment.create', $package->id)}}">Equipments</a>
            </li>
        </ul>

        @include('_helpers.errors')

        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.packages.packages-faqs.update', ['package' => $package->id]) }}" method="POST">

                    @method('PATCH')

                    <div class="col-md-12">
                        <label for="common_faqs" class="col-form-label">Common Faqs</label>
                        <select id="common_faqs" name="common_faqs[]" class="common_faqs form-control" multiple>
                            @foreach($common_faqs as $key => $common_faq)
                                <option value="{{ $key }}" {{ in_array($key, old('common_faqs', []), true) || $package->common_faqs->contains($key)? 'selected' : '' }}>{{$common_faq}}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ($package->package_faqs as $index => $packageFaq)
                        <div class="form-control mb-2">
                            <x-form.input type="text" label="Question" id="question" name="question[]" value="{{ $packageFaq->question }}" :req="true" required/>
                            <x-form.textarea label="Answer" id="answer" name="answer[]" value="{{ $packageFaq->answer }}" rows="3" cols="3" :req="true" required/>
                            <x-form.select label="Status" col="12" :req="true" :options="[1 => 'Active', 0 => 'InActive']" name="status[]"
                                           :model="$packageFaq->status"></x-form.select>

                            <button class="btn btn-danger btn-sm mt-2 js-remove--field-row delete-repeating-item" data-item-id="{{$packageFaq->id}}"><i class='bx bx-xs bx-x'></i>
                            </button>
                        </div>
                    @endforeach

                    <div id="form-variations-list"></div>

                    <div class="btn-wrapper text-end position-relative">
                        <x-form.button class="btn btn-sm btn-dark position-absolute top-0 end-0" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                    </div>
                </x-form.wrapper>

                <div class="d-flex">
                    <button class="btn btn-primary mb-2 btn-sm js-add--field-row mt-3"><i class='bx bx-xs bx-plus'></i> Add Field</button>
                </div>

                <template id="template-form">
                    <div class="form-control" id="template-input-field">
                        <x-form.input type="text" label="Question" id="question" name="question[]" value="{{ old('question.${count}') }}" :req="true" required/>
                        <x-form.textarea label="Answer" id="answer" name="answer[]" value="{{ old('answer.${count}') }}" rows="3" cols="3" :req="true" required/>
                        <x-form.select label="Status" col="12" :req="true" :options="[1 => 'Active', 0 => 'InActive']" name="status[]"></x-form.select>
                    </div>
                </template>
            </div>
        </div>

    </div>

@endsection

@push('custom_js')
    @include('_helpers.delete_repeating_item', ['model' => 'PackageFaq'])
    @include('_helpers.repeater')
    <script>
        $(function () {
            $('.common_faqs').select2({
                placeholder: 'Select Common Faqs',
                tags: true
            });
        });
    </script>
@endpush
