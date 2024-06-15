<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $page->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $page->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top  py-3">

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">banner Image</b>
            <x-table.table_image name="{{$page->banner_image}}" url="{{$page->banner_image_path}}" height="100px" width="200px"/>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">image</b>
            <x-table.table_image name="{{$page->image}}" url="{{$page->image_path}}" height="100px" width="200px"/>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">name</b>
            <span>{{ $page->name}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Slug</b>
            <span>{{ $page->slug}}</span>
        </div>
    </div>
</div>
<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!!  $page->description  !!}</span>
        </div>
    </div>
</div>
