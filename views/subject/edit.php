

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
            <h3 class="box-title">Edit Subject</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
               
                <div class="form-group">
                  <label for="subject_name">Subject name</label>
                  <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Enter Subject Name" autocomplete="on" value="<?php echo !empty($this->input->post('subject_name')) ?:$subject_data['subject_name'] ?>" />
                </div>

                <div class="form-group">
                  <label for="subject_code">Subject Code</label>
                  <input type="text" class="form-control" data-toggle="tooltip" title="Leave this Field Empty if No Subject Code" id="subject_code" name="subject_code" placeholder="Enter Subject Code" autocomplete="off" value="<?php echo !empty($this->input->post('subject_code')) ?:$subject_data['subject_code'] ?>"/>
                </div>

                <div class="form-group">
                  <label for="course">Course</label>
                  <?php $course_ids = json_decode($subject_data['course_id']); ?>
                  <select class="form-control select_group" id="course_id" name="course_id">              
                    <?php foreach ($course_data as $k => $v): ?>
                      <option value="<?php echo $v['cid'] ?>" <?php if($course_ids == $v['cid']) { echo 'selected'; } ?> ><?php echo $v['course_name'] .' ' .$v['semester']  ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
             
                <div class="form-group">
                  <label for="active">Active</label>
                  <select class="form-control" id="active" name="active"> 
                    <option value="1" <?php if($subject_data['active'] == 1) { echo 'selected="selected"'; } ?>>
                    Yes</option>
                    <option value="2" <?php if($subject_data['active'] == 2) { echo 'selected="selected"'; } ?>>
                    No</option> 
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
    $(".select_group").select2();

    $("#subjectMainNav").addClass('active');
    $("#manageSubjectSubMenu").addClass('active');
    

  });
</script>