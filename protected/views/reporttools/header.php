<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 9/30/17
 * Time: 10:01 PM
 */

$this->breadcrumbs=array(
    'Reports All'=>array('/reportpages'),
    'Reporting Tools'=>array('/reportpages'),
);

$this->menu=array(
    array('label'=>'All Report', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('/reportpages')),
);

?>