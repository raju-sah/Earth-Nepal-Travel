<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $partner->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $partner->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top border-bottom py-3">
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">image</b>
            <x-table.table_image name="{{$partner->image }}" url="{{$partner->image_path}}" height="100px" width="200px"/>
            <p>{{$partner->image_caption}}</p>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Partner's Name</b>
            <span>{{ $partner->name}}</span>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Link</b>
            <span>{{ $partner->link}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Type</b>
            <span>{{ $partner->type}}</span>
        </div>
    </div>
</div>

<div class="border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!!  $partner->description  !!}</span>
        </div>
    </div>
</div>
