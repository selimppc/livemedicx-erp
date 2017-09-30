              <?php
              //error_reporting(0);
              function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

$absolute_url = full_url( $_SERVER );

            function first_sentence($absolute_url){
              $pos = strpos($absolute_url, '=');
              if($pos === false){
                return $absolute_url;
              }else{
                return substr($absolute_url, 0, $pos+1);
              }
            }
            $count = substr_count($absolute_url,'=');
            $name_array = explode('=', $absolute_url);
            $name_arry = array_filter($name_array);
            $countt = $count;
              print'<input type="hidden" name="name" value="'.first_sentence($absolute_url).'">';
              for($i=1;$i<=$count;$i++){
                $name =  next($name_arry);
                print'<input type="hidden" name="name'.$i.'" value="'.$name.'">';
                $s   = $name;
                mysql_query("INSERT INTO temp VALUES('','$s','$i')");
                }
             
              $query = mysql_query("SELECT * FROM `temp` WHERE flag = 1");
                $row1 = mysql_fetch_array($query);
                $first_value =  $row1['sentence'];
                //echo $first_value;
                $arr = explode('&',trim($first_value));
                $f_word =  $arr[0];
                $query2 = mysql_query("SELECT * FROM `temp` WHERE flag = 4");
                $row2 = mysql_fetch_array($query2);
                $second_word = $row2['sentence'];
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
                //echo $f_word.'<br>';
                //echo $from_date.'<br>';
                //echo $to_date.'<br>';
                //echo $second_word;
               //apel
              $sql = mysql_query("SELECT * FROM `pp_purchaseordhd` WHERE pp_store='$f_word' AND cm_supplierid='$second_word' AND pp_deliverydate BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
              $ru = mysql_num_rows($sql);
              $cq = mysql_query("SELECT * FROM `companyprofile`");
              $rr = mysql_fetch_array($cq);
              $photo = $rr['photo'];
              ?>