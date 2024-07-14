@if($errors->any())
    <div class="p-1">
        <div class="alert alert-warning alert-danger" role="alert">
            <div class="text-end">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
