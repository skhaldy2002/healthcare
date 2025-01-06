<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-center">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2023©</span>
            <a href="{{route(getIndexRouteByUserRole())}}" target="_blank" class="text-gray-800 text-hover-primary">{{getSettingByKey($settings,'site_name')->value}}</a>
        </div>
        <!--end::Copyright-->
    </div>
    <!--end::Container-->
</div>
