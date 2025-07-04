<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add
        <small>Question</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Question</li><li class="active">Add Question</li>
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
              <?php
                    $subject = $question_details['subject_name'];
                    if ($question_details['semester'] != null){
                      $semester = ' - ' .$question_details['semester'];
                    }
                    else{
                      $semester = null;
                    }
                    $unit = $question_details['unit_no'] .'. '.$question_details['unit_name'];
                    $course = $question_details['course_name'] .$semester;
              ?>
              <br/>
              
              <br/>
              <h3 class="box-title"><?php echo 'Subject :<b>'.$subject .'</b> |Unit :<b>' .$unit .'</b>  |Course :<b>'.$course .'</b>'; ?></h3>
              <button class="btn btn-success btn-right" style="float:right;" id="preview" data-toggle="modal" data-target="#preModal">Change Subject</button>
            </div>
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="box-header" align="center">
                  <?php if(in_array('createQuestion', $user_permission)): ?>
                    <button class="btn btn-primary" id="addQuestion" data-toggle="modal" data-target="#addModal">Add Question</button>
                  <?php endif; ?>
                </div> 
                  <table id="manageTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Question Type</th>
                      <th>Question</th>
                      <?php if(in_array('updateQuestion', $user_permission) || in_array('deleteQuestion', $user_permission)): ?>
                      <th>Action</th>
                      <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php $i=0;

                      foreach ($question_data as $k => $v):
                       ++$i;
                       echo '<td>'.$i .'</td>';   //Serial Number //
                       echo '<td>'.$v['type_name'] .'</td>'; // Question Type //
                       echo '<td>';

                       if($v['q_type'] =="1" || $v['q_type'] =="4")
                       {

                        $q = $v['question'];
                        $o = str_replace("[","<li>",$q);
                        $question = str_replace("]","</li>",$o);
                          echo  '<ul>'.$question .'</ul></td>';  
                       }
                      
                       else{
                          $question = $v['question'] ;
                          echo $question .'</td>';
                      }
                        ?>
                        <td>
                          <?php if(in_array('updateQuestion', $user_permission)): ?>
                            <button type="button" class="btn btn-default" onclick="editFunc(<?php echo $v['qid'] ?>)" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit</button>
                          <?php endif; ?>
                          <?php if(in_array('deleteQuestion', $user_permission)): ?> 
                            <button type="button" class="btn btn-default" onclick="removeFunc(<?php echo $v['qid'] ?>)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i> Delete</button>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach ?> 
                    </tbody>
                  </table>              
                </div>               

              <div class="box-footer">
                <a href="<?php echo base_url('question/qcreate') ?>" class="btn btn-warning">Back</a>
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
<?php if(in_array('createQuestion', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-8" role="dialog" id="addModal">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Question</h4>
      </div>

      <form role="form" action="<?php $uid=$_REQUEST['u_id']; echo base_url('question/createquestion') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
             
            <label for="semester">Select Question Type</label>              
            <select class="form-control" id="q_type" name="q_type" onchange="selectFunc()" autocomplete="off" required>
              <option selected value=""></option>
              <?php foreach($qtype as $k => $v):?>
              <option value="<?php echo $v['type']?>"><?php echo $v['type_head']?></option>
            <?php endforeach; ?>
            </select>          
          </div>
          <div class="form-group">
            <label for="question">Question </label>
            <div id="q">      </div>  
          </div> 

          <div class="form-group">
            <label for="question">Subject</label> 
            <input class="form-control" type="hidden" id="subject_id" name="subject_id" value="<?php echo $unit_data['subject_id']; ?>"/>
            <input class="form-control" type="text" value="<?php echo $unit_data['subject_name']; ?>" readonly/>          
          </div> 
 
          <div class="form-group"> 
            <label for="question">Unit</label>
            <input class="form-control" type="hidden" id="unit_id" name="unit_id" value="<?php echo $unit_data['uid'] ?>"/> 
            <input class="form-control" type="text" value="<?php echo $unit_data['unit_name']; ?>" readonly/>          
          </div>

          <div class="form-group">
            <label for="active">Active</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Yes</option>
              <option value="2">No</option>
            </select>
          </div>
        </div>

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


<?php if(in_array('updateQuestion', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Question</h4>
      </div>
      <div class="modal-body">
        <a href='#' id='tips' style='margin-right:5mm; content-display:block' class='btn btn-info' data-toggle='popover' title='Example of MCQ Question' data-content='Question[Op1][Op2][Op3][Op4]'></a>
        <a href='#' id='tips' style='margin-right:5mm; content-display:block' class='btn btn-info' data-toggle='popover' title='Example of Match the Sentence Question' data-content='Question[AnyOption]'>Tip for M-S?</a>
        <a href='#' id='tips' style='margin-right:5mm; content-display:block' class='btn btn-info' data-toggle='popover' title='Example of True/False Question' data-content='Question..'>Tip for T/F?</a>
        <a href='#' id='tips' style='margin-right:5mm; content-display:block' class='btn btn-info' data-toggle='popover' title='Example of Other Question' data-content='Question..'>Tip for Other Question?</a><br/>
      <form role="form" action="<?php echo base_url('question/update/') ?>" method="post" id="updateForm">
          <div class="form-group">
            <label for="semester">Select Question Type</label>
            <select class="form-control" id="edit_q_type" name="edit_q_type" autocomplete="off" required>
              <option value=""></option>
              <?php foreach($qtype as $k => $v):?>
              <option value="<?php echo $v['type']?>"><?php echo $v['type_head']?></option>
            <?php endforeach; ?>
            </select>          
          </div>
          <div class="form-group">
            <label for="question">Question</label>
              <input type="text" id="edit_question" name="edit_question" class="form-control" placeholder="Question (No listing)" required/>
          </div>  
          <div class="form-group">
            <label for="question">Unit</label>
            <input class="form-control" type="hidden" id="edit_unit_id" name="edit_unit_id" value="<?php echo $unit_data['uid'] ?>"/> <input class="form-control" type="text" value="<?php echo $question_details['unit_name']; ?>" readonly/>          
          </div>

          <div class="form-group"> 
            <label for="question">Subject</label>
            <input class="form-control" type="hidden" id="edit_subject_id" name="edit_subject_id" value="<?php echo $question_details['subject_id']; ?>"/>
            <input class="form-control" type="text" value="<?php echo $question_details['subject_name']; ?>" readonly/>           
          </div>

          <div class="form-group">
            <label for="active">Active</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Yes</option>
              <option value="2">No</option>
            </select>
          </div>

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

<?php if(in_array('deleteQuestion', $user_permission)): ?>
<!-- remove question modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Question</h4>
      </div>

      <form role="form" action="<?php echo base_url('question/remove') ?>" method="post" id="removeForm">
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


<?php if(in_array('createQuestion', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="preModal">
  <div class="modal-dialog modal-xl" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Course, Subject & Unit</h4>
      </div>
        <div class="modal-body">
           <?php if(in_array('createQuestion', $user_permission)): ?>
              <!-- create brand modal -->
                <div class="form-group">
                  <label for="select">Select Course</label>
                  <select class="form-control" id="course_ids" name="course_ids" required>
                    <option value=""> </option>
                   <?php foreach($course_data as $k => $v): ?> 
                    <option value="<?php echo $v['cid']?>"><?php echo $v['course_name'] .' - ' .$v['semester']?></option>
                  <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="select">Select Subject</label>
                  <select class="form-control" id="subject_ids" name="subject_ids" required>
                    
                  </select>
                </div>

                 <div class="form-group">
                  <label for="select">Select Unit</label>
                  <select class="form-control" id="unit_ids" name="unit_ids" required>
                  </select>
                </div>
              <?php endif; ?>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="qcreate()" class="btn btn-primary">Submit</button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

function selectFunc() {  

   var x = document.getElementById("q_type").value;
    if(x == '8'){ 
      document.getElementById("q").innerHTML = "<table id='q_table' width='100%'><tr><td><textarea id='lquestion' name='question[]' class='form-control question' placeholder='Question (No listing)' required/></textarea></td><td><button type='button' name='addGC' class='btn btn-success btn-sm addGC'><span class='glyphicon glyphicon-plus'></span>  Add more</button></td></tr> </table>";
      $("#lquestion").wysihtml5();
  }
  else{ 
      document.getElementById("q").innerHTML = "<table id='q_table' width='100%'><tr><td><input type='text' name='question[]' class='form-control question' placeholder='Question (No listing)' required/></td><td><button type='button' name='addQ' class='btn btn-success btn-sm addQ'><span class='glyphicon glyphicon-plus'></span>  Add more</button></td></tr> </table>";
 }
}


$(document).ready(function() {
  $('#questionMainNav').addClass('active');
  $('#createQuestionSubMenu').addClass('active');
  $('#manageTable').DataTable();
  $('[data-toggle="popover"]').popover();

  // initialize the datatable 

  $(document).on('click', '.addQ', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input type="text" name="question[]" class="form-control question" placeholder="Question (No listing)" required/></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span> Remove</button></td></tr>';
  $('#q_table').append(html);
 });
 
 $(document).on('click', '.addGC', function(){
  var html = '';
  html += '<tr>';
  html += '<td><textarea name="question[]" id="lquestion" class="form-control question" placeholder="Question (No listing)" required/></textarea></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span> Remove</button></td></tr>';
  $('#q_table').append(html);
  $("#lquestion").wysihtml5();
 });

 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });

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
  
});
// edit function
function editFunc(id) 
{ 
  $.ajax({
    url: base_url + 'question/fetchQuestionDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_q_type").val(response.q_type);
      $("#edit_question").val(response.question);
      $("#edit_unit_id").val(response.unit_id);
      $("#edit_subject_id").val(response.subject_id);
      $("#edit_active").val(response.active);

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
        data: { q_id:id }, 
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

function qcreate()
{ 
var x = document.getElementById("unit_ids").value;
if(x=="")
{
  alert("Please Select Subject or Unit from the list");
  return false;
}

location.replace(base_url+'question/create/'+x+'?u_id='+x)
}

$(function(){
$('select[name="course_ids"]').change(function(){
  var x = document.getElementById("course_ids").value;
      if($(x).val()!='')
      {
         $.ajax({
          url   : '<?= site_url('question/fetchCourseDataById/') ?>' + x,
          method: 'post',
          data  : {cid:$(this).val()},
          dataType :'json',
          success:function(res){
           //  alert(res['sub_name']);
           var optionValue="<option value=''>Select Subject </option>";

            if(res!='')
            {
              for(var i=0; i < res.length; i++)
              {
               optionValue=optionValue+"<option value='"+res[i]['sid']+"'>"+res[i]['subject_name'] +"</option>" ;
              }
            }
            else
            {
              alert("Any Subject is not defined");
            }
            $('select[name="subject_ids"]').html(optionValue);
          }
       });
       
      }
    });//endof subject change function

$('select[name="subject_ids"]').change(function(){
  var y = document.getElementById("subject_ids").value;
      if($(y).val()!='')
      {
         $.ajax({
          url   : '<?= site_url('subject/fetchUnitData/') ?>' + y,
          method: 'post',
          data  : {sid:$(this).val()},
          dataType :'json',
          success:function(res){
           //  alert(res['sub_name']);
           var optionValue="<option value=''>Select Unit </option>";

            if(res!='')
            {
              for(var i=0; i < res.length; i++)
              {
               optionValue=optionValue+"<option value='"+res[i]['uid']+"'>"+res[i]['unit_no']+". "+res[i]['unit_name'] +"</option>" ;
              }
            }
            else
            {
              alert("Any Subject Unit is not defined");
            }
            $('select[name="unit_ids"]').html(optionValue);
          }
       });
       
      }
    });//endof subject change function
});
</script>