@extends('layouts.app')
@section('title', 'List of Fuel Slip')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
@endprepend
@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap my-3">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Fuel Slips</h1>
    </div>
    <div>
        <a href="{{ route('fuel-slip.create') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-receipt-cutoff mx-2" viewBox="0 0 16 16">
                <path
                    d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zM11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                <path
                    d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293 2.354.646zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118l.137-.274z" />
            </svg>
            Generate Fuel Slip
        </a>
    </div>
</div>
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
<div class="card border-0 shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded" id="fuel-slips-table">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start align-middle">ID</th>
                        <th class="border-0 align-middle">Date Issued</th>
                        <th class="border-0 align-middle">Gasoline Station</th>
                        <th class="border-0 align-middle">No. of Liters</th>
                        <th class="border-0 align-middle">Name of driver</th>
                        <th class="border-0 text-center align-middle">Vehicle Plate #</th>
                        <th class="border-0 rounded-end text-center align-middle">Created At</th>
                        <th class="border-0 rounded-end text-center align-middle">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#fuel-slips-table').DataTable({
        serverSide: true,
        ajax: "{{ route('fuel-slip.list') }}",
        order : [[ 6, "desc" ]],
        destroy : true,
        processing: true,
        language: {
                    processing: `<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>`,
        },
        columns: [{
                class: 'text-center align-middle border-0 fw-bold',
                name: 'id'
            },
            {
                class: 'text-center align-middle border-0 fw-bold',
                name: 'issued_date',
                render : function (rawData, b, data,row) {
                    return `${new Date(rawData).getMonth() + 1}/${new Date(rawData).getDate()}/${new Date(rawData).getFullYear()}`;
                }
            },
            {
                class : 'align-middle text-center border-0 fw-bold',
                name: 'gasoline_station'
            },
            {
                class: 'align-middle border-0 fw-bold text-center',
                name: 'no_of_liters'
            },
            {
                class : 'align-middle border-0 fw-bold',
                name: 'name'
            },
            {
                class : 'align-middle border-0 fw-bold text-center',
                name: 'vehicle_plate_no'
            },
            {
                class: 'text-center align-middle border-0 fw-bold',
                name: 'created_at'
            },
            {
                class : 'text-center border-0 fw-bold align-middle',
                name : 'action'
            }
        ],
    });

</script>
@endpush
@endsection
