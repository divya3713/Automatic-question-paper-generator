

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit
      <small>Question Paper</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Question Paper</li>
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
            <h3 class="box-title">Edit Question Paper</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
               <div class="col-md-6 col-xs-6">
                <div class="form-group">
                  <label for="paper_name">Paper Name</label>
                  <input type="text" class="form-control" id="subject_name" name="paper_name" placeholder="Enter Subject Name" autocomplete="on" value="<?php echo !empty($this->input->post('paper_name')) ?:$paper_data['paper_name'] ?>" />
                </div>

                <div class="form-group">
                  <label for="subject">Select Subject</label>
                  <?php $paper_data_subject = json_decode($paper_data['subject_id']); ?>
                  <select class="form-control select_group" id="subject_id" name="subject_id" required>
                      <option value="" default></option> 
                    <?php foreach ($subject_data as $k => $v): ?>
                      <option value="<?php echo $v['sid'] ?>" <?php if($paper_data_subject == $v['sid']) { echo 'selected="selected"'; } ?>>
                        <?php echo $v['subject_name'] .' (' .$v['course_name'] .' - '.$v['semester'] .')'?>
                      </option>
                    <?php endforeach ?>  
                  </select>
                </div>

                <div class="form-group">
                  <label for="course">Select Course</label>
                  <?php $paper_data_exam = json_decode($paper_data['exam_id']); ?>
                  <select class="form-control select_group" id="exam_id" name="exam_id" required>
                    <option value="" default></option> 
                    <?php foreach ($exam_data as $k => $v): ?>
                      <option value="<?php echo $v['eid'] ?>" <?php if($paper_data_exam == $v['eid']) { echo 'selected="selected"'; } ?>>
                        <?php echo $v['exam_name'] ?>
                      </option>
                    <?php endforeach ?> 
                  </select>
                </div>
                  <div class="form-group">
                    <div class="col-md-6 col-xs-6"><label>Start Time :</label>
                      <div class='input-group time' id='datetimepicker1'>
                        <input type="text" class="form-control" name="start_time" value="<?php echo !empty($this->input->post('start_time')) ?:$paper_data['start_time'] ?>" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                        </span>
                      </div>
                    </div>

                    <div class="col-md-6 col-xs-6"><label>End Time :</label>
                      <div class='input-group time' id='datetimepicker2'>
                        <input type="text" class="form-control" name="end_time" value="<?php echo !empty($this->input->post('end_time')) ?:$paper_data['end_time'] ?>" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                        </span>
                      </div>
                    </div>
                  </div>  
                </div>
                <!-- col 6 closed --> 

                <div class="col-md-6 col-xs-6">
                  <div class="form-group">
                    <label for="section">Question Have Section?</label>
                    <select class="form-control" id="section" name="section">
                      <option value="1" <?php if($paper_data['section'] == 1) { echo 'selected="selected"'; } ?>>Yes</option>
                      <option value="2" <?php if($paper_data['section'] == 2) { echo 'selected="selected"'; } ?>>No</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="active">Active</label>
                    <select class="form-control" id="active" name="active"> 
                      <option value="1" <?php if($paper_data['active'] == 1) { echo 'selected="selected"'; } ?>>Yes</option>
                      <option value="2" <?php if($paper_data['active'] == 2) { echo 'selected="selected"'; } ?>>No</option>
                    </select>
                  </div>
              </div>

              <div class="col-md-12 col-xs-12">
              <div class="form-group">
                  <label for="description">Question Paper Description</label>
                  <textarea class="form-control" id="description" name="description" value="" placeholder="Enter Question Paper Description"><?php echo !empty($this->input->post('description')) ?:$paper_data['description'] ?>             
                  </textarea>
                </div>
              </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('qpaper/') ?>" class="btn btn-warning">Back</a>
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
    $("#select_subject").select2();
    $("#select_exam").select2();
    $("#description").wysihtml5();
    $("#qpaperMainNav").addClass('active');
    $("#manageQPaperSubMenu").addClass('active');
    $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'LT'
                });
            });
    $(function () {
                $('#datetimepicker2').datetimepicker({
                    format: 'LT'
                });
            });
  });
</script>
