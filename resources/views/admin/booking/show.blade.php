<div class="title-section d-flex align-items-center mb-2">
    <span class="badge badge-success ml-auto">{{ $booking->status }}</span>
    <span class="badge badge-info ml-auto">{{ $booking->type ?? 'N/A' }}</span>
</div>

<div class="row border-top border-bottom py-3">
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Lead Traveller's Name</b>
            <span>{{ $booking->name}}</span>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Email</b>
            <span>{{ $booking->email}}</span>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">phone</b>
            <span>{{ $booking->phone}}</span>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Date</b>
            <span>{{ $booking->arrival_date ?? 'arrival date'}} - {{ $booking->return_date ?? 'return date'}}</span>
        </div>
    </div>
</div>

<div class="row border-top border-bottom py-3">
    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Adults</b>
            <span>{{ $booking->no_of_adults ?? 'N/A'}}</span>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Children</b>
            <span>{{ $booking->no_of_child ?? 'N/A'}}</span>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Infants</b>
            <span>{{ $booking->no_of_infant ?? 'N/A'}}</span>
        </div>
    </div>

    <div class="col-xl-3 col-md-3">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Location</b>
            <span>{{$booking->address ?? 'N/A'}}, {{ $booking->country ?? 'N/A'}}</span>
        </div>
    </div>
</div>

<div class="border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Additional Info</b>
            @isset($booking->additional_data)
                @foreach($booking->additional_data as $key => $value)
                    <p style="padding-bottom: 2px"> {{$key}}: {{ $value}}</p>
                @endforeach
            @else
                <p>No data available !</p>
            @endisset
        </div>
    </div>
</div>

<div class="border-bottom py-3">
    <div class="row">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Message</b>
            <span>{!!  $booking->message !!}</span>
        </div>
    </div>
</div>



