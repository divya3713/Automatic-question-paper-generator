<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'setAutoTopMargin' => 'pad',
    'default_font' => 'times'
]);

ob_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="<?= base_url("assets/browser_components/bootstrap/css/bootstrap.min.css")?>">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }
        .unit
  {
    text-align: center;
  }
  .contentExam span
  {
    font-weight: bold;
  }
  .mcq ol {
    list-style-type: lower-alpha;
    margin-left: 20px;
    padding-left: 0;
  }
  .mcq ol li {
    float: left;
    margin-left: 10mm;
  }
  .pull-left {
    float: left;
  }
  .pull-right {
    float: right;
  }
  .align_center {
    text-align: left;
  }
  .width_33 {
    width: 33%;
  }
  .cleaner {
    clear: right;
  }
  .full {
    display: block;
    width: 100%;
  }
  .stats li >div {
    display: inline-block;
  }
    </style>
</head>
<body>

<div class="contentExam" style="text-align: center;">
    
  <table cellspacing="0" cellpadding="5" width="100%" style="margin-bottom: 20px; font-size: 16px; border-collapse: collapse; border: 0.5px solid #ccc;">

    <tr>
        <td style="border: 0.5px solid #ccc;"><strong>U.G.</strong></td>
        <td style="border: 0.5px solid #ccc;">B.Tech-<?php echo $paperInfo['course_name'] ;?></td>
        <td style="border: 0.5px solid #ccc;"><strong>Degree</strong></td>
        <td style="border: 0.5px solid #ccc;">Bachelor of Technology</td>
    </tr>
    <tr>
        <td style="border: 0.5px solid #ccc;"><strong>Academic Year</strong></td>
        <td style="border: 0.5px solid #ccc;">2023-24</td>
        <td style="border: 0.5px solid #ccc;"><strong>Sem</strong></td>
        <td style="border: 0.5px solid #ccc;"><?php echo $paperInfo['semester'];?></td>
    </tr>
    <!-- <tr>
        <td><strong>Test</strong></td>
        <td>I</td>
        <td><strong>Date of Exam</strong></td>
        <td>15-03-2024</td>
    </tr> -->
    <tr>
        <td style="border: 0.5px solid #ccc;"><strong>Course Code</strong></td>
        <td style="border: 0.5px solid #ccc;"><?php if ($paperInfo['subject_code'] != null): ?>
        <p>
          <?php echo $paperInfo['subject_code']; ?>
        </p>
        <?php endif; ?></td>
        <td style="border: 0.5px solid #ccc;"><strong>Course Title</strong></td>
        <td style="border: 0.5px solid #ccc;"><?php echo$paperInfo['subject_name']; ?></td>
    </tr>
    <tr>
        <td style="border: 0.5px solid #ccc;"><strong>Duration</strong></td>
        <td style="border: 0.5px solid #ccc;"><?php echo $paperDetail['time'];?></td>
        <td style="border: 0.5px solid #ccc;"><strong>Maximum Marks</strong></td>
        <td style="border: 0.5px solid #ccc;"><?php echo $paperDetail['total_m'];?></td>
    </tr>
    <tr>
        <td style="border: 0.5px solid #ccc;"><strong>Remember (%)</strong></td>
        <td style="border: 0.5px solid #ccc;">20</td>
        <td style="border: 0.5px solid #ccc;"><strong>Understand (%)</strong></td>
        <td style="border: 0.5px solid #ccc;">40</td>
    </tr>
    <tr>
        <td style="border: 0.5px solid #ccc;"><strong>Apply (%)</strong></td>
        <td style="border: 0.5px solid #ccc;">40</td>
        <td style="border: 0.5px solid #ccc;"><strong>Analyze (%)</strong></td>
        <td style="border: 0.5px solid #ccc;">--</td>
    </tr>
</table>

<div class="questionDescription">
  <hr>
    <?= $paperDetail['description']; ?>
  <hr>
