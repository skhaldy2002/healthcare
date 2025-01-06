<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    @foreach($page_breadcrumbs as $bread)
        @if($bread['active'])
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="{{$bread['page']}}" class="text-muted text-hover-primary">{{$bread['title']}}</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
        @else
            <!--begin::Item-->
            <li class="breadcrumb-item text-active">{{$bread['title']}}</li>
            <!--end::Item-->
        @endif



    @endforeach
</ul>
