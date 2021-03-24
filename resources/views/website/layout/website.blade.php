<!DOCTYPE html>
<html>
@include('website.components.head')
<body>
    <div id="page-wrapper">
        @include('website.components.header')
        @if(in_array(request()->route()->getName(),['index']))
            @include('website.components.slider')
        {{-- @else
            @include('website.components.breadcrumbs') --}}
        @endif
            
        @yield('content')
        
        @include('website.components.footer')
    </div>
    @include('website.components.scripts')
</body>
</html>

