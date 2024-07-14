<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $destinationCategory->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $destinationCategory->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top py-3">

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">image</b>
            <x-table.table_image name="{{$destinationCategory->image }}" url="{{$destinationCategory->image_path}}" height="100px" width="200px"/>
            <p>{{$destinationCategory->image_caption}}</p>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Title</b>
            <span>{{ $destinationCategory->title}}</span>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Slug</b>
            <span>{{ $destinationCategory->slug}}</span>
        </div>
    </div>
</div>
<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!!  $destinationCategory->description  !!}</span>
        </div>
    </div>
</div>
