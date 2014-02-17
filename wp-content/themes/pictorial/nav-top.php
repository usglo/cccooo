          
    <div class="navbar">
        <div class="navbar-inner">
        
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".bottom-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
			<!-- Our menu needs to go here -->
			<?php wp_nav_menu( array(
	           'theme_location'	 => 'primary',
			   'container_class' => 'nav-collapse bottom-collapse',
	           'menu_class'		 =>	'nav',
	           'depth'			 =>	0,
	           'fallback_cb'	 =>	false,
	           'walker'			 =>	new Pictorial_Nav_Walker,
	           )); 
            ?>
        
		</div><!-- /.navbar-inner -->
	</div><!-- /.navbar -->
