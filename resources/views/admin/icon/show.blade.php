<div class="row">
    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">image</b>
            <x-table.table_image name="{{$icon->image }}" url="{{$icon->image_path}}" height="100px" width="100px"/>
        </div>
    </div>

    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Name</b>
            <span>{{ $icon->name}}</span>
        </div>
    </div>
</div>
