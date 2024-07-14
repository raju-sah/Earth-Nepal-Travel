<div class="row align-items-center  ">
    <div class="card-content mt-2"><b class="d-block text-uppercase text-14">page_title</b><span>{{$contact_us->page_title}}</span></div>
<div class="card-content mt-2"><b class="d-block text-uppercase text-14">banner_image</b><span>{{$contact_us->banner_image}}</span></div>
<div class="card-content mt-2"><b class="d-block text-uppercase text-14">content_title</b><span>{{$contact_us->content_title}}</span></div>
<div class="card-content mt-2"><b class="d-block text-uppercase text-14">description</b><span>{{$contact_us->description}}</span></div>
<div class="card-content mt-2"><b class="d-block text-uppercase text-14">image</b><x-table.table_image name="{{$contact_us->image }}" url="{{$contact_us->image_path }}"/>
</div>
</div>
