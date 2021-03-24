<!DOCTYPE html>
<html lang="en">
    <!-- Mirrored from www.themeon.net/nifty/v2.9/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Mar 2018 16:38:40 GMT -->
    @include('layouts.components.head')
    <!--TIPS-->
    <!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
    <body>
        <div id="container" class="effect aside-float aside-bright mainnav-lg">
            @include('layouts.components.header')
            <div class="boxed">
                
                @yield('content')

                @include('layouts.components.aside')

                @include('layouts.components.menu')
            </div>
            

            @include('layouts.components.footer')

            <!-- SCROLL PAGE BUTTON -->
            <!--===================================================-->
            <button class="scroll-top btn">
                <i class="pci-chevron chevron-up"></i>
            </button>
            <!--===================================================-->
        </div>
        @include('layouts.components.scripts')
    </body>
    <!-- Mirrored from www.themeon.net/nifty/v2.9/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Mar 2018 16:39:48 GMT -->
</html>