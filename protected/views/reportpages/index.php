<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 9/30/17
 * Time: 8:57 PM
 */
$this->breadcrumbs=array(
    'Reports'=>array('/reportpages'),
    'Reporting Tools'=>array('/reportpages'),
);

$this->menu=array(
    array('label'=>'All Report', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('/reportpages')),
);

?>
<style type="text/css">
    .report_main_div{
        width: 96%;
        float: left;
        color: orange;
        margin-left: 30px;
    }
    .report_button{
        width: 60%;
        float: left;
    }

    .report_button a {
        text-decoration: none;
        color: white;
        width: 99%;
        float: left;
        text-align: center;
        margin-top: 10px;
        padding: 10px 30px;
        background: #4085BB;
        border-radius: 5px;
        font-size: 14px;
        box-shadow: 10px 3px 5px #aaa;
    }
    .report_button a:hover {
        background: #2F6088;
    }

</style>

<!--   Left Side of the Page -->
<div style="float: left; width: 30%; margin-right: 4%;">
    <div id="flag_desc" style="width: 97%; float: left; margin-right: 3%">
        <div id="flag_desc_text"> Master Setup Reports </div>

        <div>

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Product List Report',array('reporttools/productList')); ?>
                </div>
            </div>

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Customer Ledger Report',array('reporttools/customerLedger')); ?>
                </div>
            </div>
            <p>&nbsp;</p>

        </div>

    </div>

    <div id="flag_desc" style="width: 100%; float: left;">
        <div id="flag_desc_text"> Purchase Order Reports </div>
        <div class="report_main_div">
            <div class="report_button">
                <?php echo CHtml::link('Purchase Order Report',array('reporttools/purchaseOrdRepo')); ?>
            </div>

        </div>
    </div>
    <div id="flag_desc" style="width: 100%; float: left;">
        <div id="flag_desc_text"> Accounts Payable Reports </div>
        <div class="report_main_div">
            <div class="report_button">
                <?php echo CHtml::link('Supplier Ledger',array('reporttools/SupllierLedger')); ?>
            </div>
        </div>
    </div>

    <div id="flag_desc" style="width: 100%; float: left;">
        <div id="flag_desc_text"> Sales Reports </div>

        <div class="report_main_div">
            <div class="report_button">
                <?php echo CHtml::link('Customer Ledger Report',array('reporttools/customerLedgerSales')); ?>
            </div>
        </div>
    </div>

</div>


<!--   Right Side of the Page -->
<div style="float: left; width: 65%">
    <div id="flag_desc" style="width: 97%; float: left;">
        <div id="flag_desc_text"> GL Reporting Tools </div>


        <div style="width: 50%; float: left; margin-right: 2%;">

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Consolidated Trial Balance',array('reporttools/TrialBlance')); ?>
                </div>
            </div>

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Trial Balance for ALL',array('reporttools/trialBlanceAll')); ?>
                </div>
            </div>

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Chart of Account List',array('reporttools/chartOfAccount')); ?>
                </div>
            </div>

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Journal Transaction',array('reporttools/journalTransaction')); ?>
                </div>
            </div>

        </div>
        <div style="width: 45%; float: left">

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Balance Sheet',array('reporttools/balanceSheet')); ?>
                </div>
            </div>
            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Profit & Loss',array('reporttools/pnl')); ?>
                </div>
            </div>
            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('A/C - GL Report',array('reporttools/AcGlReports')); ?>
                </div>
            </div>
        </div>

    </div>


    <div id="flag_desc" style="width: 97%; float: left;">
        <div id="flag_desc_text"> Inventory Reports </div>

        <div style="width: 50%; float: left; margin-right: 2%;">
            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Item Ledger',array('reporttools/itemLedger')); ?>
                </div>
            </div>

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Inventory Movement',array('reporttools/inventoryMovement')); ?>
                </div>
            </div>

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Stock Dispatch',array('reporttools/stockDispatch')); ?>
                </div>
            </div>
        </div>
        <div style="width: 45%; float: left;">
            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Stock Balance',array('reporttools/stockBalance')); ?>
                </div>
            </div>

            <div class="report_main_div">
                <div class="report_button">
                    <?php echo CHtml::link('Stock Balance after Adjustment',array('reporttools/stockBalanceAfterAd')); ?>
                </div>
            </div>
        </div>

    </div>
</div>








