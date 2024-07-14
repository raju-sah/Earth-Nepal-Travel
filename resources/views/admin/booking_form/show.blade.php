<div class="row align-items-center  ">
    <div class="card-content mt-2"><b class="d-block text-uppercase text-14">page_title</b><span>{{$booking_form->page_title}}</span></div>
<div class="card-content mt-2"><b class="d-block text-uppercase text-14">banner_image</b><span>{{$booking_form->banner_image}}</span></div>
<div class="card-content mt-2"><b class="d-block text-uppercase text-14">content_title</b><span>{{$booking_form->content_title}}</span></div>
<div class="card-content mt-2"><b class="d-block text-uppercase text-14">description</b><span>{{$booking_form->description}}</span></div>
<div class="card-content mt-2"><b class="d-block text-uppercase text-14">image</b><x-table.table_image name="{{$booking_form->image }}" url="{{$booking_form->image_path }}"/>
</div>
</div>
