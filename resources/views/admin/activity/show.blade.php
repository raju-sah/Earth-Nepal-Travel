<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $activity->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $activity->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top py-3">
    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Title</b>
            <span>{{ $activity->title}}</span>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Slug</b>
            <span>{{ $activity->slug}}</span>
        </div>
    </div>
</div>
<div class="border-top py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!! $activity->description !!}</span>
        </div>
    </div>
</div>
<div class="border-top py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">gallery_caption</b>
            <span>{{ $activity->gallery_caption  }}</span>
        </div>
    </div>
</div>
<div class="border-top py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Exclusive</b>
            <span class="badge {{ $activity->is_exclusive === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $activity->is_exclusive === 1 ? 'Yes' : 'No' }}</span>
        </div>
    </div>
</div>
<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Images</b>
            <div class="images d-flex flex-wrap">
                @foreach($activity->images as $image)
                <img src="{{asset('uploaded-images/activity-gallery-images/'.$image->image_name)}}" height="120px" width="130px" class="ms-2 me-2" alt="{{$image->id}}" class="card-img">
                @endforeach
            </div>
        </div>
    </div>
</div>