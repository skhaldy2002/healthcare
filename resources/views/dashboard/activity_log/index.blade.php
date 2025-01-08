@extends('dashboard.layout.master')
@section('content')
    @php
        use \App\Constants\Enum;
    @endphp
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">


                <!--begin::Advance form-->
                <div class="collapse show" id="kt_advanced_search_form">


                    <!--begin::Row-->
{{--                    <div class="row g-8" style="margin-left: 10px">--}}
{{--                        <!--begin::Row-->--}}
{{--                        <div class="row g-8 academic-dev">--}}
{{--                            <!--begin::Col-->--}}
{{--                            <div class="col-lg-3 ">--}}
{{--                                <div class="d-flex align-items-center position-relative my-1">--}}
{{--                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->--}}
{{--                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">--}}
{{--													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />--}}
{{--														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />--}}
{{--													</svg>--}}
{{--												</span>--}}
{{--                                    <!--end::Svg Icon-->--}}
{{--                                    <input type="text" id="subject_id"  class="form-control form-control-solid w-250px ps-14" placeholder="Subject No" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end::Col-->--}}

{{--                            <!--begin::Col-->--}}
{{--                            <div class="col-lg-3 ">--}}

{{--                                <!--begin::Input-->--}}
{{--                                <select class="form-select form-select-solid   fw-bolder "--}}
{{--                                        data-kt-select2="true" data-placeholder="Subject Name"--}}
{{--                                        data-allow-clear="true" id="subject_filter">--}}
{{--                                    <option></option>--}}
{{--                                    @foreach($modelClasses as $model)--}}
{{--                                        @php--}}
{{--                                            $model_name = explode('\\', $model);--}}
{{--                                             $subject_name = $model_name[count($model_name)-1];--}}
{{--                                        @endphp--}}
{{--                                        <option value="{{$model}}">{{ucwords($subject_name)}}</option>--}}
{{--                                    @endforeach--}}

{{--                                </select>--}}
{{--                                <!--end::Input-->--}}
{{--                            </div>--}}
{{--                            <!--end::Col-->--}}



{{--                        </div>--}}
{{--                        <!--end::Row-->--}}
{{--                    </div>--}}
                    <!--end::Row-->
                </div>
                <!--end::Advance form-->
                <!--begin::Separator-->
                <div class="separator separator-dashed mt-3 mb-0"></div>
                <!--end::Separator-->
                <!--begin::Card body-->
                <div class="card-body pt-0 trip-index">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Log Name</th>
{{--                            <th class="min-w-125px"> Properties</th>--}}
                            <th class="min-w-125px"> Causer Name</th>
                            <th class="min-w-125px"> Subject Id</th>
                            <th class="min-w-125px"> Subject Name</th>
                            <th class="min-w-125px"> Description</th>
                            <th class="text-end min-w-70px">{{__('lang.actions')}}</th>
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
    <div class="modal" id="logModal">
        <div class="modal-dialog" style="max-width: 75%;">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                </div>
                <!-- Modal body -->
                <div class="modal-body" style="text-align: center">
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                <!--begin::Table head-->
                                <thead>
                                <tr class=" text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-175px">Key</th>
                                    <th class="min-w-175px">New</th>
                                    <th class="min-w-70px ">Old</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600" id="body-log">


                                </tbody>
                                <!--end::Table head-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->

                </div>
                <div class="modal-footer" style="justify-content:center">
                    <button type="button" id="closeLogModal" class="btn btn-danger">Close</button>
                </div>
            </div>
            <!-- Modal footer -->
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        var dt;
        $(document).ready(function () {

            "use strict";

            // Class definition
            var KTDatatablesServerSide = function () {
                // Shared variables
                var table;

                var filterPayment;

                // Private functions
                var initDatatable = function () {
                    dt = $("#datatable").DataTable({
                        searchDelay: 500,
                        processing: true,
                        serverSide: true,
                        'pagingType': 'full_numbers',
                        'lengthMenu': [[10, 20, 50, 100], [10, 20, 50, 100]],
                        order: [],
                        stateSave: false,

                        ajax: {
                            url: "{{route('activity-logs.index')}}",
                            error: function(xhr, error, thrown) {
                                var status = xhr.status; // Get the status code
                                if(status == 401 || status == 419){
                                    KTApp.hidePageLoading();
                                    window.location.reload()
                                }

                            },

                        },
                        preDrawCallback: function(settings) {
                            KTApp.showPageLoading();
                        },


                        drawCallback: function(settings) {
                            KTApp.hidePageLoading();
                            $('#all_checked').prop('checked', false);

                        },
                        columns: [
                            {data: 'log_name'},
                            {data: 'causer_name'},
                            {data: 'subject_id'},
                            {data: 'subject_name'},
                            {data: 'description'},
                            {data: 'actions'},
                        ],
                        columnDefs: [

                            {
                                targets: 0,
                                orderable: false,
                                lassName: 'text-start',
                            },
                            {
                                targets: 1,
                                orderable: false,

                            },
                            {
                                targets: 2,
                                orderable: false,
                            },
                            {
                                targets: 3,
                                orderable: false,
                            },
                            {
                                targets: 4,
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

                    dt.on('draw', function (response) {
                        KTMenu.createInstances();
                    });


                }

                var handleSearchDatatable = function () {

                    var searchParams = {};

                    // Function to add search parameter to the searchParams object
                    function addSearchParam(filterId, column) {
                        $(filterId).change(function () {
                            searchParams[column] = $(this).val().toLowerCase().toLowerCase();
                            dt.search(JSON.stringify(searchParams)).draw();
                        });
                    }



                    addSearchParam('#subject_filter', 'subject_type');
                    addSearchParam('#subject_id', 'subject_id');



                }



                // Public methods

                return {
                    init: function () {
                        initDatatable();
                        handleSearchDatatable();
                    }
                }
            }();


            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTDatatablesServerSide.init();
            });

            // Class definition

            $(document).on('click', '.details_log', function (e) {
                var item = $(this).data('item');
                var row = ``;
                item.properties.forEach(function(currentValue, index, array) {
                   row+=`  <tr>
                                    <td>
                                     ${currentValue.key}
                                    </td>
                                    <td>
                                        <div class="badge badge-light-info">
                                            ${currentValue.new}
                                        </div>

                                    </td>
                                    <td>
                                        <div class="badge badge-light-primary">
                                             ${currentValue.old}
                                        </div>
                                    </td>

                                </tr>
                `
                });
                $('#body-log').html(row)
                $('#logModal').modal('show');
            });
            $('#closeLogModal').click(function (e) {
                $('#logModal').modal('hide');
            });





        });

    </script>





@endsection
