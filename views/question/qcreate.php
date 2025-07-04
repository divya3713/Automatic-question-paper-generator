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
        <li class="active">Question</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

          <div class="box">
            <div class="box-header">            
              <h3 class="box-title">
                <b class="text-uppercase">Select</b> Course, Subject & Unit
              </h3>       
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if(in_array('viewQuestion', $user_permission)): ?>
              <!-- create brand modal -->
                <div class="form-group">
                  <label for="select">Select Course</label>
                  <select class="form-control" id="course_id" name="course_id" required>
                    <option value=""> </option>
                   <?php foreach($course_data as $k => $v): if($v['semester']!=null){$semester = '  - '.$v['semester'];}else {$semester= null;}?> 
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
                  <label for="select">Select Unit</label>
                  <select class="form-control" id="unit_id" name="unit_id" required>
                  </select>
                </div>
                <div class="form-group">
                  <a class="btn btn-warning" href="<?php echo base_url('dashboard')?>">Back</a>
                  <button type="button" onclick="qcreate()" class="btn btn-primary">Submit</button>
                </div>
              <?php endif; ?>
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

<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
    $(document).ready(function() {
      $("#course_id").select2();
      $("#subject_id").select2();
      $("#unit_id").select2();
      $("#questionMainNav").addClass('active');
      $("#createQuestionSubMenu").addClass('active');
    });

function qcreate()
{ 
var x = document.getElementById("unit_id").value;
if(x=="")
{
  alert("Please Select Unit from the list");
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
</script>

