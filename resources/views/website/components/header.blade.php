<header id="header" class="navbar-static-top">
    
    <div class="main-header">
        
        <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
            Mobile Menu Toggle
        </a>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('index') }}" title="Travelo - home">
                        <img src="https://45.114.142.192/images/logo1.png?ref={{ rand(1000,999999) }}" alt="Leavecasa" style="width: 44%;" />
                    </a>
                </div>
                <div class="col-md-8">
                    <nav id="main-menu" role="navigation">
                        <ul class="menu">
                            <li>
                                <a href="{{ route('index') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('index') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('index') }}">Price</a>
                            </li>
                            <li>
                                <a href="{{ route('index') }}">Contact Us</a>
                            </li>
                            {{-- <li class="menu-item-has-children">
                                <a href="hotel-index.html">Hotels</a>
                                <ul>
                                    <li><a href="hotel-index.html">Home Hotels</a></li>
                                    <li><a href="hotel-list-view.html">List View</a></li>
                                    <li><a href="hotel-grid-view.html">Grid View</a></li>
                                    <li><a href="hotel-block-view.html">Block View</a></li>
                                    <li><a href="hotel-detailed.html">Detailed</a></li>
                                    <li><a href="hotel-booking.html">Booking</a></li>
                                    <li><a href="hotel-thankyou.html">Thank You</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </nav>  
                </div>
            </div>

        </div>
        
        <nav id="mobile-menu-01" class="mobile-menu collapse">
            <ul id="mobile-primary-menu" class="menu">
                <li class="menu-item-has-children">
                    <a href="index.html">Home</a>
                    <ul>
                        <li><a href="index.html">Home Layout 1</a></li>
                        <li><a href="homepage2.html">Home Layout 2</a></li>
                        <li><a href="homepage3.html">Home Layout 3</a></li>
                        <li><a href="homepage4.html">Home Layout 4</a></li>
                        <li><a href="homepage5.html">Home Layout 5</a></li>
                        <li><a href="homepage6.html">Home Layout 6</a></li>
                        <li><a href="homepage7.html">Home Layout 7</a></li>
                        <li><a href="homepage8.html">Home Layout 8</a></li>
                        <li><a href="homepage9.html">Home Layout 9</a></li>
                        <li><a href="homepage10.html">Home Layout 10</a></li>
                        <li><a href="homepage11.html">Home Layout 11</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="hotel-index.html">Hotels</a>
                    <ul>
                        <li><a href="hotel-index.html">Home Hotels</a></li>
                        <li><a href="hotel-list-view.html">List View</a></li>
                        <li><a href="hotel-grid-view.html">Grid View</a></li>
                        <li><a href="hotel-block-view.html">Block View</a></li>
                        <li><a href="hotel-detailed.html">Detailed</a></li>
                        <li><a href="hotel-booking.html">Booking</a></li>
                        <li><a href="hotel-thankyou.html">Thank You</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="flight-index.html">Flights</a>
                    <ul>
                        <li><a href="flight-index.html">Home Flights</a></li>
                        <li><a href="flight-list-view.html">List View</a></li>
                        <li><a href="flight-grid-view.html">Grid View</a></li>
                        <li><a href="flight-block-view.html">Block View</a></li>
                        <li><a href="flight-detailed.html">Detailed</a></li>
                        <li><a href="flight-booking.html">Booking</a></li>
                        <li><a href="flight-thankyou.html">Thank You</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="car-index.html">Cars</a>
                    <ul>
                        <li><a href="car-index.html">Home Cars</a></li>
                        <li><a href="car-list-view.html">List View</a></li>
                        <li><a href="car-grid-view.html">Grid View</a></li>
                        <li><a href="car-block-view.html">Block View</a></li>
                        <li><a href="car-detailed.html">Detailed</a></li>
                        <li><a href="car-booking.html">Booking</a></li>
                        <li><a href="car-thankyou.html">Thank You</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="cruise-index.html">Cruises</a>
                    <ul>
                        <li><a href="cruise-index.html">Home Cruises</a></li>
                        <li><a href="cruise-list-view.html">List View</a></li>
                        <li><a href="cruise-grid-view.html">Grid View</a></li>
                        <li><a href="cruise-block-view.html">Block View</a></li>
                        <li><a href="cruise-detailed.html">Detailed</a></li>
                        <li><a href="cruise-booking.html">Booking</a></li>
                        <li><a href="cruise-thankyou.html">Thank You</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Pages</a>
                    <ul>
                        <li class="menu-item-has-children">
                            <a href="#">Standard Pages</a>
                            <ul>
                                <li><a href="pages-aboutus1.html">About Us 1</a></li>
                                <li><a href="pages-aboutus2.html">About Us 2</a></li>
                                <li><a href="pages-services1.html">Services 1</a></li>
                                <li><a href="pages-services2.html">Services 2</a></li>
                                <li><a href="pages-photogallery-4column.html">Gallery 4 Column</a></li>
                                <li><a href="pages-photogallery-3column.html">Gallery 3 Column</a></li>
                                <li><a href="pages-photogallery-2column.html">Gallery 2 Column</a></li>
                                <li><a href="pages-photogallery-fullview.html">Gallery Read</a></li>
                                <li><a href="pages-blog-rightsidebar.html">Blog Right Sidebar</a></li>
                                <li><a href="pages-blog-leftsidebar.html">Blog Left Sidebar</a></li>
                                <li><a href="pages-blog-fullwidth.html">Blog Full Width</a></li>
                                <li><a href="pages-blog-read.html">Blog Read</a></li>
                                <li><a href="pages-faq1.html">Faq 1</a></li>
                                <li><a href="pages-faq2.html">Faq 2</a></li>
                                <li><a href="pages-layouts-leftsidebar.html">Layouts Left Sidebar</a></li>
                                <li><a href="pages-layouts-rightsidebar.html">Layouts Right Sidebar</a></li>
                                <li><a href="pages-layouts-twosidebar.html">Layouts Two Sidebar</a></li>
                                <li><a href="pages-layouts-fullwidth.html">Layouts Full Width</a></li>
                                <li><a href="pages-contactus1.html">Contact Us 1</a></li>
                                <li><a href="pages-contactus2.html">Contact Us 2</a></li>
                                <li><a href="pages-contactus3.html">Contact Us 3</a></li>
                                <li><a href="pages-travelo-policies.html">Travelo Policies</a></li>
                                <li><a href="pages-sitemap.html">Site Map</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Extra Pages</a>
                            <ul>
                                <li><a href="extra-pages-holidays.html">Holidays</a></li>
                                <li><a href="extra-pages-hotdeals.html">Hot Deals</a></li>
                                <li><a href="extra-pages-before-you-fly.html">Before You Fly</a></li>
                                <li><a href="extra-pages-inflight-experience.html">Inflight Experience</a></li>
                                <li><a href="extra-pages-things-todo1.html">Things To Do 1</a></li>
                                <li><a href="extra-pages-things-todo2.html">Things To Do 2</a></li>
                                <li><a href="extra-pages-travel-essentials.html">Travel Essentials</a></li>
                                <li><a href="extra-pages-travel-stories.html">Travel Stories</a></li>
                                <li><a href="extra-pages-travel-guide.html">Travel Guide</a></li>
                                <li><a href="extra-pages-travel-ideas.html">Travel Ideas</a></li>
                                <li><a href="extra-pages-travel-insurance.html">Travel Insurance</a></li>
                                <li><a href="extra-pages-group-booking.html">Group Bookings</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Special Pages</a>
                            <ul>
                                <li><a href="pages-404-1.html">404 Page 1</a></li>
                                <li><a href="pages-404-2.html">404 Page 2</a></li>
                                <li><a href="pages-404-3.html">404 Page 3</a></li>
                                <li><a href="pages-coming-soon1.html">Coming Soon 1</a></li>
                                <li><a href="pages-coming-soon2.html">Coming Soon 2</a></li>
                                <li><a href="pages-coming-soon3.html">Coming Soon 3</a></li>
                                <li><a href="pages-loading1.html">Loading Page 1</a></li>
                                <li><a href="pages-loading2.html">Loading Page 2</a></li>
                                <li><a href="pages-loading3.html">Loading Page 3</a></li>
                                <li><a href="pages-login1.html">Login Page 1</a></li>
                                <li><a href="pages-login2.html">Login Page 2</a></li>
                                <li><a href="pages-login3.html">Login Page 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Shortcodes</a>
                    <ul>
                        <li><a href="shortcode-accordions-toggles.html">Accordions &amp; Toggles</a></li>
                        <li><a href="shortcode-tabs.html">Tabs</a></li>
                        <li><a href="shortcode-buttons.html">Buttons</a></li>
                        <li><a href="shortcode-icon-boxes.html">Icon Boxes</a></li>
                        <li><a href="shortcode-gallery-styles.html">Image &amp; Gallery Styles</a></li>
                        <li><a href="shortcode-image-box-styles.html">Image Box Styles</a></li>
                        <li class="menu-item-has-children">
                            <a href="#">Listing Styles</a>
                            <ul>
                                <li><a href="shortcode-listing-style1.html">Listing Style 01</a></li>
                                <li><a href="shortcode-listing-style2.html">Listing Style 02</a></li>
                                <li><a href="shortcode-listing-style3.html">Listing Style 03</a></li>
                            </ul>
                        </li>
                        <li><a href="shortcode-dropdowns.html">Dropdowns</a></li>
                        <li><a href="shortcode-pricing-tables.html">Pricing Tables</a></li>
                        <li><a href="shortcode-testimonials.html">Testimonials</a></li>
                        <li><a href="shortcode-our-team.html">Our Team</a></li>
                        <li><a href="shortcode-gallery-popup.html">Gallery Popup</a></li>
                        <li><a href="shortcode-map-popup.html">Map Popup</a></li>
                        <li><a href="shortcode-style-changer.html">Style Changer</a></li>
                        <li><a href="shortcode-typography.html">Typography</a></li>
                        <li><a href="shortcode-animations.html">Animations</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Bonus</a>
                    <ul>
                        <li><a href="dashboard1.html">Dashboard 1</a></li>
                        <li><a href="dashboard2.html">Dashboard 2</a></li>
                        <li><a href="dashboard3.html">Dashboard 3</a></li>
                        <li class="menu-item-has-children">
                            <a href="#">7 Footer Styles</a>
                            <ul>
                                <li><a href="#">Default Style</a></li>
                                <li><a href="footer-style1.html">Footer Style 1</a></li>
                                <li><a href="footer-style2.html">Footer Style 2</a></li>
                                <li><a href="footer-style3.html">Footer Style 3</a></li>
                                <li><a href="footer-style4.html">Footer Style 4</a></li>
                                <li><a href="footer-style5.html">Footer Style 5</a></li>
                                <li><a href="footer-style6.html">Footer Style 6</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">8 Header Styles</a>
                            <ul>
                                <li><a href="#">Default Style</a></li>
                                <li><a href="header-style1.html">Header Style 1</a></li>
                                <li><a href="header-style2.html">Header Style 2</a></li>
                                <li><a href="header-style3.html">Header Style 3</a></li>
                                <li><a href="header-style4.html">Header Style 4</a></li>
                                <li><a href="header-style5.html">Header Style 5</a></li>
                                <li><a href="header-style6.html">Header Style 6</a></li>
                                <li><a href="header-style7.html">Header Style 7</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">7 Inner Start Styles</a>
                            <ul>
                                <li><a href="#">Default Style</a></li>
                                <li><a href="inner-starts-style1.html">Inner Start Style 1</a></li>
                                <li><a href="inner-starts-style2.html">Inner Start Style 2</a></li>
                                <li><a href="inner-starts-style3.html">Inner Start Style 3</a></li>
                                <li><a href="inner-starts-style4.html">Inner Start Style 4</a></li>
                                <li><a href="inner-starts-style5.html">Inner Start Style 5</a></li>
                                <li><a href="inner-starts-style6.html">Inner Start Style 6</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">3 Search Styles</a>
                            <ul>
                                <li><a href="search-style1.html">Search Style 1</a></li>
                                <li><a href="search-style2.html">Search Style 2</a></li>
                                <li><a href="search-style3.html">Search Style 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            
            <ul class="mobile-topnav container">
                <li><a href="#">MY ACCOUNT</a></li>
                <li class="ribbon language menu-color-skin">
                    <a href="#" data-toggle="collapse">ENGLISH</a>
                    <ul class="menu mini">
                        <li><a href="#" title="Dansk">Dansk</a></li>
                        <li><a href="#" title="Deutsch">Deutsch</a></li>
                        <li class="active"><a href="#" title="English">English</a></li>
                        <li><a href="#" title="Espa??ol">Espa??ol</a></li>
                        <li><a href="#" title="Fran??ais">Fran??ais</a></li>
                        <li><a href="#" title="Italiano">Italiano</a></li>
                        <li><a href="#" title="Magyar">Magyar</a></li>
                        <li><a href="#" title="Nederlands">Nederlands</a></li>
                        <li><a href="#" title="Norsk">Norsk</a></li>
                        <li><a href="#" title="Polski">Polski</a></li>
                        <li><a href="#" title="Portugu??s">Portugu??s</a></li>
                        <li><a href="#" title="Suomi">Suomi</a></li>
                        <li><a href="#" title="Svenska">Svenska</a></li>
                    </ul>
                </li>
                <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
                <li><a href="#travelo-signup" class="soap-popupbox">SIGNUP</a></li>
                <li class="ribbon currency menu-color-skin">
                    <a href="#">USD</a>
                    <ul class="menu mini">
                        <li><a href="#" title="AUD">AUD</a></li>
                        <li><a href="#" title="BRL">BRL</a></li>
                        <li class="active"><a href="#" title="USD">USD</a></li>
                        <li><a href="#" title="CAD">CAD</a></li>
                        <li><a href="#" title="CHF">CHF</a></li>
                        <li><a href="#" title="CNY">CNY</a></li>
                        <li><a href="#" title="CZK">CZK</a></li>
                        <li><a href="#" title="DKK">DKK</a></li>
                        <li><a href="#" title="EUR">EUR</a></li>
                        <li><a href="#" title="GBP">GBP</a></li>
                        <li><a href="#" title="HKD">HKD</a></li>
                        <li><a href="#" title="HUF">HUF</a></li>
                        <li><a href="#" title="IDR">IDR</a></li>
                    </ul>
                </li>
            </ul>
            
        </nav>
    </div>
   
</header>