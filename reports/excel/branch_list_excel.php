<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$sql = '';
if($f_word == true){
                  $sql = mysql_query("SELECT * FROM `cm_branchmaster` WHERE cm_branch='$f_word'") or die(mysql_error());
                }else{
                  $sql = mysql_query("SELECT * FROM `cm_branchmaster`") or die(mysql_error());
                }

                  $output = ''; 
                  if(isset($_POST["export_excel"])) 
 {  
      
      if(mysql_num_rows($sql) > 0)  
      {  
           $output .= '  
                <table class="table">  
                     <tr>  
                          <th colspan="5" align="center"><h2>Branch List Report</h2></th>
                          <th align="left">Date: '.$from_date.' To '.$to_date.'</th>       
                     </tr> 
                     <tr>
                      <th style="border:1px solid #000; text-align:center">Branch</th>
                      <th style="border:1px solid #000; text-align:center">Branch Description</th>
                      <th style="border:1px solid #000; text-align:center">Contact Person</th>
                      <th style="border:1px solid #000; text-align:center">Email</th>
                      <th style="border:1px solid #000; text-align:center">Cell Phone</th>
                      <th style="border:1px solid #000; text-align:center">Phone</th>
                    </tr> 
                    
           ';  

           while($row = mysql_fetch_array($sql))  
           {  
                $output .= ' 
                     <tr>
                      <td style="border:1px solid #000; text-align:center">'.$row['cm_branch'].'</td>
                      <td style="border:1px solid #000; text-align:center">'.$row['cm_description'].'</td>
                      <td style="border:1px solid #000; text-align:center">'.$row['cm_contacperson'].'</td>
                      <td style="border:1px solid #000; text-align:center">'.$row['cm_mailingaddress'].'</td>
                      <td style="border:1px solid #000; text-align:center">'.$row['cm_cell'].'</td>
                      <td style="border:1px solid #000; text-align:center">'.$row['cm_phone'].'</td>
                    </tr>  
                ';  
           }  
           $output .= '</table>';  
           header("Content-Type: application/xls");   
           header("Content-Disposition: attachment; filename=download.xls");  
           echo $output;  
      }  
 }  
                  ?>