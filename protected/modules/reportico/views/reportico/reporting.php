<?php
$this->breadcrumbs=array(
	'iTabps Reporting'=>array('mode/reportings'),
);

$this->menu=array(
	array('label'=>'Report Generate', 'url'=>array('reportico/mode/reportings')),

);
?>

<h1 style="padding-left: 30px;">iTabps Reporting</h1>
<br>
<?php
        $this->engine->execute();
?>


