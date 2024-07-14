@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.bookings.index')}}" model="Booking" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.bookings.store')}}" method="POST" enctype="multipart/form-data">
                    <x-form.row>
                        <x-form.input type="text" label="Full Name" id="name" name="name" value="{{ old('name') }}" col="6"/>
                        <x-form.input type="text" label="Email" id="email" name="email" value="{{ old('email') }}" col="6"/>
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="text" label="Phone" id="phone" name="phone" value="{{ old('phone') }}" col="6"/>
                        <x-form.input type="date" min="{{now()->format('Y-m-d')}}" label="Arrival_date" id="arrival_date" name="arrival_date" value="{{ old('arrival_date') }}"
                                      col="6"/>
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="date" min="{{now()->format('Y-m-d')}}" label="Return_date" id="return_date" name="return_date" value="{{ old('return_date') }}"
                                      col="6"/>
                        <x-form.input type="number" min="1" label="No_of_adults" id="no_of_adults" name="no_of_adults" value="{{ old('no_of_adults') }}" col="6"/>
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="number" min="1" label="No_of_child" id="no_of_child" name="no_of_child" value="{{ old('no_of_child') }}" col="6"/>
                        <x-form.input type="number" min="1" label="No_of_infant" id="no_of_infant" name="no_of_infant" value="{{ old('no_of_infant') }}" col="6"/>
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="text" label="Country" id="country" name="country" value="{{ old('country') }}" col="6"/>
                        <x-form.input type="text" label="Address" id="address" name="address" value="{{ old('address') }}" col="6"/>
                    </x-form.row>

                    <x-form.input type="text" label="Hotel Name" id="hotel_name" name="hotel_name" value="{{ old('hotel_name') }}" col="6"/>

                    <input type="hidden" name="package_id" value="1">
                    <input type="hidden" name="type" value="{{\App\Enums\BookingType::Package->value}}">

                    <x-form.textarea label="Message" id="message" name="message" value="{{ old('message') }}" rows="5" cols="5" col="12"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\BookingStorePackageRequest') !!}
@endpush
