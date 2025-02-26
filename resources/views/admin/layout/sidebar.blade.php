<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('admin_dashboard')}}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('admin_dashboard')}}"></a>
        </div>

        <ul class="sidebar-menu">
            <li class="{{Request::is('admin/dashboard')? 'active':''}}">
                <a class="nav-link" href="{{route('admin_dashboard')}}">
                    <i class="fas fa-tachometer-alt"></i> 
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- Website Setting --}}
            <li class="nav-item dropdown {{ Request::is('admin/setting/*')
             || Request::is('admin/slider/*') 
             || Request::is('admin/welcome-item/*')
             || Request::is('admin/feature/*')
             || Request::is('admin/counter/*')
             || Request::is('admin/testimonial/*')
             || Request::is('admin/team-member/*')
             || Request::is('admin/faq/*')
             || Request::is('admin/home-item/*')
             || Request::is('admin/about-item/*')
             || Request::is('admin/contact-item/*')
             || Request::is('admin/term-privacy-item/*')
              ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i><span>Website Section</span></a>
                <ul class="dropdown-menu">
                    {{-- Setting --}}
                    <li class="{{Request::is('admin/setting/*') ? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_setting_index')}}">
                            <i class="fas fa-angle-right"></i>
                            Settings
                        </a>
                    </li>

                    {{-- Slider --}}
                    <li class="{{Request::is('admin/slider/*') ? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_slider_index')}}">
                            <i class="fas fa-angle-right"></i>
                            Slider
                        </a>
                    </li>

                   {{-- Home Items --}}
                    <li class="{{Request::is('admin/home-item/*') ? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_home_item_index')}}">
                            <i class="fas fa-angle-right"></i>
                            Home Items
                        </a>
                    </li>
                    
                    {{-- About Items --}}
                    <li class="{{Request::is('admin/about-item/*') ? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_about_item_index')}}">
                            <i class="fas fa-angle-right"></i>
                            About Items
                        </a>
                    </li>

                    {{-- Contact Items --}}
                    <li class="{{Request::is('admin/contact-item/*') ? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_contact_item_index')}}">
                            <i class="fas fa-angle-right"></i>
                            Contact Items
                        </a>
                    </li>
                                
                    {{-- FAQ --}}
                    <li class="{{Request::is('admin/faq/*') ? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_faq_index')}}">
                            <i class="fas fa-angle-right"></i>
                            FAQ
                        </a>
                    </li>

                    {{-- Terms & Privacies Items --}}
                    <li class="{{Request::is('admin/term-privacy-item/*') ? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_term_privacy_item_index')}}">
                            <i class="fas fa-angle-right"></i>
                            Terms & Privacies Items
                        </a>
                    </li>
                    
                </ul>
            </li>

            

          
            {{-- Blog Section  --}}
            <li class="nav-item dropdown {{ Request::is('admin/blog-category/*') || Request::is('admin/admin-post/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-pen"></i><span>Blog Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{Request::is('admin/blog-category/*')? 'active':''}}"><a class="nav-link" href="{{route('admin_blog_category_index')}}"><i class="fas fa-angle-right"></i> Category</a></li>
                    <li class="{{Request::is('admin/admin-post/*')? 'active':''}}"><a class="nav-link" href="{{route('admin_post_index')}}"><i class="fas fa-angle-right"></i> Posts</a></li>
                </ul>
            </li>

            
            {{-- Destinations --}}
            <li class="{{Request::is('admin/destination/*')? 'active':''}}">
                <a class="nav-link" href="{{route('admin_destination_index')}}">
                    <i class="fas fa-map-marker-alt"></i> 
                    <span>Destination</span>
                </a>
            </li>

            {{-- Packages --}}
            <li class="{{Request::is('admin/all-packages')
                ||Request::is('admin/package-amenities/*') 
                ||Request::is('admin/package-photos/*')
                ||Request::is('admin/package-videos/*')
                ||Request::is('admin/package-faqs/*')
                ||Request::is('admin/package-itineraries/*')? 'active':''}}">
                <a class="nav-link" href="{{route('admin_package_index')}}">
                    <i class="fas fa-gift"></i> 
                    <span>Package</span>
                </a>
            </li>

            

            {{-- Cooperators --}}
            <li class="{{Request::is('cooperator/*')? 'active':''}}">
                <a class="nav-link" href="{{route('admin_cooperators')}}">
                    <i class="fas fa-people-arrows"></i> 
                    <span>Cooperators</span>
                </a>
            </li>


            {{-- User Section --}}
            <li class="nav-item dropdown {{ Request::is('admin/message/*') || Request::is('admin/users') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>User Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{Request::is('admin/users')? 'active':''}}"><a class="nav-link" href="{{route('admin_users')}}"><i class="fas fa-angle-right"></i> User</a></li>
                    <li class="{{Request::is('admin/message/*')? 'active':''}}"><a class="nav-link" href="{{route('admin_message')}}"><i class="fas fa-angle-right"></i> Message</a></li>
                </ul>
            </li>

            {{-- Reviews --}}
            <li class="{{Request::is('admin/review/*')  ? 'active':''}}">
                <a class="nav-link" href="{{route('admin_review_index')}}">
                    <i class="fas fa-star"></i> 
                    <span>Reviews</span>
                </a>
            </li>

            {{-- Tourguide Prices --}}
            <li class="{{Request::is('admin/tourguide-price/*')  ? 'active':''}}">
                <a class="nav-link" href="{{route('admin_tourguide_prices_index')}}">
                    <i class="fas fa-star"></i> 
                    <span>Tourguide Prices</span>
                </a>
            </li>


             {{-- Data  --}}
             <li class="nav-item dropdown {{ Request::is('admin/amenity/*')
                || Request::is('admin/room-category/*')
                || Request::is('admin/transportation-type/*')
                || Request::is('admin/package-title/*')
                || Request::is('admin/tour-title/*')
                 ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i><span>Data Section</span></a>
                <ul class="dropdown-menu">
                    {{-- Amenity --}}
                    <li class="{{Request::is('admin/amenity/*')? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_amenity_index')}}">
                            <i class="fas fa-angle-right"></i> Amenity
                        </a>
                    </li>

                    {{-- Room Categories --}}
                    <li class="{{Request::is('admin/room-category/*')? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_room_categories_index')}}">
                            <i class="fas fa-angle-right"></i> Room Category
                        </a>
                    </li>

                    {{-- Transportation Types --}}
                    <li class="{{Request::is('admin/transportation-type/*')? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_transportation_types_index')}}">
                            <i class="fas fa-angle-right"></i> Transportation Types
                        </a>
                    </li>

                    {{-- Package Titles Types --}}
                    <li class="{{Request::is('admin/package-title/*')? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_package_titles_index')}}">
                            <i class="fas fa-angle-right"></i> Package Titles
                        </a>
                    </li>


                     {{-- Tour Titles Types --}}
                     <li class="{{Request::is('admin/tour-title/*')? 'active':''}}">
                        <a class="nav-link" href="{{route('admin_tour_titles_index')}}">
                            <i class="fas fa-angle-right"></i> Tour Titles
                        </a>
                    </li>
                   
                </ul>
            </li>

           

            {{-- Subscriber Section --}}
            <li class="nav-item dropdown {{ Request::is('admin/subscribers') || Request::is('admin/subscriber/send-email') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i><span>Subscriber Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/subscribers') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_subscribers') }}"><i class="fas fa-angle-right"></i>All Subscribers</a>
                    </li>
                    <li class="{{Request::is('admin/subscriber/send-email') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_subscriber_send_email') }}"><i class="fas fa-angle-right"></i>Send Email</a>
                    </li>
                </ul>
            </li>
            
            



        
           
            
            <li class="{{Request::is('admin/profile')? 'active':''}}"><a class="nav-link" href="{{route('admin_profile')}}"><i class="fas fa-user"></i> <span>Profile</span></a></li>

            

        </ul>
    </aside>
</div>