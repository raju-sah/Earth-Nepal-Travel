<div class="col-lg-3 col-md-4">
    <aside class="filter_category_sidebar">
        <div class="filter_category_wrapper">
            <form id="filter_form">
                <div class="filter_item form-group">
                    <label class="label_title">Keywords:</label>
                    <div class="form_search">
                        <input type="search" name="search_keyword" placeholder="" class="form-control search" id="search">
                        <button type="button" class="btn btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
                <div class="filter_item form-group">
                    <label class="label_title" for="expedition">Expedition</label>
                    <div class="select_dropdown">
                        <select class="form-control expedition" id="expedition" name="activity_id">
                            <option selected value="">Select Expedition</option>

                            <option value="" </option>

                        </select>
                    </div>
                </div>
                <div class="filter_item form-group">
                    <label class="label_title" for="destination">Destination</label>
                    <div class="select_dropdown">
                        <select class="form-control destination" id="destination" name="destination_id">
                            <option selected value="">Select Destination</option>

                            <option value="" </option>

                        </select>
                    </div>
                </div>
                <div class="filter_item form-group">
                    <label class="label_title" for="duration">Durations</label>
                    <div class="select_dropdown">
                        <select class="form-control duration" id="duration" name="duration_value">
                            <option selected value="">Select Duration</option>
                        </select>
                    </div>
                </div>
                <div class="filter_item form-group">
                    <div class="row">
                        <div class="col-sm-6 pr-sm-2">
                            <label class="label_title" for="min-price">Min Price </label>
                            <div class="filter_item form-group price_filter">
                                <input type="text" class="form-control" placeholder="Min" name="min_price" size="" value="" maxlength="" minlength="" id="min-price">
                            </div>
                        </div>
                        <div class="col-sm-6 pl-sm-2">
                            <label class="label_title" for="max-price">Max Price </label>
                            <div class="filter_item form-group price_filter">
                                <input type="text" class="form-control" placeholder="Max" name="max_price" size="" value="" maxlength="" minlength="" id="max-price">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter_item form-group">
                    <label class="label_title" for="rating">Ratings</label>
                    <div id="full-stars-example-two">
                        <div class="rating-group">
                            <input checked class="rating__input rating__input--none" name="rating" id="rating-none" value="0" type="radio">
                            <label aria-label="1 star" class="rating__label" for="rating-1"><i class="rating__icon rating__icon--star fa-solid fa-star"></i></label>
                            <input class="rating__input" name="rating" id="rating-1" value="1" type="radio">
                            <label aria-label="2 stars" class="rating__label" for="rating-2"><i class="rating__icon rating__icon--star fa-solid fa-star"></i></label>
                            <input class="rating__input" name="rating" id="rating-2" value="2" type="radio">
                            <label aria-label="3 stars" class="rating__label" for="rating-3"><i class="rating__icon rating__icon--star fa-solid fa-star"></i></label>
                            <input class="rating__input" name="rating" id="rating-3" value="3" type="radio">
                            <label aria-label="4 stars" class="rating__label" for="rating-4"><i class="rating__icon rating__icon--star fa-solid fa-star"></i></label>
                            <input class="rating__input" name="rating" id="rating-4" value="4" type="radio">
                            <label aria-label="5 stars" class="rating__label" for="rating-5"><i class="rating__icon rating__icon--star fa-solid fa-star"></i></label>
                            <input class="rating__input" name="rating" id="rating-5" value="5" type="radio">
                        </div>

                    </div>
                </div>
                <div class="space_bar">
                    <label class="label_title">Country / Locations</label>
                    <div class="form-check mt-3">
                    
                    </div>
                </div>
                <input type="reset" value="Clear filter" class="clear_btn">

                <div class="space_bar mt-5">
                    <input class="input-search form-control submit_search" type="submit" value="Search">
                </div>
            </form>
        </div>
    </aside>
</div>