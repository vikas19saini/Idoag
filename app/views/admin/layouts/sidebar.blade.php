<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
            	{{ HTML::image('assets/images/avatar.png', '', ['class' => 'img-circle']) }}
            </div>

			<div class="pull-left info">
  				<p>{{ ucfirst($loggedin_user->first_name) }}</p>
  				<p>{{ $user_group }}</p>
			</div>
		</div>
		        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="{{ set_active_admin('admin') }}"><a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            
            <li class="treeview @if(Request::segment(2) == 'users' || Request::segment(2) == 'brandsusers' || Request::segment(2) == 'institutions_users' || Request::segment(2) == 'student_users' || Request::segment(2) == 'roles') active @endif">
              	<a href="#">
                	<i class="fa fa-share"></i> <span>Users</span>
                	<i class="fa fa-angle-left pull-right"></i>
              	</a>
              
              	<ul class="treeview-menu" style="{{ set_active_users_tree(Request::path()) }}">
                
                	<li class="{{ set_active_admin('admin/users') }}"><a href="{{ URL::route('admin_users') }}"><i class="fa fa-group"></i> Manage Admin Users</a></li>
                
                	<li class="{{ set_active_admin('admin/brandsusers') }}"><a href="{{ URL::route('admin_brands_users') }}"><i class="fa fa-group"></i> Manage Brand Users</a></li>
                    
                    <li class="{{ set_active_admin('admin/institutions_users') }}"><a href="{{ URL::route('admin_institutions_users') }}"><i class="fa fa-group"></i> Manage Institutions Users</a></li>
                    
                    <li class="{{ set_active_admin('admin/students_users') }}"><a href="{{ URL::route('admin_students_users') }}"><i class="fa fa-group"></i> Manage Student Users</a></li>

                    <li class="{{ set_active_admin('admin/delete_students_users') }}"><a href="{{ URL::route('admin_delete_students_users') }}"><i class="fa fa-group"></i> Manage Delete Users</a></li>

                    {{--<li class="{{ set_active_admin('admin/students_users_demo') }}"><a href="{{ URL::route('admin_students_users_demo') }}"><i class="fa fa-group"></i> Demo</a></li>--}}

                    <li class="{{ set_active_admin('admin/roles') }}"><a href="{{ URL::route('admin_users_roles') }}"><i class="fa fa-user"></i> User Roles</a></li>
				</ul>
            </li>
            
            <li class="{{ set_active_admin('admin/brands') }}"><a href="{{ URL::route('admin_brands') }}"><i class="fa fa-bars"></i> <span>Brands</span></a></li>

            <li class="{{ set_active_admin('admin/institutions') }}"><a href="{{ URL::route('admin_institutions') }}"><i class="fa fa-bars"></i> <span>Institutions</span></a></li>

			<li class="treeview @if(Request::segment(2) == 'students' || Request::segment(2) == 'post-mail-to-all' || Request::segment(2) == 'resend-mail') active @endif"">
                <a href="#">
                    <i class="fa fa-share"></i> <span>All Students</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="{{ set_active_users_tree(Request::path()) }}">
                    <li class="{{ set_active_admin('admin/inst_photos') }}">
                        <a href="{{ URL::route('admin_students') }}"><i class="fa fa-bars"></i> <span>All Students</span></a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-envelope-o"></i> <span>Mail</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ set_active_admin('admin/post-mail-to-all') }}">
                                <a href="{{ URL::route('post-mail-to-all') }}"><i class="fa fa-bars"></i> <span>Send Mail To New Students</span></a>
                            </li>
                            
                            <li class="{{ set_active_admin('admin/resend-mail') }}">
                                <a href="{{ URL::route('resend-mail') }}"><i class="fa fa-bars"></i> <span>Resend Mail</span></a>
                            </li>
                        </ul>
                    </li>
				</ul>
			</li>

            <li class="treeview @if(Request::segment(2) == 'inst_photos' || Request::segment(2) == 'inst_events' || Request::segment(2) == 'inst_links' || Request::segment(2) == 'featured') active @endif">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Institution Posts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="{{ set_active_users_tree(Request::path()) }}">


                    <li class="{{ set_active_admin('admin/inst_photos') }}">
                        <a href="{{ URL::route('admin_inst_photos') }}"><i class="fa fa-bars"></i> <span>Photos</span></a>
                    </li>

                    <li class="{{ set_active_admin('admin/inst_events') }}">
                        <a href="{{ URL::route('admin_inst_events') }}"><i class="fa fa-bars"></i> <span>Events</span></a>
                    </li>

                    <li class="{{ set_active_admin('admin/inst_links') }}">
                        <a href="{{ URL::route('admin_inst_links') }}"><i class="fa fa-bars"></i> <span>Text</span></a>
                    </li>

                  <!--   <li class="{{ set_active_admin('admin/featured') }}">
                        <a href="{{ URL::route('admin_featured') }}"><i class="fa fa-bars"></i> <span>Featured</span></a>
                    </li> -->
                </ul>
            </li>

            <li class="treeview @if(Request::segment(2) == 'offers' || Request::segment(2) == 'links' || Request::segment(2) == 'internship_applications'||  Request::segment(2) == 'events' || Request::segment(2) == 'photos' || Request::segment(2) == 'internships' || Request::segment(2) == 'featured')  active @endif">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Brand Posts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="{{ set_active_users_tree(Request::path()) }}">
                    <li class="{{ set_active_admin('admin/offers') }}">
                        <a href="{{ URL::route('admin_offers') }}"><i class="fa fa-bars"></i> <span>Offers</span></a>
                    </li>

                    <li class="{{ set_active_admin('admin/links') }}">
                        <a href="{{ URL::route('admin_links') }}"><i class="fa fa-bars"></i> <span>Text</span></a>
                    </li>

                    <li class="{{ set_active_admin('admin/photos') }}">
                        <a href="{{ URL::route('admin_photos') }}"><i class="fa fa-bars"></i> <span>Photos</span></a>
                    </li>

                    <li class="{{ set_active_admin('admin/events') }}">
                        <a href="{{ URL::route('admin_events') }}"><i class="fa fa-bars"></i> <span>Events</span></a>
                    </li>

                    <li class="{{ set_active_admin('admin/internships') }}">
                        <a href="{{ URL::route('admin_internships') }}"><i class="fa fa-bars"></i> <span>Internships/Jobs</span></a>
                    </li>
                    <li class="{{ set_active_admin('admin/internship_applications') }}">
                        <a href="{{ URL::route('internship_applications') }}"><i class="fa fa-bars"></i> <span>Internship/Jobs Applications</span></a>
                    </li>

                    <li class="{{ set_active_admin('admin/featured') }}">
                        <a href="{{ URL::route('admin_featured') }}"><i class="fa fa-bars"></i> <span>Featured</span></a>
                    </li>
                </ul>
            </li>

            <li class="treeview @if(Request::segment(2) == 'inst_registrations' || Request::segment(2) == 'brand_registrations' || Request::segment(2) == 'student_registrations') active @endif">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Registrations</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="{{ set_active_users_tree(Request::path()) }}">
                    <li class="{{ set_active_admin('admin/inst_registrations') }}"><a href="{{ URL::route('admin_inst_registrations') }}"><i class="fa fa-bars"></i> <span>Institution Registrations</span></a></li>
                    <li class="{{ set_active_admin('admin/brand_registrations') }}">
                        <a href="{{ URL::route('admin_brand_registrations') }}"><i class="fa fa-bars"></i> <span>Brand Registrations</span></a>
                    </li>
                    <li class="{{ set_active_admin('admin/student_registrations') }}">
                        <a href="{{ URL::route('admin_student_registrations') }}"><i class="fa fa-bars"></i> <span>Student Registrations</span></a>
                    </li>
                </ul>
            </li>

            <li class=" treeview @if(Request::segment(2) == 'reports') active @endif">
                <a href="#">
                    <i class="fa fa-line-chart"></i> <span>Reports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="{{ set_active_users_tree(Request::path()) }}">
                    <li class="{{ set_active_admin('admin/reports/students') }}"><a href="{{ URL::route('admin_reports_students') }}"><i class="fa fa-line-chart"></i> <span>Students by College</span></a></li>
                     <li class="{{ set_active_admin('admin/reports/studentsdata') }}"><a href="{{ URL::route('admin_reports_students_data') }}"><i class="fa fa-line-chart"></i> <span>Active/Inactive Students</span></a></li>
					<li class="{{ set_active_admin('admin/reports/users') }}"><a href="{{ URL::route('admin_reports_users') }}"><i class="fa fa-line-chart"></i> <span>List of Users</span></a></li>
                    <li class="{{ set_active_admin('admin/reports/college') }}"><a href="{{ URL::route('admin_reports_college') }}"><i class="fa fa-line-chart"></i> <span>College Activity Summary</span></a></li>
                    {{--<li class="{{ set_active_admin('admin/reports/users') }}"><a href="{{ URL::route('admin_reports_users') }}"><i class="fa fa-line-chart"></i> <span>List of Users</span></a></li>--}}
                    <li class="{{ set_active_admin('admin/reports/brands') }}"><a href="{{ URL::route('admin_reports_brand') }}"><i class="fa fa-line-chart"></i> <span>Brand Activity Summary</span></a></li>
                    <li class="{{ set_active_admin('admin/reports/internships') }}"><a href="{{ URL::route('admin_reports_internship') }}"><i class="fa fa-line-chart"></i> <span>Internship Activity Summary</span></a></li>
                    <li class="{{ set_active_admin('admin/reports/offers') }}"><a href="{{ URL::route('admin_reports_offers') }}"><i class="fa fa-line-chart"></i> <span>Offer Coupon Usage</span></a></li>
                </ul>
            </li>

            <li class="treeview @if(Request::segment(2) == 'pages' || Request::segment(2) == 'faqs' || Request::segment(2) == 'testimonials' || Request::segment(2) == 'inst_testimonials' || Request::segment(2) == 'problems' || Request::segment(2) == 'enquiries' || Request::segment(2) == 'sliders' || Request::segment(2) == 'ads' || Request::segment(2) == 'press' || Request::segment(2) == 'settings')  active @endif">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Website</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="{{ set_active_users_tree(Request::path()) }}">
                    <li class="{{ set_active_admin('admin/popup') }}"><a href="{{ URL::route('admin_popup') }}"><i class="fa fa-bars"></i> <span>Pop-Up</span></a></li>
                    <li class="{{ set_active_admin('admin/pages') }}"><a href="{{ URL::route('admin_pages') }}"><i class="fa fa-bars"></i> <span>Pages</span></a></li>
                    <li class="{{ set_active_admin('admin/faqs') }}"><a href="{{ URL::route('admin_faqs') }}"><i class="fa fa-bars"></i> <span>FAQs</span></a></li>
                    <li class="{{ set_active_admin('admin/testimonials') }}"><a href="{{ URL::route('admin_testimonials') }}"><i class="fa fa-bars"></i> <span>Brand Testimonials</span></a></li>
                    <li class="{{ set_active_admin('admin/inst_testimonials') }}"><a href="{{ URL::route('admin_inst_testimonials') }}"><i class="fa fa-bars"></i> <span>Inst. Testimonials</span></a></li>
                    <li class="{{ set_active_admin('admin/problems') }}"><a href="{{ URL::route('admin_problems') }}"><i class="fa fa-bars"></i> <span>Report Problems</span></a></li>
                    <li class="{{ set_active_admin('admin/enquiries') }}"><a href="{{ URL::route('admin_enquiries') }}"><i class="fa fa-bars"></i> <span>Enquiries</span></a></li>
                    <li class="{{ set_active_admin('admin/sliders') }}"><a href="{{ URL::route('admin_sliders') }}"><i class="fa fa-bars"></i> <span>Sliders</span></a></li>
                    <li class="{{ set_active_admin('admin/ads') }}"><a href="{{ URL::route('admin_ads') }}"><i class="fa fa-bars"></i> <span>Ads</span></a></li>
                    <li class="{{ set_active_admin('admin/press') }}"><a href="{{ URL::route('admin_sliders_press') }}"><i class="fa fa-bars"></i> <span>Press</span></a></li>
                </ul>
            </li>

            <li class="treeview @if(Request::segment(2) == 'categories' || Request::segment(2) == 'internship_categories' || Request::segment(2) == 'faq_categories') active @endif">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="{{ set_active_users_tree(Request::path()) }}">
                    <li class="{{ set_active_admin('admin/categories') }}"><a href="{{ URL::route('admin_categories') }}"><i class="fa fa-bars"></i> <span>Brand Categories</span></a></li>
                    <li class="{{ set_active_admin('admin/internship_categories') }}">
                        <a href="{{ URL::route('admin_internship_categories') }}"><i class="fa fa-bars"></i> <span>Internship Categories</span></a>
                    </li>
                    <li class="{{ set_active_admin('admin/faq_categories') }}">
                        <a href="{{ URL::route('admin_faq_categories') }}"><i class="fa fa-bars"></i> <span>FAQ Categories</span></a>
                    </li>
                </ul>
            </li>

            <li class="{{ set_active_admin('admin/settings') }}"><a href="{{ URL::route('admin_settings') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
	       <li class="{{ set_active_admin('admin/logs') }}"><a href="{{ URL::route('admin_logs') }}"><i class="fa fa-cog"></i> <span>Logs</span></a></li>                        
        </ul>
    </section>
	<!-- /.sidebar -->
</aside>
