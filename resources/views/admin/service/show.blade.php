<div class="title-section d-flex align-items-center mb-2">
    <span class="badge bg-info ml-auto">Type: {{ $service->type }}</span>
    <span class="badge bg-warning ms-3">Rate: {{ $service->price }} / {{ $service->rate_type }}</span>
    <span class="badge {{ $service->status === 1 ? 'bg-success' : 'bg-danger'}} ms-3">{{ $service->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top  py-3">

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">image</b>
            <x-table.table_image name="{{$service->image}}" url="{{$service->image_path}}" height="100px" width="200px" />
            <p>{{$service->image_caption}}</p>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Title</b>
            <span>{{ $service->title}}</span>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Slug</b>
            <span>{{ $service->slug}}</span>
        </div>
    </div>
</div>
<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!! $service->description !!}</span>
        </div>
    </div>
</div>