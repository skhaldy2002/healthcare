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
                                                    {{$appointment->medical_record?$appointment->medical_record->diagnosis:old('diagnosis')}}
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
                                                    {{$appointment->medical_record?$appointment->medical_record->treatment:old('treatment')}}
                                                </textarea>
                                </div>
                                <!--end::Input group-->


                            </div>

                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-12 mb-10">
                                    <div class="card card-flush py-4 mt-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Diagnosis Files</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            @if(isset($appointment) && $appointment->medical_record && @$appointment->medical_record->diagnosis_files)
                                                <div class="fv-row mb-2">
                                                    <div class="mt-2">
                                                        @foreach($appointment->medical_record->diagnosis_files as $file)
                                                            <div class="parent_div_file mt-2" id="file_{{ $file->id }}">
                                                                <div class="d-flex align-items-center">
                                                                    <a href="{{ asset('storage/diagnosis-files/' . $file->name) }}" target="_blank" class="btn btn-primary btn-sm me-2">
                                                                        View File
                                                                    </a>
                                                                    <button type="button" class="btn btn-danger btn-sm remove_file"
                                                                            data-file_id="{{ $file->id }}">
                                                                        Delete
                                                                    </button>
                                                                    {{$file->name}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="fv-row mb-2">
                                                <!--begin::Dropzone-->
                                                <div class="dropzone dropzone-default dropzone-primary" id="kt_dropzone_2">
                                                    <div class="dropzone-msg dz-message needsclick">
                                                        <h3 class="dropzone-msg-title">Drop diagnosis files here or click to upload.</h3>
                                                        <span class="dropzone-msg-desc">Upload up to 10 files.</span>
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
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

    <script>
        $(document).ready(function() {
            //set initial state.
            $('body').on('click', '.remove_file', function (e) {
                var file_id = $(this).data('file_id');
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{route('diagnosis.remove.file')}}",
                    data: {
                        'file_id': file_id,
                        'medical_record_id': "{{isset($appointment->medical_record)?$appointment->medical_record->id:null}}",
                    },
                    headers: {
                        'X-CSRF-TOKEN':
                            "{{ csrf_token() }}"
                    },

                    success: function (data) {
                        if (data.status == true) {
                            $('#file_' + file_id).remove();

                        }

                    }

                });

            });







        });
    </script>
    <script>
        // new KTImageInput("avatar");
        Dropzone.autoDiscover = false;
        var uploadedDocumentMap = {}
        $("#kt_dropzone_2").dropzone({
            url: "{{route('diagnosis.upload.file')}}",
            addRemoveLinks: true,
            acceptedFiles: null,
            success:
                function (file, response) {
                    var imgName = response;
                    $('form').append('<input type="hidden" name="medical_record_files[]" value="' + imgName + '">')
                    uploadedDocumentMap[file.name] = imgName
                }
            ,
            error: function (file, response) {
                console.log("aaa");
            },
            removedfile: function(file)
            {

            },
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            },
            init: function () {
                @if(isset($event) && $event->photos)
                var files;
                {!! json_encode($event->photos) !!}
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    console.log(file)
                    $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
                }
                @endif
            }
        });





    </script>


@endsection
