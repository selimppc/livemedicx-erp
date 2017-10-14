<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 9/30/17
 * Time: 10:01 PM
 */

$previous_url = Yii::app()->request->urlReferrer;
$this->breadcrumbs=array(
    'Reports > ',
    'Back to Reports'=> $previous_url,
);


$this->menu=array(
    array('label'=>'<< Back to Report Page', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>$previous_url),
);

?>

<script>
    $(function(){
        $("#to_date").on('change', function()
        {
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();

            if (from_date>to_date )
            {
                alert("Oops! To-Date must be equal or greater to From-Date !!");
                $("#to_date").val("");
            }
        });

        $("#from_date").on('change', function(){
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();

            if (from_date !== "")
            {
                if (from_date>to_date )
                {
                    $("#to_date").val("");
                }
            }

        })
    });
</script>
