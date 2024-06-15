@if (session()->has('failures'))
<div class="position-relative" id="tablecontents">
    <table class=" table table-bordered mt-3 mb-3 table-striped">
        <thead>
            <tr style="background-color: #696cff; color: white">
                <th class="text-white">Row</th>
                <th class="text-white">Attribute</th>
                <th class="text-white">Errors</th>
                <th class="text-white">Values</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session()->get('failures') as $failure)
            <tr>
                <td>{{ $failure->row() }}</td>
                <td>{{ $failure->attribute() }}</td>
                <td>
                    @foreach($failure->errors() as $error)
                    {{ $error }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach($failure->values() as $key => $value)
                    @if($key == $failure->attribute()){{ $value }}<br>@endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn-sm btn-close position-absolute end-0 " data-bs-dismiss="modal" onclick="RemoveTable()" aria-label="Close" style=" background-color: #ec0626e5;  color:red!important; height: 30px; width: 30px; top: -20px; right: -13px !important;"></button>
</div>
@endif


@push('custom_css')

<style>
    .btn-close:hover {
        transform: translate(3px, -3px);
    }
</style>
@endpush
@push('custom_js')

<script>
    function RemoveTable() {
        document.getElementById("tablecontents").style.display = "none";
    }
</script>

@endpush