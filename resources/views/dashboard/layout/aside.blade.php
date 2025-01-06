<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">

    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="#">
            Medical clinic
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <div class="separator my-2"></div>
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
             data-kt-scroll-offset="0">
                @if(isAdmin())
                    @include('dashboard.layout.admin_aside_menu')
            @elseif(isDoctor())
                @include('dashboard.layout.doctor_aside_menu')
            @elseif(isPatient())
                @include('dashboard.layout.patient_aside_menu')
            @endif
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
