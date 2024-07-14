<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $common_faq->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $common_faq->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top border-bottom  py-3">
    <div class="col-xl-12 col-md-12">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Question</b>
            <span>{{ $common_faq->question}}</span>
        </div>
    </div>
</div>
<div class="py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Description</b>
            <span>{!!  $common_faq->answer  !!}</span>
        </div>
    </div>
</div>
