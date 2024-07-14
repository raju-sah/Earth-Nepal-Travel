<div class="title-section d-flex align-items-center mb-2">
    <span class="badge bg-warning ml-auto ">Price: {{ $package->price }}</span>
    <span class="badge bg-primary ms-3 ">{{ $package->view_count }} Views</span>
    <span class="badge {{ $package->status === 1 ? 'bg-success' : 'bg-danger'}} ms-3 ">{{ $package->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top border-bottom py-2">
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Banner image</b>
            <x-table.table_image name="{{$package->id }}" url="{{$package->banner_path}}" height="100px" width="200px" />
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Duration</b>
            <span>{{ $package->duration_value}} {{$package->duration_type}}</span>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Slug</b>
            <span>{{ $package->slug}}</span>
        </div>
    </div>

</div>


<div class="row border-bottom py-2">
    <div class="col-xl-2 col-md-2">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Package Type</b>
            <span class="badge {{ $package->journey_type ? 'bg-info' : 'bg-danger'}}">{{ $package->journey_type ?? 'N/A' }} </span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Package Sub Types</b>
            @foreach($journey_type_childs_names as $names)
            <span class="badge" style="background: #ff4800;">{{ $names}}</span>
            @endforeach
        </div>
    </div>
    <div class="col-xl-2 col-md-2">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Difficulty</b>
            <span>{{ $package->difficulty_level}}</span>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Location</b>
            <span>{{ $package->starting_location}} - {{$package->ending_location}}</span>
        </div>
    </div>

    <div class="col-xl-2 col-md-2">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Age Range</b>
            <span>{{ $package->min_age}} - {{$package->max_age}}</span>
        </div>
    </div>

</div>

<div class="row my-3">

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">RoadMap</b>
            <x-table.table_image name="{{$package->id }}" url="{{$package->image_path}}" height="100px" width="200px" />
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Max Altitude</b>
            <span>{{ $package->max_altitude}} Meters</span>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Highlight</b>
            <span class="badge ml-auto" style="background: #df00ff;">{{ $package->highlight}}</span>
        </div>
    </div>


</div>

<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">overview</b>
            <span>{!! $package->overview !!}</span>
        </div>
    </div>
</div>