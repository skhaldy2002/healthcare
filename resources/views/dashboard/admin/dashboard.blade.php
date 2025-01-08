@extends('dashboard.layout.master')
@section('content')

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->

                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5"> Doctors</div>
                            <div class="fw-bold text-white">{{\App\Models\User::query()->doctors()->count()}}

                            </div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->

                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5"> Patients</div>
                            <div class="fw-bold text-white">{{\App\Models\User::query()->patients()->count()}}

                            </div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-success hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->

                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5"> Appointments</div>
                            <div class="fw-bold text-white">{{\App\Models\Appointment::query()->count()}}

                            </div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>

            </div>

        </div>
    </div>
@endsection
