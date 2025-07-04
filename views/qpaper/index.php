

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
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

        <?php if(in_array('createQPaper', $user_permission)): ?>
          <a href="<?php echo base_url('qpaper/screate');?>" class="btn btn-primary">Create Question Paper (Subject wise)</a>       
        <?php endif; ?>
        <?php if(in_array('createQPaper', $user_permission)): ?>
          <a href="<?php echo base_url('qpaper/create');?>" class="btn btn-primary">Create Question Paper (Unit wise)</a>       
        <?php endif; ?>

        <br /> <br />

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Question Paper</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Paper Name</th>
                <th>Subject</th>
                <th>Course</th>              
                <th>Status</th>
                <?php if(in_array('updateQPaper', $user_permission) || in_array('deleteQPaper', $user_permission)): ?>
                <th>Action</th>
                <?php endif; ?>
              </tr>
              </thead>

            </table>
          </div> <!-- /.box-body --> 
          <div class="box-footer right">
            <a class="btn btn-warning" href="<?php echo base_url('dashboard')?>">Back</a>
          </div> <!-- /.box-footer -->                 
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

<?php if(in_array('deleteQPaper', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Question Paper</h4>
      </div>

      <form role="form" action="<?php echo base_url('qpaper/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Remove</button>
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
  $("#qpaperMainNav").addClass('active');
  $("#manageQPaperSubMenu").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'qpaper/fetchQPaperData',
    'order': []
  });

});
 
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

function pcreate()
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
        data: { paper_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

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
