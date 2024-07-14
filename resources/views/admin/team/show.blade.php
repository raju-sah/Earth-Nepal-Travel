<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $team->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $team->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top py-3">

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Avatar</b>
            <x-table.table_image name="{{$team->image}}" url="{{$team->image_path}}" height="100px" width="200px" />
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Full Name</b>
            <span>{{ $team->name}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Designation</b>
            <span>{{ $team->designation}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Team Type</b>
            <span>{{ $team->team_type}}</span>
        </div>
    </div>
</div>
<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!! $team->description !!}</span>
        </div>
    </div>
</div>
@php
$social_datas = json_decode($team->social_media);
@endphp
<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Social Links</b>
            @foreach($social_datas as $social)
            <span class="badge bg-primary">{{ $social }}</span>
            @endforeach
        </div>

    </div>
</div>