@extends('layouts.front_master')
@section('title', 'Contact')
@section('content')
<section class="review_section py-5 contact_content">
  <div class="container">
    <div class="d-flex">
      <figure> <img src="images/quote_mark.png" alt=""> </figure>
      <figcaption>
        <h1 class="section_title"> Contact us</h1>
        <p class="quote">Share us your Travel Experiences & Stories</p>
      </figcaption>
    </div>
    <div class="row">
      <div class="col-lg-5 col-md-6">
        <div class="review_form mt-0">
          <form id="contactForm" role="form">
            <input type="text" id="po_ps" name="po_ps" style="opacity: 0; height: 0;" value="">
            <input class="form-control" type="text" name="type" value="{{\App\Enums\InquiryType::Contact->value}}" style="opacity: 0; height: 0;">
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="control-label">Full Name </label>
                <input class="form-control" type="text" name="name" placeholder="Full Name">
              </div>
              <div class="form-group col-sm-6">
                <label class="control-label">Email Address</label>
                <input class="form-control" type="email" name="email" placeholder="Email Id">
              </div>
              <div class="form-group col-sm-6">
                <label class="control-label">Phone</label>
                <input class="form-control" type="tel" name="phone" placeholder="Phone">
              </div>
              <div class="form-group col-sm-12">
                <label class="control-label">Subject </label>
                <input class="form-control" type="text" name="subject" placeholder="Subject">
              </div>
              <div class="form-group col-sm-12">
                <label class="control-label">Review</label>
                <textarea class="form-control" name="message" placeholder="Write Something" rows="5"></textarea>
              </div>
              <button id="contact_btn" class="btn view_btn send_btn" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <div class="offset-lg-1 col-lg-5 col-md-6">

        <div class="contact_info">
          <address>
            <figure class="icon"> <i class="fa-solid fa-location-dot fa-2x"></i></figure>
            <div class="details">
              <div class="address-label">Address:</div>

              <span>{{ $setting->contact_address }}</span>
            </div>
          </address>
          <address>
            <figure class="icon"><i class="fa-solid  fa-phone fa-2x"></i></figure>
            <div class="details">
              <div class="address-label">Phone number:</div>
              @php
              $phone = explode(',', $setting->phone);
              @endphp
              <span> {{ $phone[0] }} </span> <span> {{ $phone[1] }} </span>
            </div>
          </address>
          <address>
            <figure class="icon"><i class="fa-solid  fa-envelope fa-2x"></i> </figure>
            <div class="details">
              <div class="address-label">Email:</div>
              @php
              $email = explode(',', $setting->email);
              @endphp
              <span> <a href="mailto:{{ $email[0] }}">{{ $email[0] }}</a> <br>
                <a href="mailto:{{ $email[1] }}">{{ $email[1] }}</a>
                <p>{{ $setting->working_hours }}</p>
              </span>
            </div>
          </address>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('front_scripts')

<script type="text/javascript">
  $(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
      e.preventDefault();

      var form = this; // Capture reference to the form element

      if ($('#po_ps').val()) {
        Swal.fire({
          icon: 'error',
          title: 'Fake Content detected!',
        }).then((result) => {
          form.reset();
        });
      } else {
        $.ajax({
          type: 'POST',
          url: "{{route('front.contact.store')}}",
          data: $(form).serialize(),
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            swalMessage('success', response.message);
            form.reset();
          },
          error: function(xhr) {
            if (xhr.status === 422) {
              displayErrors(xhr.responseJSON.errors);
            } else {
              swalMessage('error', xhr.responseText);
            }
          }
        });
      }
    });

    function swalMessage(type, message) {
      Swal.fire({
        toast: true,
        position: 'top-end',
        timer: 1500,
        timerProgressBar: true,
        icon: type,
        title: message,
        showConfirmButton: false,
      });
    }
  });
</script>

@endpush