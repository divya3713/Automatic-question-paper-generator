  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Unit</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Unit</li>
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
                <b class="text-uppercase">Select</b> Course and Subject
              </h3>       
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if(in_array('viewUnit', $user_permission)): ?>
              <div class="form-group">
                  <label for="select">Select Course</label>
                  <select class="form-control" id="course_ids" name="course_ids" required>
                    <option value=""> </option>
                   <?php foreach($course_data as $k => $v): if($v['semester']!=null){$semester = '  - '.$v['semester'];}else {$semester= null;}?> 
                    <option value="<?php echo $v['cid']?>"><?php echo $v['course_name'] .$semester ?></option>
                  <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="select">Select Subject</label>
                  <select class="form-control" id="subject_ids" name="subject_ids" required>
                    
                  </select>
                </div>

                <div class="form-group">
                  <a class="btn btn-warning" href="<?php echo base_url('dashboard')?>">Back</a>
                  <button type="button" onclick="unit()" class="btn btn-primary">Submit</button>
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
      $("#subject_ids").select2();
      $("#course_ids").select2();
      $("#subjectMainNav").addClass('active');
      $("#addUnitSubMenu").addClass('active');
    });

function unit()
{ 
  var x = document.getElementById("subject_ids").value;

  if (x == ""){
    alert("Please Select Course or Subject");
    return false;
  }
    else{
location.replace(base_url+'subject/unit/'+x+'?s_id='+x)
}
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

});
  </script>

