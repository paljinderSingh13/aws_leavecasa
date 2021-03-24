<header class="header">
  <nav class="main_nav">
    <div class="container">
      <div class="row">
        <div class="col main_nav_col d-flex flex-row align-items-center justify-content-start">
          <div class="logo_container">
            <div class="logo"><a href="<?php echo e(route('index')); ?>"><img src="<?php echo e(asset('images/logo1.png')); ?>" alt=""></a></div>
          </div>
          <div class="main_nav_container ml-auto">
            <ul class="main_nav_list">
              <li class="main_nav_item"><a href="<?php echo e(route('index')); ?>">home</a></li>
              <li class="main_nav_item"><a href="">about us</a></li>
              <li class="main_nav_item"><a href="javascript:login()" >login</a></li>
              <li class="main_nav_item"><a href="javascript:signup()">register</a></li>
              <li class="main_nav_item"><a href="">contact</a></li>
              <li class="main_nav_item"><a href="">more</a></li>
            </ul>
          </div>
          <div class="content_search ml-lg-0 ml-auto">
          </div>
          <div class="hamburger">
            <i class="fa fa-bars trans_200"></i>
          </div>
          
        </div>
      </div>
    </div>
  </nav>
</header>
<div class="menu trans_500">
  <div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
    <div class="menu_close_container"><div class="menu_close"></div></div>
    <div class="logo menu_logo"><a href="<?php echo e(route('index')); ?>"><img src="<?php echo e(url('images/90.png')); ?>" alt=""></a></div>
    <ul>
      <li class="menu_item"><a href="<?php echo e(route('index')); ?>">home</a></li>
      <li class="menu_item"><a href="about.html">about us</a></li>
      <li class="menu_item"><a href="javascript:login()" >login</a></li>
      <li class="menu_item"><a href="javascript:signup()">register</a></li>
      <li class="menu_item"><a href="contact.html">contact</a></li>
      <li class="menu_item"><a href="contact.html">more</a></li>
    </ul>
  </div>
</div>
