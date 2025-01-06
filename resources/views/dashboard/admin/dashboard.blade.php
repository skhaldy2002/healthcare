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
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5"> Admins</div>
                            <div class="fw-bold text-white">10

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
