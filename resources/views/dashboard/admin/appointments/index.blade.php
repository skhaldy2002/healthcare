@extends('dashboard.layout.master')
@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
													</svg>
												</span>
                            <!--end::Svg Icon-->
                            <input type="text" id="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{__('search')}}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                            <!--end::Filter-->
                            <!--begin::Add customer-->
{{--                            <a href="{{route('customers.create')}}" type="button" class="btn btn-primary" >{{__('add')}}</a>--}}
                            <!--end::Add customer-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-customer-table-select="selected_count"></span>{{__('selected')}}</div>
                            <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected" id="delete_selected">{{__('delete_selected')}}</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">doctor</th>
                            <th class="min-w-125px">patient</th>
                            <th class="min-w-125px" >date</th>
                            <th class="min-w-125px" style="padding-right: 15px">Status</th>
                            <th class="text-end min-w-70px">{{__('actions')}}</th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">


                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('scripts')

    <script>

        // $("#datatable").DataTable();
        "use strict";

        // Class definition
        var KTDatatablesServerSide = function () {
            // Shared variables
            var table;
            var dt;
            var filterPayment;

            // Private functions
            var initDatatable = function () {
                dt = $("#datatable").DataTable({
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    // order: [[3, 'desc']],
                    stateSave: false,
                    select: {
                        style: 'multi',
                        selector: 'td:first-child input[type="checkbox"]',
                        className: 'row-selected'
                    },
                    ajax: {
                        // url: "https://preview.keenthemes.com/api/datatables.php",
                        url: "{{route('admin.appointments.index')}}",
                    },
                    columns: [
                        { data: 'doctor' },
                        { data: 'patient' },
                        { data: 'date' },
                        { data: 'status' },
                        { data: 'actions' },
                    ],
                    columnDefs: [

                        {
                            targets: 0,
                            orderable: false,
                            className: 'text-end',
                        },
                        {
                            targets: 1,
                            orderable: false,

                        },
                        {
                            targets: -1,
                            orderable: false,
                            className: 'text-end',
                        },
                    ],
                });

                table = dt.$;

                dt.on('draw', function () {
                    handleDeleteRows();
                    KTMenu.createInstances();
                });
            }

            var handleSearchDatatable = function () {

                const filterSearch = document.querySelector('#search');
                filterSearch.addEventListener('keyup', function (e) {
                    dt.search(e.target.value).draw();
                });
            }



            // Delete customer
            var handleDeleteRows = () => {
                // Select all delete buttons
                // const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="cancel_row"]');
                const cancelButtons = document.querySelectorAll('#cancel_row');
                const confirmButtons = document.querySelectorAll('#confirm_row');

                cancelButtons.forEach(d => {
                    // Delete button on click
                    d.addEventListener('click', function (e) {
                        e.preventDefault();

                        // Select parent row
                        const parent = e.target.closest('tr');
                        var record_id = $(this).data('id');
                        // Get customer name
                        const customerName = parent.querySelectorAll('td')[1].innerText;

                        // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "{{__('Are you sure you want to cancel')}} " + customerName + "?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes!",
                            cancelButtonText: "No",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                // Simulate delete request -- for demo purpose only
                                Swal.fire({
                                    text: "deleting " + customerName,
                                    icon: "info",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function () {
                                    Swal.fire({
                                        text: "you deleted " + customerName + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                        // delete row data from server and re-draw datatable
                                        var url = '{{route("admin.appointments.cancel",[":id"])}}';
                                        url = url.replace(':id', record_id);

                                        axios.post(url).then(function (response) {
                                            dt.draw();
                                        }).catch(function (error) {
                                            if (error.response && error.response.status === 401 && error.response.data.message === 'Unauthenticated.') {
                                                window.location.reload();
                                            }else if(error.response && error.response.status === 419){
                                                window.location.reload();
                                            }
                                        });

                                    });
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: customerName + " not cancel.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    })
                });
                confirmButtons.forEach(d => {
                    // Delete button on click
                    d.addEventListener('click', function (e) {
                        e.preventDefault();

                        // Select parent row
                        const parent = e.target.closest('tr');
                        var record_id = $(this).data('id');
                        // Get customer name
                        const customerName = parent.querySelectorAll('td')[1].innerText;

                        // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "{{__('Are you sure you want to confirm')}} " + customerName + "?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes!",
                            cancelButtonText: "No",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                // Simulate delete request -- for demo purpose only
                                Swal.fire({
                                    text: "verify " + customerName,
                                    icon: "info",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function () {
                                    Swal.fire({
                                        text: "you verify " + customerName + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                        // delete row data from server and re-draw datatable
                                        var url = '{{route("admin.appointments.confirm",[":id"])}}';
                                        url = url.replace(':id', record_id);

                                        axios.post(url).then(function (response) {
                                            dt.draw();
                                        }).catch(function (error) {
                                            if (error.response && error.response.status === 401 && error.response.data.message === 'Unauthenticated.') {
                                                window.location.reload();
                                            }else if(error.response && error.response.status === 419){
                                                window.location.reload();
                                            }
                                        });

                                    });
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: customerName + " not confirm.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    })
                });
            }





            // Public methods
            return {
                init: function () {
                    initDatatable();
                    handleSearchDatatable();
                    handleDeleteRows();
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesServerSide.init();
        });
        $(document).ready(function() {
            //set initial state.
            $('#all_checked').val(this.checked);

            $('#all_checked').change(function() {
                const headerAllCheck = document.querySelector('#datatable').querySelectorAll('[type="checkbox"]');
                if(this.checked) {
                    headerAllCheck.forEach((element) => {
                        element.checked = true
                    });
                }else{
                    headerAllCheck.forEach((element) => {
                        element.checked = false
                    });
                }
                $('#all_checked').val(this.checked);
            });
        });
    </script>
@endsection
