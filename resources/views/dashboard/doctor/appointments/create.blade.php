@extends('dashboard.layout.master')
@section('content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->


            <div class="card p-5">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 form p-4 fw-bold mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item ">
                        <a class="nav-link text-active-primary pb-4 active"
                           data-bs-toggle="tab"
                           href="#kt_ecommerce_add_product_general">Appointment Info </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active"
                         id="kt_ecommerce_add_product_general"
                         role="tab-panel">
                        <!--end:::Tabs-->
                        @include('dashboard.validation.alerts')
                        <!--begin::Form-->
                        <form id="kt_docs_formvalidation_text" class="form p-4" method="post"
                              action="{{getActionForm('doctor.appointments.store',@$item)}}"
                              autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-4 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">Patients</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select class="form-select form-select-solid   fw-bolder "
                                            data-kt-select2="true" data-placeholder="Patients" name="patient_id"
                                            data-allow-clear="true" id="patient_filter">
                                        <option></option>
                                        @foreach($patients as $patient)
                                            <option value="{{$patient->id}}" {{isset($item)?($item->patient_id == $patient->id?'selected':''):''}}>{{$patient->name}}</option>
                                        @endforeach


                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="col-4 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">Date</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="datetime-local" name="appointment_date" class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="Date"
                                           value="{{isset($item)?$item->appointment_date:old('appointment_date')}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                            </div>


                            <!--begin::Actions-->
                            <button id="kt_docs_formvalidation_text_submit1" type="submit"
                                    onclick="disableButtonAndSubmitForm('kt_docs_formvalidation_text_submit1','kt_docs_formvalidation_text')"
                                    class="btn btn-primary">
                        <span class="indicator-label">
                           {{__('submit')}}
                        </span>
                                <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                            </button>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <div class="tab-pane fade show form p-4 "
                         id="kt_ecommerce_add_product_reviews"
                         role="tab-panel">
                    </div>
                </div>

            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('scripts')




@endsection
