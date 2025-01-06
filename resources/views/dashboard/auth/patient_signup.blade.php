<!DOCTYPE html>
@if(app()->getLocale() == 'ar')
    <html lang="ar" dir="rtl">
    @else
        <html lang="en" dir="ltr">
        @endif
        <!--begin::Head-->
        <head>
            <base href="../../../">
            <title>{{getSettingByKey($settings,'site_name')->value }}</title>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <link rel="shortcut icon" href="{{getSettingByKey($settings,'site_icon')->value }}"/>
            <!--begin::Fonts-->
            <link
                href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&family=Tajawal:wght@700&display=swap"
                rel="stylesheet">
            <!--end::Fonts-->
            <!--begin::Global Stylesheets Bundle(used by all pages)-->
            @if(app()->getLocale() == 'ar')
                <link href="{{asset('')}}assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet"
                      type="text/css"/>
                <link href="{{asset('')}}assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css"/>
                <link href="{{asset('')}}assets/css/custom.rtl.css" rel="stylesheet" type="text/css"/>

            @else
                <link href="{{asset('')}}assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
                <link href="{{asset('')}}assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
            @endif
            <!--end::Global Stylesheets Bundle-->
        </head>
        <!--end::Head-->
        <!--begin::Main-->
        <body
            id="kt_body" class="bg-body"
            @if(app()->getLocale() == 'ar')
                style="text-align: right; font-family: Tajawal;"
            @else
                style="text-align: left; font-family: Poppins !important;"
            @endif
        >
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Aside-->
                <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
                     style="background-color: #093254;">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y justify-content-center">
                        <!--begin::Illustration-->
                        <div
                            class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                            style="background-image: url({{asset('assets/media/clinic.png')}})"></div>
                        <!--end::Illustration-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Aside-->
                <!--begin::Body-->
                <div class="d-flex flex-column flex-lg-row-fluid py-10">

                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column flex-column-fluid">

                        <!--begin::Form-->
                        <form id="kt_docs_formvalidation_text" class="form p-4" method="post"
                              action="{{route('patient_signup.store')}}"
                              autocomplete="off" enctype="multipart/form-data">
                            @csrf


                            @include('dashboard.validation.alerts')
                            @include('dashboard.validation.session')
                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-12 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">Name</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="Name" value="{{old('name')}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="col-12 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">{{__('phone')}}</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="{{__('phone')}}"
                                           value="{{old('phone')}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="col-12 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">Email</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="email" name="email"
                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="Email"
                                           value="{{old('email')}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->



                            </div>
                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-12 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">Username</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="username"
                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="username"
                                           value="{{old('username')}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-12 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">DOB</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="date" name="dob"
                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="DOB" value="{{isset($item)?$item->dob:old('dob')}}"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-12 mb-10">
                                    <!--begin::Label-->
                                    <label class=" fw-semibold  mb-2">Address </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <textarea  name="address"
                                               class="form-control form-control-solid mb-3 mb-lg-0"
                                               placeholder="address" >
                                                    {{isset($item)?$item->address:old('address')}}
                                                </textarea>
                                    <!--end::Input-->
                                </div>
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
                            <!--begin::Actions-->
                            <a href="{{route('login')}}"
                               class="btn btn-success">
                        <span class="indicator-label">
                         Login Page
                        </span>
                            </a>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->

                    </div>

                    <!--end::Content-->
                    <!--begin::Footer-->
                    <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Authentication - Sign-in-->
        </div>
        <!--end::Root-->
        <!--end::Main-->
        <!--begin::Javascript-->
        <script>var hostUrl = "{{asset('')}}assets/";</script>
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="{{asset('')}}assets/plugins/global/plugins.bundle.js"></script>
        <script src="{{asset('')}}assets/js/scripts.bundle.js"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="{{asset('')}}assets/js/custom/authentication/sign-in/general.js"></script>
        <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
        </body>
        <!--end::Body-->
        </html>
