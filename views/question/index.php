

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Question</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Question</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12"> 

          <div id="messages"></div>
          
          <?php if(in_array('createQuestion', $user_permission)): ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Question</button>
            <br /> <br />
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              
              <?php echo 'Total MCQ: <b>' .$total_mcq .'</b> '?>
              <?php echo '|Total T/F: <b>' .$total_tf .'</b> '?>
              <?php echo '|Total Fill Blank: <b>' .$total_fil .'</b> '?>
              <?php echo '|Total Match Sentence: <b>' .$total_ms .'</b> '?>
              <?php echo '|Total SATQ: <b>' .$total_saq .'</b> '?>
              <?php echo '|Total LATQ: <b>' .$total_latq .'</b> '?>
              <?php echo '|Total DATQ: <b>' .$total_datq .'</b> '?>
              <?php echo '|Total GTQ: <b>' .$total_gtq .'</b> '?>
              <?php echo '<h3>|Total All Question: <b>' .$total_all .'</b></h3>'?>
              <br/><center><h3 class="box-title">Manage Question</h3></center>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="manageTable" class="table table-bordered table-striped" width="100%" style="overflow-x:scroll; display:block;">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Q-Type</th>
                  <th>Question</th>
                  <th>Unit</th>
                  <th>Subject</th>
                  <th>Course</th>
                  <th>Status</th>
                  <?php if(in_array('updateQuestion', $user_permission) || in_array('deleteQuestion', $user_permission)): ?>
                  <th>Action</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
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

<?php if(in_array('createQuestion', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Course, Sebject and Unit to add Question</h4>
      </div>
        <div class="modal-body">
          <form>
          <div class="form-group">
           <label for="select">Select Course</label>
            <select class="form-control" id="course_id" name="course_id" required>
              <option value=""> </option>
              <?php foreach($course_data as $k => $v):  if($v['semester']!=null){$semester = '  - '.$v['semester'];}else {$semester= null;} ?> 
              <option value="<?php echo $v['cid']?>"><?php echo $v['course_name'] .$semester ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="select">Select Subject</label>
            <select class="form-control" id="subject_id" name="subject_id" required>
                    
            </select>
          </div>

          <div class="form-group">
            <label for="">Select Unit</label>
            <select class="form-control" id="unit_id" name="unit_id" required>
            </select>
          </div>
        </div>
      </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="create()" class="btn btn-primary">Submit </button>
        </div>
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
            <input class="form-control" type="hidden" id="edit_unit_id" name="edit_unit_id" value=""/>           
          </div>

          <div class="form-group"> 
            <input class="form-control" type="hidden" id="edit_subject_id" name="edit_subject_id" value=""/>           
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
<!-- remove brand modal -->
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
          <button type="submit" class="btn btn-danger">Remove</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";


$(document).ready(function() {
  
  $('#questionMainNav').addClass('active');
  $('#manageQuestionSubMenu').addClass('active');
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'question/fetchQuestionData',
    'order': []
  });

  // submit the create from 

});

function create()
{ 
var x = document.getElementById("unit_id").value;
if(x=="")
{
  alert("Please Select Subject or Unit from the list");
  return false;
}

location.replace(base_url+'question/create/'+x+'?u_id='+x)
}

$(function(){
$('select[name="course_id"]').change(function(){
  var x = document.getElementById("course_id").value;
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
            $('select[name="subject_id"]').html(optionValue);
          }
       });
       
      }
    });//endof subject change function

$('select[name="subject_id"]').change(function(){
  var y = document.getElementById("subject_id").value;
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
            $('select[name="unit_id"]').html(optionValue);
          }
       });
       
      }
    });//endof subject change function
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

          manageTable.ajax.reload(null, false); 
          // hide the modal
            $("#removeModal").modal('hide');

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            

          } else {

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