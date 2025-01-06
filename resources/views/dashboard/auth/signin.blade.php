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
                        <!--begin::Wrapper-->
                        <div class="w-lg-500px p-10 p-lg-15 w-100">
                            <!--begin::Form-->
                            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post"
                                  action="{{route('custom-login')}}">
                                @csrf
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-3">{{__('Sign In')}}</h1>
                                    <!--end::Title-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">

                                    @include('dashboard.validation.session')
                                    @include('dashboard.validation.alerts')
                                    <!--begin::Label-->
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Email')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-lg form-control-solid" type="text"
                                           name="email" value="{{old('email')}}" autocomplete="off"/>
                                    <!--end::Input-->
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack mb-2">
                                        <!--begin::Label-->
                                        <label
                                            class="form-label fw-bolder text-dark fs-6 mb-0">{{__('Password')}}</label>
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                           name="password" autocomplete="off"/>
                                    <!--end::Input-->
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center">
                                    {{--                            <!--begin::Submit button-->--}}
                                    <button type="submit" id="kt_sign_in_submits"
                                            class="btn btn-lg btn-success w-100 mb-5">
                                        <span class="indicator-label">{{__('Sign In')}}</span>
                                        <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                            <div class="text-center">
                                {{--                            <!--begin::Submit button-->--}}
                                <a href="{{route('patient_or_doctor_signup')}}"
                                        class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">Sign up</span>
                                </a>
                            </div>
                        </div>
                        <!--end::Wrapper-->
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
