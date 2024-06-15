<div class="row">
    <div class=" col d-flex justify-content-start mb-2 ">
        <select id="contact_type" class="form-select" >
            @foreach(\App\Enums\InquiryType::cases() as $value)
            <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>

    <div class="col d-flex justify-content-end">
        <button type="button" class="btn btn-info btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#statusNoticeModal">
            Status Details<i class='bx bxs-message-dots'></i>
        </button>
    </div>

</div>

<div class="modal fade" id="statusNoticeModal" tabindex="-1" aria-labelledby="statusNoticeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusNoticeModalLabel">Status Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Pending</h5>
                <p>This status means that although the contact submission has been received, it hasn't been examined or processed yet.</p>
                <hr>

                <h5>In Progress</h5>
                <p>According to this status, someone on the team is currently addressing or working on the contact submission.</p>
                <hr>

                <h5>Approved</h5>
                <p>This status indicates that the contact form was examined, approved, or accepted.</p>
                <hr>

                <h5>Rejected</h5>
                <p>This status indicates that the organization has rejected the contact submission because it is invalid or does not comply with specific requirements.</p>
                <hr>

                <h5>Closed</h5>
                <p>The contact submission is now regarded as closed, as its status suggests that it has been handled.</p>
                <hr>

                <h5>Escalated</h5>
                <p>This status indicates that the contact submission has been forwarded to a department or higher authority for additional processing.</p>
                <hr>

                <h5>On Hold</h5>
                <p>This status reflects a temporary halt or delay in the contact submission processing.</p>
                <hr>

                <h5>Flagged</h5>
                <p>This status indicates that certain contact submissions could need extra care or review.</p>
                <hr>

            </div>
        </div>
    </div>
</div>