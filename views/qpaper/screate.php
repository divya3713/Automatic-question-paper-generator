<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Craete
        <small>Paper</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Paper</li>
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
              <h3 class="box-title">Create Question Paper (Subject wise)</h3>             
            </div>
            <form role="form" action="<?php base_url('qpaper/create') ?>" method="post">
              <div class="box-body">
                <div class="col-md-12 col-xs-12">
                    <div class="text-danger"><?php echo validation_errors(); ?></div>                    
                  <div class="col-md-6 col-xs-6">

                    <div class="form-group">
                      <label for="paper_name">Paper Name</label>
                      <input type="text" class="form-control" id="paper_name" name="paper_name" placeholder="Paper Name" autocomplete="off" required>
                    </div>                 
                    
                    <div class="form-group">
                      <label for="select">Select Course</label>
                      <select class="form-control" id="course_ids" name="course_ids" required>
                        <option value=""> </option>
                        <?php foreach($course_data as $k => $v):  if($v['semester']!=null){$semester = '  - '.$v['semester'];}else {$semester= null;} ?> 
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
                      <label>Time Allowance:</label>
                      <input type='text' class="form-control" id="timechange" name="timegiven" placeholder="Example :-  3 Hour (or) 1:30 Hour" required/>
                    </div>
                               
                    <div class="form-group">
                      <label for="section">Question Have Section?</label>
                      <select class="form-control" id="section" name="section">
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                      </select>
                    </div>         
                    
                  </div> <!-- col 6 complete --> 

                  <div class="col-md-6 col-xs-6">
                    <center><h3>Subject Details</h3></center>
                      <h4>Subject : <b id="subject"></b> - <b id="subject_code"></b><br/>
                          Course  : <b id="course"></b> (<b id="semester"></b>)<br/>                      
                      </h4>
                     <div class="form-group">
                        <label for="active">Status</label>
                        <select class="form-control" id="active" name="active">
                          <option value="1">Active</option>
                          <option value="2">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="wise" class="form-control" value="1"> 
                    </div>

                    <div class="form-group">
                        <label for="Subject Code">Total Given Question</label>
                        <input type="text" name="TNQ" class="form-control" readonly> 
                    </div>
                                       
                    <div class="form-group">
                        <label for="Subject Code">Total Marks</label>
                        <input type="text" name="TM" class="form-control" readonly> 
                    </div>                                          
                  </div> <!--col 6 close-->                                  
                </div>  <!--col 12 close-->   
              <div class="col-md-12 col-xs-12">              
                <table class="table table-bordered" width="100%" style="overflow-x:scroll; display:block;";>
                    <thead>
                      <tr>
                        <th>Unit Name</th>
                        <th colspan="12">Question Bank</th>
                       
                      </tr>
                    </thead>
                    <tbody class="UnitField">
                      
                    </tbody>
                </table>
              </div>    
          
              <div class="col-md-12 col-xs-12">
                <div class="form-group">
                  <label for="description">Question Paper Description</label>
                  <textarea class="form-control" id="description" name="description" value="" placeholder="Enter Question Paper Description">              
                  </textarea>
                </div>
              </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer right">
                <a href="<?php echo base_url('qpaper/') ?>" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div><!-- /.box -->          
        </div><!-- col-md-12 -->       
      </div> <!-- /.row -->    
    </section><!-- /.content -->  
  </div><!-- /.content-wrapper -->

<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    $("#subject_ids").select2();
    $("#course_ids").select2();
    $("#description").wysihtml5();
    $("#qpaperMainNav").addClass('active');
    $("#screateQPaperSubMenu").addClass('active');
  });

function createp()
{ 
  var x = document.getElementById("subject_ids").value;

  if (x == ""){
    alert("Please Select Course or Subject");
    return false;
  }
    else{
location.replace(base_url+'qpaper/create/'+x+'?s_id='+x)
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

$('select[name="subject_ids"]').change(function(){
      if($(this).val()!='')
        {
         $.ajax({
          url   : base_url +'qpaper/fetchQuestionBySubject/',
          method: 'post',
          data  : {s_id:$(this).val()},
          dataType :'json',
          success:function(res){

            $("#subject").html(res.Question[0]['subject_name']);
            $("#course").html(res.Question[0]['course_name']);
            $("#semester").html(res.Question[0]['semester']);
            var sett = JSON.parse(res.TyM);
            var addedvalue='';
            var cat= [];
            for(var i=0 ;i<res.Question.length;i++)
            {
              if(cat.indexOf(res.Question[i]['q_type'])==-1)
              {
                cat.push(res.Question[i]['q_type']);
                if(i==0)
                {
                  addedvalue=addedvalue+"<tr><td><input type='hidden' name='cat[]' value='"+res.Question[i]['q_type']+"'>"+res.Question[i]['type_head']+"</td>";
                }
                else
                { 
                  addedvalue=addedvalue+"<tr><td><input type='hidden' name='cat[]' value='"+res.Question[i]['q_type']+"'>"+res.Question[i]['type_head']+"</td>";
                }
              }
              addedvalue = addedvalue+"<td>"+res.Question[i]['count_type']+"</td><td><input type='hidden' name='"+res.Question[i]['q_type']+"GivenqueNumber[]' value='"+res.Question[i]['q_type']+"'><input type='number' name='"+res.Question[i]['q_type']+"Givenque[]' class='form-control GivenQuestion' id='givenQ' data-obtainno='"+res.Question[i]['mark']+"' data-totalque='"+res.Question[i]['count_type']+"' value='0' onchange='getques(this);'></td>"
            }
            $('.UnitField').html(addedvalue);
        }
       });//end of ajax
    }
});
});


  function getques(a)
  {
    var Givenque  = $(a).val();
    var ObtainNo  = $(a).data("obtainno");
    var TotalQue  =  $(a).data("totalque");
    if(TotalQue < Givenque)
    {
      alert("Given Question can't greater than Total Question");
     return false;
      $(a).focus();

    }
    else
    if(Givenque < 0)
    {
      alert("Given Question can't in Negative");
      return false;
      
      $(a).focus();

    }
    else{
      GetTotalamt();
    }   
    //alert($(a).val());
  }
  function GetTotalamt()
  {
    var totalNumber=0;
    var totalQuestion=0;
    $('.GivenQuestion').each(function(){
      if($(this).val()!=0 ||$(this).val()!='')
      {
         totalQuestion = parseInt(totalQuestion)+parseInt($(this).val());
         totalNumber   = parseInt(totalNumber)+(parseInt($(this).val())*parseInt($(this).data("obtainno")));
      }
    });
         $('input[name="TNQ"]').val(totalQuestion);
         $('input[name="TM"]').val(totalNumber);

  }
</script>