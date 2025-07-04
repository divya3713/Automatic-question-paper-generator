  <header class="main-header">
    <!-- Logo -->
    <?php if(in_array('viewProfile', $user_permission) || in_array('updateSetting', $user_permission)): ?>
    <a href="<?php echo base_url('users/profile/'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Profile</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b class="text-uppercase"><?php echo $_SESSION['username']; ?></b></span>
    </a>
    <?php endif; ?>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-header">
          <b class="navbar-brand">QUESTION PAPER GENERATOR</b>     
      </div>
    </nav>
  </header> 
  <!-- Left side column. contains the logo and sidebar -->
  