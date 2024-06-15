@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Booking"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.bookings.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['full name','email','phone', 'status','Actions']"/>

                        <tbody id="tablecontents">
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$booking->name}}</x-table.td>

                                <x-table.td>{{$booking->email}}</x-table.td>

                                <x-table.td>{{$booking->phone}}</x-table.td>

                                <x-table.td>
                                    <x-form.enum-select id="{{$booking->id}}" :option-display="false" :label-display="false" name="status" :model="$booking->status" :options="\App\Enums\StatusType::cases()" />
                                </x-table.td>

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        <x-table.view_btn route-view="{{route('admin.bookings.show', ':id')}}" id="{{$booking->id}}" model="Booking" name="booking"/>

                                        <x-table.delete_btn route-destroy="{{route('admin.bookings.destroy', $booking->id ) }}"/>
                                    </div>
                                </td>
                            </tr>

                            <x-table.show_modal id="{{$booking->id}}" model="Booking"/>

                        @empty
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    @include('_helpers.modal_script',['name' => 'booking', 'route' => route('admin.bookings.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.swal_delete')
    @include('_helpers.swal_alert')

    <script>
        $(document).on('change', 'select[name="status"]', function () {
            $.ajax({
                url: "{{ route('admin.bookings-status-update') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: $(this).val(),
                    id: $(this).attr('id'),
                },
                success: function (data) {
                    swalAlert('success', 'Status updated successfully!');
                },
                error: function (xhr) {
                    swalAlert('error', 'Something went wrong!');
                }
            });
        });
    </script>
@endpush
