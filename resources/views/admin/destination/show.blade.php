<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $destination->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $destination->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top border-bottom py-3">

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">image</b>
            <x-table.table_image name="{{$destination->image }}" url="{{$destination->image_path}}" height="100px" width="200px"/>
            <p>{{$destination->image_caption}}</p>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Title</b>
            <span>{{ $destination->title}}</span>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Slug</b>
            <span>{{ $destination->slug}}</span>
        </div>
    </div>
</div>
<div class="row  border-bottom py-3">


    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">is featured</b>
            <span>{{ $destination->is_featured === 1 ? 'Yes' : 'No'}}</span>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Is Parent </b>
            <span>{{ $destination->parent_id === null ? 'No' : 'Yes' }}</span>

        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">country</b>
            <span>{{$destination->country}}</span>
        </div>
    </div>
</div>

<div class="row border-bottom py-3">
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">latitude</b>
            <span>{{ $destination->latitude }}</span>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">longitude </b>
            <span>{{ $destination->longitude  }}</span>

        </div>
    </div>
</div>

<div class="row border-bottom py-3">
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">view_count</b>
            <span>{{ $destination->view_count }}</span>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14 ">Activities </b>
            @foreach ($destination->activities as $activity)
                <span class="badge bg-primary">{{ $activity->title  }}</span>
            @endforeach
        </div>
    </div>

</div>
<div class="border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!!  $destination->description  !!}</span>
        </div>
    </div>
</div>