</div>
<div class="questionSection">
  <div class="row">

    <?php 

     if(is_array($groupQuestion))
     {
      $sec=0;
      $k=0;
      for ($i=0; $i < count($groupQuestion); $i++) 
      { $sec++;
          error_reporting(0);
          ini_set('display_errors', 0);
          $typeh = $groupQuestion[$i][0]['q_type'];
           if( $typeh == 1)
           { 
            if($paperDetail['section'] == 1){     
              echo '<h3 style="text-align: center;"><b>Section  ' .$sec .'</b></h3>';
            }
            echo '<p style="text-align: left;"><b>Q) ' .$mcq['type_head'] .'    <i>(' .$mcq['mark'] .'mark each' .')</i></b></p>';

            error_reporting(0);
            ini_set('display_errors', 0);
           }
          else if( $typeh == 2)
           { 
            echo '<p style="text-align: left;"><b>Q) ' .$tf['type_head'] .'    <i>(' .$tf['mark'] .'mark each' .')</i></b></p>';

            error_reporting(0);
            ini_set('display_errors', 0);
           }
          else if( $typeh == 3)
           { 
            echo '<p style="text-align: left;"><b>Q) ' .$fib['type_head'] .'    <i>(' .$fib['mark'] .'mark each' .')</i></b></p>';

            error_reporting(0);
            ini_set('display_errors', 0);
           }
          else if( $typeh == 4)
           {
            echo '<p style="text-align: left;"><b>Q) ' .$ms['type_head'] .'    <i>(' .$ms['mark'] .'mark each' .')</i></b></p>';

            error_reporting(0);
            ini_set('display_errors', 0);
           }
         else if( $typeh == 5)
           {
            if($paperDetail['section'] == 1){
              echo '<hr><h3 style="text-align: center;"><b>Section  ' .$sec .'</b></h3>';
            }
            echo '<p style="text-align: left;"><b>Q) ' .$stq['type_head'] .'    <i>(' .$stq['mark'] .'mark each' .')</i></b></p>';

            error_reporting(0);
            ini_set('display_errors', 0);
           }
          else if( $typeh == 6)
           {
            echo '<p style="text-align: left;"><b>Q) ' .$ltq['type_head'] .'    <i>(' .$ltq['mark'] .'mark each' .')</i></b></p>';

            error_reporting(0);
            ini_set('display_errors', 0);
           }
          elseif( $typeh == 7)
           {
            if($paperDetail['section'] == 1){
              echo '<hr><h3 style="text-align: center;"><b>Section  ' .$sec .'</b></h3>';
            }
            echo '<p style="text-align: left;"><b>Q) ' .$dtq['type_head'] .'    <i>(' .$dtq['mark'] .'mark each' .')</i></b></p>';

            error_reporting(0);
            ini_set('display_errors', 0);
           }
           elseif( $typeh == 8)
           {
            if($paperDetail['section'] == 1){
              echo '<hr><h3 style="text-align: center;"><b>Section  ' .$sec .'</b></h3>';
            }
            echo '<p style="text-align: left;"><b>Q) ' .$gtq['type_head'] .'    <i>(' .$gtq['mark'] .'mark each' .')</i></b></p>';

            error_reporting(0);
            ini_set('display_errors', 0);
           }
           else
           {
            echo ' ';

            error_reporting(0);
            ini_set('display_errors', 0);
           }

           $mch = 0;
              //Open new model for this question head w
          for($j=0; $j<count($groupQuestion[$i]); $j++)
            {
              ++$mch;
              ++$k;
              
              
              $type = $groupQuestion[$i][0]['q_type'];
              $ques = $groupQuestion[$i][$j]['question'];
              $m = $groupQuestion[$i][$j]['mark'];

              if($type == 1){
                $r = str_replace("[","<li class='pull-left align_center width_33'>",$ques);
                $q = str_replace("]","</li>",$r);

                echo '<div class="col-xs-11 mcq"> <ol>'.$k .'. '.$q .'</ol></div>' .'<div class="col-xs-1" style="text-align:right;">'.$m .'</div>';             
              }

              else if($type == 4){
                
                $rmatch = str_replace("[","<div class='pull-right align_center width_33'> $mch ",$ques);
                $match = str_replace("]","</div>",$rmatch);

                echo '<div class="col-xs-11">' .$k .'. ' .$match .'</div>' .'<div class="col-xs-1" style="text-align:right;">'.$m .'</div>';
                
              }

              elseif ($type == 2) 
              {
                
                echo '<div class="col-xs-11">' .$k .'. ' .$ques .'</div>' .'<div class="col-xs-1" style="text-align:right;">(True / False)  '.$m .'</div>';
              }

              else
              {
                
                echo '<div class="col-xs-11">' .$k .'. ' .$ques .'</div>' .'<div class="col-xs-1" style="text-align:right;">'.$m .'</div>';
              }

         
          }
        }
      }
  ?>
  </div>
</div>
</body>
</html>

<?php
$html = ob_get_clean();

// Optional debug save (to preview HTML if needed)
// file_put_contents('debug.html', $html);

$mpdf->WriteHTML($html);
$mpdf->setFooter('{PAGENO} / {nb}');
$mpdf->SetTitle("Question Paper");
$mpdf->Output('QuestionPaper.pdf', 'I');
exit;
?>
