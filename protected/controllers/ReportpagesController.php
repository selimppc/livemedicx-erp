<?php

class ReportpagesController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array(),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array(),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array(),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /*
01.  Customer Ledger Report (Pdf & Excel)
02. P & L (Profit & Lose Account) Pdf and Excel
03. Balance Sheet (Pdf and Excel)
04. Trial Balance (Pdf and Excel)
     */
    public function actionIndex(){

        $this->render('index',array());
    }

    /*** =========== Master Setup  =========== ***/

    /*** =========== General Ledger =========== ***/

    public function actionProfitLoss(){

    }

    public function actionBalanceSheet(){

    }

    public function actionTrialBalance(){

    }

    /*** =========== Purchase =========== ***/

    /*** =========== Account Payable =========== ***/

    /*** =========== Sales =========== ***/
    public function actionCustomerLedger(){

    }

    /*** =========== Inventory =========== ***/











}