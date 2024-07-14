<div class=" title-section d-flex align-items-center">
    <span class="badge {{ $blog->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $blog->status === 1 ? 'Active' : 'In Active' }}</span>
</div>

<div class="row">

    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">image</b>
            <x-table.table_image name="{{$blog->image }}" url="{{$blog->image_path}}" height="100px" width="200px" />
        </div>
    </div>

    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Created By</b>
            <span>{{ $blog->user->name}}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Title</b>
            <span>{{ $blog->title}}</span>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Slug</b>
            <span>{{ $blog->slug}}</span>
        </div>
    </div>
    <div class="col-xl-4 col-md-4 mb-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Is Popular</b>
            <span class="badge {{ $blog->is_popular === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $blog->is_popular === 1 ? 'Yes' : 'No' }}</span>
        </div>
    </div>
</div>
<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!! $blog->description !!}</span>
        </div>
    </div>
</div>