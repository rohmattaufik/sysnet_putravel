<header class="main-header">

<!-- Logo -->
<a href="<?php echo e(url('/')); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>PU</b>T</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>PU</b> - Travel</span>
</a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            
                
                
                    
                    
                
                
                    
                    
                        
                        
                            
                                
                                    
                                        
                                        
                                    
                                    
                                    
                                        
                                        
                                    
                                    
                                    
                                
                            
                            
                        
                        
                    
                    
                
            
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
            
                
                
                    
                    
                
                
                    
                    
                        
                        
                            
                                
                                    
                                
                            
                            
                        
                    
                    
                
            
            <!-- Tasks Menu -->
            
                
                
                    
                    
                
                
                    
                    
                        
                        
                            
                                
                                    
                                    
                                        
                                        
                                    
                                    
                                    
                                        
                                        
                                             
                                            
                                        
                                    
                                
                            
                            
                        
                    
                    
                        
                    
                
            
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="<?php echo e(URL::asset('dist/img/user2-160x160.jpg')); ?>" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">Luthfi Abdurrahim</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                        <img src="<?php echo e(URL::asset('dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">

                        <p>
                            Luthfi Abdurrahim - Admin PU
                            
                        </p>
                    </li>
                    <!-- Menu Body -->
                    
                        
                            
                                
                            
                            
                                
                            
                            
                                
                            
                        
                        
                    
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        
                            
                        
                        <div class="pull-right">
                            <a href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                               class="btn btn-default btn-flat">
                                Sign out
                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>

                            
                                
                                
                                   
                                   
                                    
                                
                            
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Right Sidebar Toggle Button -->
            
                
            
        </ul>
    </div>
</nav>
</header>