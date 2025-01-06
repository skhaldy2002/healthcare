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
                           href="#kt_ecommerce_add_product_general">Diagnosis Info </a>
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
                              action="{{getActionForm('doctor.diagnosis.store',@$appointment)}}"
                              autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-12 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">diagnosis </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <textarea  name="diagnosis"
                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                               placeholder="address" >
                                                    {{$appointment->medical_records?$appointment->medical_records->diagnosis:old('diagnosis')}}
                                                </textarea>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="col-12 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">treatment </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <textarea  name="treatment"
                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                               placeholder="address" >
                                                    {{$appointment->medical_records?$appointment->medical_records->treatment:old('treatment')}}
                                                </textarea>
                                </div>
                                <!--end::Input group-->


                            </div>


                            <!--begin::Actions-->
                         
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
