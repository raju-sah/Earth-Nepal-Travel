

<div class="title-section d-flex align-items-center mb-2">
    <span class="badge {{ $user->status === 1 ? 'bg-success' : 'bg-danger'}} ml-auto">{{ $user->status === 1 ? 'Active' : 'In Active' }}</span>
</div>
<div class="row border-top  py-3">

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">image</b>
            <x-table.table_image name="{{$user->image}}" url="{{$user->image_path}}" height="100px" width="200px"/>
            <p>{{$user->image_caption}}</p>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">name</b>
            <span>{{ $user->name}}</span>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">email</b>
            <span>{{ $user->email}}</span>
        </div>
    </div>
</div>
<div class="border-top border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">password</b>
            <span>{{  $user->password  }}</span>
        </div>
    </div>
</div>

