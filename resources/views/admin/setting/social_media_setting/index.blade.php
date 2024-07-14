@extends('layouts.master')
@section('title', 'Social Media Setting')
@section('content')
    <div class="container-xxl">

        <x-breadcrumb model="Social Media Setting"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.setting.social-media-settings.create') }}" class="btn btn-sm btn-dark mb-2"><i
                            class='bx bx-xs bx-plus'> </i>Create</a>
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['name', 'slug', 'social link', 'Actions']" />

                        <tbody id="tablecontents">
                            @forelse ($social_media_settings as $social_media_setting)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <x-table.td>{{ $social_media_setting->name }}</x-table.td>

                                    <x-table.td>{{ $social_media_setting->social_link }}</x-table.td>

                                    <x-table.td>{{ $social_media_setting->slug }}</x-table.td>



                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn
                                                route-view="{{ route('admin.setting.social-media-settings.show', ':id') }}"
                                                id="{{ $social_media_setting->id }}" model="SocialMediaSetting"
                                                name="social_media_setting" />

                                            <x-table.edit_btn
                                                route-edit="{{ route('admin.setting.social-media-settings.edit', $social_media_setting->id) }}" />

                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.setting.social-media-settings.destroy', $social_media_setting->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                <x-table.show_modal id="{{ $social_media_setting->id }}" model="SocialMediaSetting" />

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
    @include('_helpers.modal_script', [
        'name' => 'social_media_setting',
        'route' => route('admin.setting.social-media-settings.show', ':id'),
    ])
    @include('_helpers.datatable')

    @include('_helpers.swal_delete')
@endpush
