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
                           href="#kt_ecommerce_add_product_general">Patient Info </a>
                    </li>
                    <!--end:::Tab item-->
                    @if(isset($item))
                        <li class="nav-item"><a class="nav-link text-active-primary pb-4 "
                            >|</a></li>
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4"
                               data-bs-toggle="tab"
                               href="#kt_ecommerce_add_product_reviews">Appointments</a>
                        </li>
                        <!--end:::Tab item-->
                    @endif
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active"
                         id="kt_ecommerce_add_product_general"
                         role="tab-panel">
                        <!--end:::Tabs-->
                        @include('dashboard.validation.alerts')
                        <!--begin::Form-->
                        <form id="kt_docs_formvalidation_text" class="form p-4" method="post"
                              action="{{isset($item)?route('admin.patients.store',['id'=>$item->id]):route('admin.patients.store')}}"
                              autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-4 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">Name</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="Name" value="{{isset($item)?$item->name:old('name')}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="col-4 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">{{__('phone')}}</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="{{__('phone')}}"
                                           value="{{isset($item)?$item->phone:old('phone')}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="col-4 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">Email</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="email"
                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="Email"
                                           value="{{isset($item)?$item->email:old('email')}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                            </div>
                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-4 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">تاريخ الميلاد</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="date" name="dob"
                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="تاريخ الميلاد" value="{{isset($item)?$item->dob:old('dob')}}"/>
                                    <!--end::Input-->
                                </div>
                                <div class="col-4 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">{{__('password')}}</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="password" name="password"
                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="{{__('password')}}" value=""/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="col-4 mb-10">
                                    <!--begin::Label-->
                                    <label class="fw-semibold  mb-2">Password Confirmation</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="password" name="password_confirmation"
                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="Password Confirmation" value=""/>
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

                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" >
                                <!--begin::Table head-->
                                <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Doctor</th>
                                    <th class="min-w-125px"> Date</th>
                                    <th class="min-w-125px"> Status</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                    @if(isset($appointments))
                                        @foreach($appointments as $appointment)
                                            <tr>
                                                <td>{{@$appointment->doctor->name}}</td>
                                                <td>{{$appointment->appointment_date}}</td>
                                                <td>{{$appointment->status}}</td>
                                            </tr>
                                        @endforeach
                                      @endif
                                    </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
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
