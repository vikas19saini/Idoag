<header class="main-header">
	
    <a href="{{ URL::route('admin_dashboard') }}" class="logo"><b>Idoag</b> Admin</a>
    
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
  		
         <!-- Sidebar toggle button-->
        <a href="{{ URL::route('admin_dashboard') }}" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        
        </a>
        
        <div class="navbar-custom-menu">
    	
        	<ul class="nav navbar-nav">
      			
                <li><a href="{{ URL::route('home') }}" target="_blank"><i class="fa fa-eye"></i> View Website</a></li>
                
      			<!-- User Account: style can be found in dropdown.less -->
      			<li class="dropdown user user-menu">
        
        			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
          
          				{{ HTML::image('assets/images/avatar.png', '', ['class' => 'user-image']) }}
                        
          				<span class="hidden-xs">{{ ucfirst($loggedin_user->first_name) }}</span>
        			
                    </a>
        
        			<ul class="dropdown-menu">
          				                        
                    	<!-- User image -->
          				<li class="user-header">
            			
                        	{{ HTML::image('assets/images/avatar.png', '', ['class' => 'img-circle']) }}
            				
                        	<p>
                            
                            	{{ ucfirst($loggedin_user->first_name) }}
                                              					
              					<small>Member since {{ date('F Y', strtotime($loggedin_user->created_at)) }}</small>
            				
                            </p>
          				
                        </li>
          
          				<!-- Menu Footer-->
          				<li class="user-footer">
            			            			
                			<a href="{{ URL::route('logout') }}" class="btn btn-default btn-flat">Sign Out</a>
          
          				</li>
        
        			</ul>
      
      			</li>
    
    		</ul>
  		
        </div>

	</nav>

</header>