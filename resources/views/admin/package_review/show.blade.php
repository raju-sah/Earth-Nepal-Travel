<div class="title-section d-flex align-items-center mb-2">
    <span class=" badge bg-primary ml-auto me-2 text-white p-2">{{ $package_review->formatted_status }}</span>
    <div class="tour-review">
            <span>
                @for($i = 0; $i < $package_review->rating; $i++)
                    <i class='bx bxs-star' style="color: #ffc700;"></i>
                @endfor
            </span>
        <span class="reviews-count mt-2">(&nbsp;{{ $package_review->rating}} {{ Str::plural('Star', $package_review->rating) }} &nbsp;)</span>
    </div>
</div>
<div class="row border-top py-3">
    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Full Name</b>
            <span>{{ $package_review->fullname}}</span>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">email</b>
            <span>{{ $package_review->email}}</span>
        </div>
    </div>
</div>
<div class="row border-top border-bottom py-3">
    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">package</b>
            <span>{{ $package_review->package->title}}</span>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Review Text</b>
            <span>{{ $package_review->review_text}}</span>
        </div>
    </div>
</div>

