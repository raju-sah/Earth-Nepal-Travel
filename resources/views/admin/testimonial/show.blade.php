<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $testimonial->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $testimonial->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top py-3">

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Image</b>
            <x-table.table_image name="{{$testimonial->image}}" url="{{$testimonial->image_path}}" height="100px" width="200px" />
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Full Name</b>
            <span>{{ $testimonial->name}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">email</b>
            <span>{{ $testimonial->email}}</span>
        </div>

    </div>
</div>
<div class="row border-top py-3 mt-3">

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">nationality</b>
            <span>{{ $testimonial->nationality}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Rating</b>
            <span>{{ $testimonial->rating}}</span>
        </div>
    </div>
</div>
<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!! $testimonial->description !!}</span>
        </div>
    </div>
</div>