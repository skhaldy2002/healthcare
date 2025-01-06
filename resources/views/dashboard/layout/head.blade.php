
<title>{{getSettingByKey($settings,'site_name')->value }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta charset="utf-8" />
<link rel="shortcut icon" href="{{getSettingByKey($settings,'site_icon')->value}}" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<link href="{{asset('')}}assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="{{asset('')}}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Page Vendor Stylesheets-->
<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="{{asset('')}}assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Page Vendor Stylesheets-->
<!--begin::Global Stylesheets Bundle(used by all pages)-->
<link href="{{asset('')}}assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{asset('')}}assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{asset('')}}assets/css/custom.ltr.css" rel="stylesheet" type="text/css" />
<link href="{{asset('')}}assets/css/custom.css" rel="stylesheet" type="text/css" />

{{--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>--}}
<script src="{{asset('')}}assets/plugins/global/axios.js"></script>
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
<link href="{{asset('')}}assets/css/flatpickr.min.css" rel="stylesheet" type="text/css" />

{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">--}}


@yield('head')
