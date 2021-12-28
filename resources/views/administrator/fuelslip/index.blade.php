@extends('layouts.app')
@section('title', 'List of Fuel Slip')
@prepend('page-css')
<link rel="stylesheet" href="{{ asset('/css/datatables.min.css') }}">
<style>
    .pointer {
        cursor: pointer;
        padding: 5px;
        border-radius: 5px;
    }

    .pointer-selected {
        cursor: pointer;
    }

    .pointer:hover {
        background: gray;
        padding: 5px;
        color: white;
        transition: 300ms all ease-in;
    }

</style>
@endprepend
@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap my-3">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Fuel Slips</h1>
    </div>

    <div>

        <button id="btnPrintSelected" class="btn btn-info d-inline-flex align-items-center" href="{{ route('print-slip', 1) }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill mx-2"
                viewBox="0 0 16 16">
                <path
                    d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                <path
                    d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
            </svg>
             Print Selected Slips
        </button>

        <a href="{{ route('fuel-slip.create') }}" class="btn btn-primary d-inline-flex align-items-center">
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
        <div class="card border-0">
            <div class="row">

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-9">
                        <span class="fw-bold">Selected Fuel Slip IDS :</span>
                        <div class='text-info' id="selected-item-container"></div>
                    </div>
                    <div class="col-lg-3">
                        <button class='btn btn-primary' id='btn-select-all'>Select All Items</button>
                        <button class='btn btn-danger' id='btn-clear-items'>Clear All Selected Items</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded" id="fuel-slips-table">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start align-middle">&nbsp;</th>
                        <th class="border-0 align-middle">ID</th>
                        <th class="border-0 align-middle">Date Issued</th>
                        <th class="border-0 align-middle">Gasoline Station</th>
                        <th class="border-0 align-middle">No. of Liters</th>
                        <th class="border-0 align-middle text-center">Name of driver</th>
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
<!-- Modal Content -->
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">View Fuel Slip</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group mb-4">
                    <label>ID</label>
                    <input type="text" class="form-control" name="id" id="id" readonly>
                </div>


                <div class="form-group mb-4">
                    <label>Date Issued</label>
                    <input type="text" class="form-control" name="date_issued" id="date_issued" readonly>
                </div>

                <div class="form-group mb-4">
                    <label>Gasoline Station</label>
                    <input type="text" class="form-control" name="gasoline_station" id="gasoline_station" readonly>
                </div>

                <div class="form-group mb-4">
                    <label>No. of Liters</label>
                    <input type="text" class="form-control" name="no_of_liters" id="no_of_liters" readonly>
                </div>

                <div class="form-group mb-4">
                    <label>Name of driver</label>
                    <input type="text" class="form-control" name="name_of_driver" id="name_of_driver" readonly>
                </div>

                <div class="form-group mb-4">
                    <label>Vehicle Plate No.</label>
                    <input type="text" class="form-control" name="vehicle_plate_no" id="vehicle_plate_no" readonly>
                </div>

                <div class="form-group mb-4">
                    <label>Created At</label>
                    <input type="text" class="form-control" name="created_at" id="created_at" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Content -->
