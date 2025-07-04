

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Subject Unit</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Subject</li><li class="active">Subject Unit</li>
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
               
              <h3 class="box-title">Subject Name : <?php if($subject_unit['semester'] != null){ $semester = '  (' .$subject_unit['semester'] .')';} else{ $semester = null ;} echo '<b>' .$subject_unit['subject_name'] .'</b>| Course:- <b>' .$subject_unit['course_name'] .$semester .'</b>'; ?></h3>
              <button class="btn btn-success btn-right" style="float:right;" id="change" data-toggle="modal" data-target="#changeModal">Change Subject</button>
            </div>
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="box-header" align="center">
                  <?php if(in_array('createUnit', $user_permission)): ?>
                    <button class="btn btn-primary" id="addUnit" data-toggle="modal" data-target="#addModal">Add Unit</button>
                  <?php endif; ?>
                <button class="btn btn-info" data-toggle="popover" title="Having Trouble?" data-content="Some content inside the popover">Tip?</button>
                </div> 
                  <table id="manageTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Unit No.</th>
                      <th>Unit Name</th>
                      <th>Status</th>
                      <?php if(in_array('updateUnit', $user_permission) || in_array('deleteUnit', $user_permission)): ?>
                      <th>Action</th>
                      <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php $i=0;
                      foreach ($unit_data as $k => $v):
                       ++$i;
                       $status = ($v['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
                       echo '<td>'.$i .'</td>';   //Serial Number //
                       echo '<td>'.$v['unit_no'] .'</td>'; // Unit number //
                       echo '<td>'.$v['unit_name'] .'</td>'; // Unit Name //
                       echo '<td>'.$status .'</td>'; // Active //
                                        
                        ?>
                        <td>
                          <?php if(in_array('updateQuestion', $user_permission)): ?>
                            <button type="button" class="btn btn-default" onclick="editFunc(<?php echo $v['uid'] ?>)" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit</button>
                          <?php endif; ?>
                         <?php if(in_array('createUnit', $this->permission)): ?>
                          <a href="<?php echo base_url('question/create/').$v['uid'] .'?u_id='.$v['uid'] ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Question</a>
                           <?php endif; ?>
                          <?php if(in_array('deleteQuestion', $user_permission)): ?> 
                            <button type="button" class="btn btn-default" onclick="removeFunc(<?php echo $v['uid'] ?>)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i> Delete</button>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach ?> 
                    </tbody>
                  </table>              
                </div>               

              <div class="box-footer">
                <a href="<?php echo base_url('subject/') ?>" class="btn btn-warning">Back</a>
              </div>
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
 
<!-- create question modal -->
<?php if(in_array('createUnit', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <div id="messages"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
        <h4 class="modal-title">Add Unit</h4>
      </div>

      <form role="form" action="<?php echo base_url('subject/createu/') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group"> 
            <?php echo 'For :  Subject:- '.'<b>' .$subject_unit['subject_name'] .'</b>| Course:- <b>' .$subject_unit['course_name'] .'(' .$subject_unit['semester'] .')</b>'; ?>
            <input type="hidden" class="form-control" name="subject_id" id="subject_id" value="<?php $sid = $_REQUEST['s_id']; echo $sid; ?>" required/> 
          </div> 

          <div class="form-group">
            <label for="unit_no">Unit Number</label>
            <input type="number" name="unit_no" id="unit_no" class="form-control" placeholder="Enter Unit No." autocomplete="off" required/> 
          </div>

          <div class="form-group">
            <label for="unit_name">Unit Name</label>
            <input type="text" name="unit_name" id="unit_name" class="form-control" placeholder="Enter Unit Name" autocomplete="off" required/> 
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control"  id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>

        </div><!-- /.modal-body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<?php if(in_array('updateUnit', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="messages"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Unit</h4>
      </div>
      <div class="modal-body">
      <form role="form" action="<?php echo base_url('subject/updateu/') ?>" method="post" id="updateForm">
          <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="edit_subject_id" id="edit_subject_id" value="<?php $sid = $_REQUEST['s_id']; echo $sid; ?>" required/> 
          </div> 

          <div class="form-group">
            <label for="unit_no">Unit Number</label>
            <input type="number" name="edit_unit_no" id="edit_unit_no" class="form-control" placeholder="Enter Unit No." autocomplete="off" required/> 
          </div>

          <div class="form-group">
            <label for="unit_name">Unit Name</label>
            <input type="text" name="edit_unit_name" id="edit_unit_name" class="form-control" placeholder="Enter Unit Name" autocomplete="off" required/> 
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>

        </div><!-- /.modal-body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>    
      </form>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteUnit', $user_permission)): ?>
<!-- remove question modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="messages"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Unit</h4>
      </div>

      <form role="form" action="<?php echo base_url('subject/removeu') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<?php if(in_array('viewUnit', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="changeModal">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <div id="messages"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Subject</h4>
      </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="select">Subject</label>
            <select class="form-control" id="select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" required>
              <option value="">Select Subject</option>
              <?php foreach ($subject_data as $k => $v): ?>
              <option value="<?php echo base_url('subject/unit/') .$v['sid'] .'?s_id=' .$v['sid'];?>" <?php foreach($unit_data as $ks => $vs){ if($v['sid'] == $vs['subject_id']) { echo 'selected="selected"'; }}?>><?php echo $v['subject_name'] .' (' .$v['course_name'] .'  '.$v['semester'] .')'?></option>
              <?php endforeach ?>
            </select>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  $('#subjectMainNav').addClass('active');
  $('#unitSubjectSubMenu').addClass('active');
  // initialize the datatable 
  $('[data-toggle="popover"]').popover();
  
 $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) { 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');   
          setTimeout(function(){// wait for 1 secs(2)
           location.reload(); 
           // then reload the page.(3)
            }, 1000);      

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });
  // submit the create from 
  $('#manageTable').DataTable();
});
// edit function
function editFunc(id) 
{ 
  $.ajax({
    url: base_url + 'subject/fetchUnitDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_unit_no").val(response.unit_no);
      $("#edit_unit_name").val(response.unit_name);
      $("#edit_active").val(response.active);
      $("#edit_subject_id").val(response.subject_id);

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') +id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');
              setTimeout(function()
                  {// wait for 1 secs(2)
                  location.reload(); 
                 // then reload the page.(3)
                  }, 1000);  

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 
        return false;
      });

    }
  });
}

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { unit_id:id }, 
        dataType: 'json',
        success:function(response) {

          
          // hide the modal
            $("#removeModal").modal('hide');

          if(response.success === true) {
           
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');
            setTimeout(function(){// wait for 1 secs(2)
             location.reload(); 
             // then reload the page.(3)
              }, 1000);         
            }
           else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
          
        }
      }); 

      return false;
    });
  }
}

</script>