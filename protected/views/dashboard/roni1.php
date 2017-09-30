<?php  
 $connect = mysqli_connect("localhost", "root", "", "ur");  
 $query = "SELECT 	cm_code, count(*) as report FROM sm_detail GROUP BY cm_code";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>iTabps.co</title>  
           <script type="text/javascript" src="loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['cm_code', 'report'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["cm_code"]."', ".$row["report"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Sales Status Reports',  
                      is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }
           </script>
           	   

		   
      </head>  
      <body>  
           <br /><br />  
           <div style="width:400px;">  
               	<h1 align="center">This Business Dashboard</h1>
				<!-- <h3 align="center">https://developers.google.com/chart/interactive/docs/gallery</h3> -->
                <br />  
                <div id="piechart" style="width: 400px; height: 500px;"></div> 
                               
           </div>  
           
            
      </body>  
 </html>  