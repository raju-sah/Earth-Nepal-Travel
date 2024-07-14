<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $journey->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $journey->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top py-3">

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Image</b>
            <x-table.table_image name="{{$journey->image}}" url="{{$journey->image_path}}" height="100px" width="200px" />
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Name</b>
            <span>{{ $journey->name}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="col-xl-3 col-md-3">
            <div class="card-content">
                <b class="d-block text-uppercase text-14">slug</b>
                <span>{{ $journey->slug}}</span>
            </div>
        </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card-content">
                <b class="d-block text-uppercase text-14">Journey Type</b>
                <span>{{ $journey->type }}</span>

            </div>
        </div>
    </div>
    <div class="border-top border-bottom py-3">
        <div class="row">
            <div class="card-content">
                <b class="d-block text-uppercase text-14">Description</b>
                <span>{!! $journey->description !!}</span>
            </div>
        </div>
    </div>