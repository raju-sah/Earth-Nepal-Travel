@forelse($packages as $package)

<div class="col col-md-4 col-sm-6 col-12 px-sm-4">
    <div class="single_package"><a href="{{route('front.packages.show', $package->slug)}}">
            <figure class="pkg-img"><img src="{{$package->banner_path}}" alt=""></figure>
        </a>
        <figcaption class="expedition_caption p-3">
            <div class="expedition_wrapper">
                <h4 class="pkg-title mt-0">Kathmandu</h4>
                <div class="d-flex gap-2 time">
                    <figure class="icon"><i class="fa-regular fa-clock"></i></figure>
                    <span>2 Days</span>
                </div>
            </div>
            <div class="d-flex review">
                <div class="tour-review mt-3">
                    <span>
                        <i class="rating__icon rating__icon--star fa-solid fa-star" style="color: #ffc700;"></i>
                    </span>
                    <span class="reviews-count mt-2">(10 Review)</span>
                </div>
               
                <h4 class="pkg-price"><span>From </span> $100</h4>

            </div>
        </figcaption>
    </div>
</div>

<h1 class="text-center">No Packages Available !</h1>


<div class="col-12 d-flex justify-content-center" style="color: var(--bg-primary)">
    <!-- {{$packages->links()}} -->
</div>