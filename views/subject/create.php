
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Subject</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Subject</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

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
            <h3 class="box-title">Add Subject</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>              
                <div class="form-group">
                  <label for="course">Course</label>
                  <select class="form-control select_group" id="course_id" name="course_id">          
                      <option value="">Select Course</option>
                      <?php foreach ($course as $k => $v): ?>
                          <option value="<?php echo $v['cid']; ?>">
                              <?php echo $v['course_name']; ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
                </div>


                <div class="form-group">
                    <label for="semester">semester</label>
                    <select class="form-control select_group" id="sem_id" name="sem_id">
                        <option value="">Select semester</option>
                        <option>I</option>
                        <option>II</option>
                        <option>III</option>
                        <option>IV</option>
                        <option>V</option>
                        <option>VI</option>
                        <option>VII</option>
                        <option>VIII</option>
                    </select>
                </div>

                 

                <div class="form-group">
                  <label for="subject_name">Subject name</label>
                  <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Enter Subject name" autocomplete="off" value="<?php echo $this->input->post('subject_name') ?>" />
                </div>

                <div class="form-group">
                  <label for="subject_code">Subject Code</label>
                  <input type="text" class="form-control" data-toggle="tooltip" title="Leave this Field Empty if No Subject Code" id="subject_code" name="subject_code" placeholder="Enter Subject Code" autocomplete="off" value="<?php echo $this->input->post('subject_code') ?>"/>
                </div>            
                
                <div class="form-group">
                  <label for="active">Active</label>
                  <select class="form-control" id="active" name="active">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save </button>
                <a href="<?php echo base_url('subject/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
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
    $("#course_id").select2();

    $("#subjectMainNav").addClass('active');
    $("#createSubjectSubMenu").addClass('active');
    
  });
</script>


