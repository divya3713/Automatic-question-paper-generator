

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Groups</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">groups</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Group</h3>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <table class="table table-responsive icheck">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th colspan="3" style="text-align:center;"><h3>Permission</h3></th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Users</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createUser">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateUser">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewUser">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteUser">Delete</label></td>
                      </tr>

                      <tr>
                        <td>Groups Permission</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createGroup">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateGroup">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewGroup">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteGroup">Delete</label></td>
                      </tr>

                      <tr>
                        <td>Course</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createCourse">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateCourse">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewCourse">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteCourse">Delete</label></td>
                      </tr>

                      <tr>
                        <td>Subject</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createSubject">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateSubject">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewSubject">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteSubject">Delete</label></td>
                      </tr>

                      <tr>
                        <td>Question</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createQuestion">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateQuestion">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewQuestion">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteQuestion">Delete</label></td>
                      </tr>

                      <tr>
                        <td>Unit</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createUnit">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateUnit">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewUnit">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteUnit">Delete</label></td>
                      </tr>

                      <tr>
                        <td>Question Type Setting</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createQtype">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateQtype">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewQtype">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteQtype">Delete</label></td>
                      </tr>

                      <tr>
                        <td>QPaper</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createQPaper">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateQPaper">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewQPaper">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteQPaper">Delete</label></td>
                      </tr>

                      <tr>
                        <td>QTemplete</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createQTemplete">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateQTemplete">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewQTemplete">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteQTemplete">Delete</label></td>
                      </tr>

                      <tr>
                        <td>Institution</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createInstitution">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateInstitution">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewInstitution">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteInstitution">Delete</label></td>
                      </tr>

                      <tr>
                        <td>Profile</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createProfile">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateProfile">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewProfile">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteProfile">Delete</label></td>
                      </tr>

                      <tr>
                        <td>Setting</td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="createSetting">Create</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="updateSetting">Update</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="viewSetting">View</label></td>
                        <td><label><input type="checkbox" name="permission[]" id="permission" value="deleteSetting">Delete</label></td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo base_url('groups/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $('#groupMainNav').addClass('active');
      $('#createGroupSubMenu').addClass('active');
    });
  </script>

