<div class="title-section d-flex align-items-center">
    <span class="badge {{ $season->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $season->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row">

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Season</b>
            <span>{{ $season->title}}</span>
        </div>
    </div>

</div>

