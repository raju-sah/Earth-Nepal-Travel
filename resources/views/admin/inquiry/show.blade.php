<div class="title-section d-flex align-items-center mb-2">
    <span class=" badge bg-primary ml-auto text-white p-2">{{ $inquiry->status }}</span>
</div>
<div class="row border-top py-3">
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">name</b>
            <span>{{$inquiry->name}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">email</b>
            <span>{{$inquiry->email}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">phone</b>
            <span>{{ $inquiry->phone}}</span>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Subject</b>
            <span>{{ $inquiry->subject}}</span>
        </div>
    </div>
</div>
<div class="row border-top border-bottom py-3">
    <div class="col-xl-12 col-md-12">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">message</b>
            <span>{{ $inquiry->message}}</span>
        </div>
    </div>
</div>
