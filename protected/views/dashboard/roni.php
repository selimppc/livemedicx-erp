<?php  
 $connect = mysqli_connect("localhost", "root", "", "ur");  
 $query = "SELECT 	sm_storeid, count(*) as report FROM sm_header GROUP BY 	sm_storeid";  
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
                          ['sm_storeid', 'report'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["sm_storeid"]."', ".$row["report"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Sales Branch Status Reports',  
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