@push('page-scripts')
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/datatables.min.js') }}"></script>
<script src="{{ asset('/js/datatables-bootstrap5.min.js') }}"></script>
<script>
    let selected = localStorage.getItem('selected_items') || [];

    let table = $('#fuel-slips-table').DataTable({
        serverSide: true,
        ajax: "{{ route('fuel-slip.list') }}",
        order: [
            [6, "desc"]
        ],
        destroy: true,
        processing: true,
        language: {
            searchPlaceholder: 'press "ENTER" to filter records',
            processing: `<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>`,
        },
        columns: [{
                defaultContent: '',
                class: 'text-center align-middle border-0 fw-bold checkbox pointer-selected',
                name: 'id',
                orderable: false,
                render: function (id, _, data, row) {
                    return `
                        <input class="form-check-input" type="checkbox" id="id-${id}" value="${id}" style="cursor:pointer; pointer-events : none;">
                        <label class="form-check-label" for="id-${id}"></label>
                  `;
                },
            },
            {
                class: 'text-center align-middle border-0 fw-bold',
                name: 'id'
            },
            {
                class: 'text-center align-middle border-0 fw-bold',
                name: 'issued_date',
                render: function (rawData, b, data, row) {
                    return `${new Date(rawData).getMonth() + 1}/${new Date(rawData).getDate()}/${new Date(rawData).getFullYear()}`;
                }
            },
            {
                class: 'align-middle text-center border-0 fw-bold text-uppercase',
                name: 'gasoline_station'
            },
            {
                class: 'align-middle border-0 fw-bold text-center',
                name: 'no_of_liters'
            },
            {
                class: 'align-middle border-0 fw-bold text-center',
                name: 'name'
            },
            {
                class: 'align-middle border-0 fw-bold text-center',
                name: 'vehicle_plate_no'
            },
            {
                class: 'text-center align-middle border-0 fw-bold text-uppercase',
                name: 'created_at'
            },
            {
                orderable: false,
                searchable: false,
                class: 'text-center border-0 fw-bold align-middle',
                name: 'action'
            }
        ],
    });

    table.on('draw', function () {
        $('#fuel-slips-table tbody tr td').children().each((index, element) => {
            if (element.getAttribute('type') && element.getAttribute('type') === 'checkbox') {
                //  Check the ID
                let elementID = $(element).attr('id').replace('id-', '');
                if (selected.includes(elementID)) {
                    element.setAttribute('checked', true);
                }
            }
        });
    });

    if (selected.length !== 0) {
        selected = selected.split(',');
        // Initialize selected items.
        selected.forEach((checkbox) => {
            $(`#id-${checkbox}`).attr('checked');
        });
        initializeSelectedSlips(selected);
    }

    function initializeSelectedSlips(selectItems) {
        let i = 0;
        selectItems.forEach((item) => {
            $('#selected-item-container').append(`
                <span class='mx-1 pointer view-item' data-id='${item}'>${item}</span>
            `);
            i++;
        });
    }


    $(document).on('focus', '.dataTables_filter input', function () {
        $(this).unbind().bind('keyup', function (e) {
            if (e.keyCode === 13) {
                table.search(this.value).draw();
            } else if (e.keyCode === 8 && !this.value) {
                table.search('').draw();
            }
        });
    });


    $(document).on('click', '.checkbox', function (e) {
        let target = e.target;
        $(target).children().each(function (index, element) {
            if (element.getAttribute('type') == 'checkbox') {
                let isChecked = $(element).is(':checked');
                if (isChecked) {
                    $(element).attr('checked', false);
                    selected = selected.filter((select) => select !== $(element).attr('id').replace(
                        'id-', ''));
                } else {
                    $(element).attr('checked', true);
                    selected.push($(element).attr('id').replace('id-', ''))
                }
            }
        });


        localStorage.setItem('selected_items', selected);
        $('#selected-item-container').html('');
        initializeSelectedSlips(selected);
    });

    $('#btn-clear-items').click(function () {
        selected = [];
        localStorage.removeItem('selected_items');
        $('#selected-item-container').html('');

        $('.checkbox').each(function (index, element) {
            let checkElement = $(element).find('input').first()[0];

            if (checkElement) {
                checkElement.removeAttribute('checked');
            }
        });
    });

    $(document).on('click', '.view-item', function (e) {
        let ID = $(this).attr('data-id');
        $.ajax({
            url : `/admin/fuel-slip/${ID}`,
            success : function (response) {
                let dateIssued = `${new Date(response.issued_date).getMonth() + 1}/${new Date(response.issued_date).getDate()}/${new Date(response.issued_date).getFullYear()}`
                $('#created_at').val(response.created_at);
                $('#vehicle_plate_no').val(response.vehicle_plate_no);
                $('#name_of_driver').val(response.name);
                $('#no_of_liters').val(response.no_of_liters);
                $('#gasoline_station').val(response.gasoline_station);
                $('#date_issued').val(dateIssued);
                $('#id').val(ID);
            }
        });
        $('#modal-default').modal('toggle');
        
    });

    $('#btn-select-all').click(function () {
        $('.checkbox').each(function (index, element) {
            let checkElement = $(element).find('input').first()[0];
            if (checkElement) {
                let id = $(checkElement).attr('id').replace('id-', '');
                $(checkElement).attr('checked', true);
                selected.push(id);
            }
        });

        localStorage.setItem('selected_items', selected);
        initializeSelectedSlips(selected);
    });

    $('#btnPrintSelected').click(function () {
        let selectedItems = selected.join('&');
        window.open(`/admin/print-slip/${selectedItems}`);
    });

</script>
@endpush
@endsection
