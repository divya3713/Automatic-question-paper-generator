<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php if($user_permission): ?> 
          
        <li class="header"><b>QPG</b> MENU</li>

        
        <?php if(in_array('createCourse', $user_permission) || in_array('updateCourse', $user_permission) || in_array('viewCourse', $user_permission) || in_array('deleteCourse', $user_permission)): ?>
          <li id="courseMainNav">
              <a href="<?php echo base_url('course') ?>">
                <i class="fa fa-graduation-cap"></i>
                  <span>Course</span>
              </a>           
          </li>
        <?php endif; ?>
       
        <?php if(in_array('createSubject', $user_permission) || in_array('updateSubject', $user_permission) || in_array('viewSubject', $user_permission) || in_array('deleteSubject', $user_permission)): ?>
            <li class="treeview" id="subjectMainNav">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Subject</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <?php if(in_array('createSubject', $user_permission)): ?>
                  <li id="createSubjectSubMenu">
                    <a href="<?php echo base_url('subject/create') ?>">
                      <i class="fa fa-plus"></i> Add Subject
                    </a>
                  </li>
                  <li id="addUnitSubMenu">
                    <a href="<?php echo base_url('subject/addunit') ?>">
                      <i class="fa fa-plus"></i> Add Subject Unit
                    </a>
                  </li>
                <?php endif; ?>

                <?php if(in_array('updateSubject', $user_permission) || in_array('viewSubject', $user_permission) || in_array('deleteSubject', $user_permission)): ?>
                <li id="manageSubjectSubMenu">
                  <a href="<?php echo base_url('subject') ?>">
                    <i class="fa fa-gear"></i> Manage Subject
                  </a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

         <?php if(in_array('createQuestion', $user_permission) || in_array('updateQuestion', $user_permission) || in_array('viewQuestion', $user_permission) || in_array('deleteQuestion', $user_permission)): ?>
          <li class="treeview" id="questionMainNav">
            <a href="#">
                <i class="fa fa-file-o"></i>
                <span>Question</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <?php if(in_array('createQuestion', $user_permission)): ?>
                <li id="createQuestionSubMenu">
                  <a href="<?php echo base_url('question/qcreate') ?>">
                    <i class="fa fa-plus"></i> Set Question
                  </a>
                </li>
              <?php endif; ?>

              <?php if(in_array('updateQuestion', $user_permission) || in_array('viewQuestion', $user_permission) || in_array('deleteQuestion', $user_permission)): ?>
                <li id="manageQuestionSubMenu">
                  <a href="<?php echo base_url('question') ?>">
                    <i class="fa fa-gear"></i> <span>Manage Question</span>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <?php if(in_array('createQPaper', $user_permission) || in_array('updateQPaper', $user_permission) || in_array('viewQPaper', $user_permission) || in_array('deleteQPaper', $user_permission)): ?>
          <li class="treeview" id="qpaperMainNav">
            <a href="#">
                <i class="fa fa-file-o"></i>
                <span>Question Paper Generator</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
             
              <?php if(in_array('createQPaper', $user_permission)): ?>
                <li id="screateQPaperSubMenu">
                  <a href="<?php echo base_url('qpaper/screate') ?>">
                    <i class="fa fa-plus"></i> Set Semester Paper
                  </a>
                </li>
              <?php endif; ?>
 
              <?php if(in_array('createQPaper', $user_permission)): ?>
                <li id="ucreateQPaperSubMenu">
                  <a href="<?php echo base_url('qpaper/create') ?>">
                    <i class="fa fa-plus"></i> Set Mid Paper
                  </a>
                </li>
              <?php endif; ?>

              <?php if(in_array('updateQPaper', $user_permission) || in_array('viewQPaper', $user_permission) || in_array('deleteQPaper', $user_permission)): ?>
                <li id="manageQPaperSubMenu">
                  <a href="<?php echo base_url('qpaper') ?>">
                    <i class="fa fa-gear"></i> <span>Manage Paper</span>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

          
          <li class="header">
            <i class="fa fa-gears"></i> Settings
          </li>
          <?php if(in_array('viewProfile', $user_permission) || in_array('editSetting', $user_permission)): ?>
            <li id="profileMainNav">
              <a href="<?php echo base_url('users/profile/') ?>">
                <i class="fa fa-user"></i> <span>Profile</span>
             </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('updateInstitution', $user_permission)): ?>
            <li id="institutionMainNav">
              <a href="<?php echo base_url('institution') ?>">
                <i class="fa fa-building"></i> <span>Institution Info</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('viewQtype', $user_permission) || in_array('updateQtype', $user_permission)): ?>
            <li id="typeMainNav">
                <a href="<?php echo base_url('type') ?>">
                  <i class="fa fa-gears"></i>
                    <span>Question Setting</span>
                </a>           
            </li>
          <?php endif; ?>         

          <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
            <li class="treeview" id="userMainNav">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Faculty</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <?php if(in_array('createUser', $user_permission)): ?>
                <li id="createUserSubNav">
                  <a href="<?php echo base_url('users/create') ?>">
                    <i class="fa fa-plus"></i> Add Faculty
                  </a>
                </li>
                <?php endif; ?>

                <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                <li id="manageUserSubNav">
                  <a href="<?php echo base_url('users') ?>">
                    <i class="fa fa-gear"></i> Manage Faculty
                  </a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="groupMainNav">
              <a href="#">
                <i class="fa fa-key"></i>
                <span>Faculty Permission</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="createGroupSubMenu">
                    <a href="<?php echo base_url('groups/create') ?>">
                      <i class="fa fa-plus"></i> Add Permission
                    </a>
                  </li>
                <?php endif; ?>

                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupSubMenu">
                  <a href="<?php echo base_url('groups') ?>">
                    <i class="fa fa-gear"></i> Manage Permission
                  </a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
        <?php endif; ?>
        
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>