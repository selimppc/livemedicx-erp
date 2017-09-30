<?php

class ReporttoolsController extends Controller
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
                'actions'=>array('index', 'view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('admin', 'delete', 'create', 'update', 'Inventory', 'ItemLedger', 'LedReport', 'PurchaseOrder','PurchaseOrders', 'GLReports', 'TrialBalanceReport', 'TrialBlance', 'TrialBlanceAll', 'TrialBalanceAllReport',
                    'MasterSetupReports', 'SupllierLedger', 'SupllierLedgerReports', 'ChartOfAccount', 'ChartOfAccountList',
                    'JournalTransaction', 'JournalTransactionReports', 'PurchaseReports','PurchaseOrderReports',
                    'PurchaseOrdRepo','InventoryReports','SalesReports','InventoryMovement','InventoryMovementReports',
                    'StockDispatch', 'StockDispatchReports', 'apReports', 'BalanceSheet', 'BalanceSheetReports',
                    'PNL', 'PNLReports','SalesOrder', 'SalesOrders', 'SingleVoucher', 'SingleVouchers', 'SinglePoGrn',
                    'DeliveryOrderChallan', 'DeliveryOrderChallans', 'ProductList', 'ProductListReports',
                    'CustomerLedger', 'CustomerLedgerReport','CustomerLedgerSales', 'CustomerLedgerSalesReport',
                    'DirectSales', 'DirectSale', 'Adjustment', 'Adjustments', 'StockBalance', 'StockBalances',
                    'StockBalanceAfterAd', 'StockBalanceAfterAds', 'testReport', 'ExpiredProductList', 'ExpiredProductLists', 'AcGlReports',
                    'LedgerAcGlReports'
                ),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin', 'delete'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionTestReport(){

        $re = new JasperReport('/reports/samples/AllAccounts',
            JasperReport::FORMAT_HTML, array(
                //'pBranch' => $branch,
                //'pFromDate' => $fromDate,
                //'pToDate' => $toDate,
            )
        );

        $re->exec();
        echo $re->toPDF();
    }
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionAdmin()
    {
        $this->render('admin');
    }

    public function actionInventory()
    {
        $this->render('inventory');
    }

    public function actionItemLedger()
    {
        $model = new Branchmaster;

        $this->render('itemledger', array(
            'model'=>$model,
        ));
    }

    protected function beforeAction($action) {
        if (!parent::beforeAction($action))
            return false;
        $this->setPageTitle(ucfirst($action->getId()));

        return true;
    }

    public function actionLedReport(){

        $this->pageTitle = 'Item Ledger';

        $branch = $_POST['Branchmaster']['cm_branch'];
        $fromDate = $_POST['from_date'];
        $toDate = $_POST['to_date'];

        $re = new JasperReport('/Itabps/Reports/im_itemled',
            JasperReport::FORMAT_HTML, array(
                'pBranch' => $branch,
                'pFromDate' => $fromDate,
                'pToDate' => $toDate,
            )
        );
        $re->exec();
        echo $re->toPDF();

        //$html = $re->toHTML();
        //$this->render('imledger', array('html'=>$html));

    }

    //purchase order
    public function actionPurchaseOrder($pPoNumber){

        $this->pageTitle = 'Purchase Order';

        $re = new JasperReport('/Itabps/Reports/pp_purchaseord',
            JasperReport::FORMAT_HTML, array(
                'pPoNumber' => $pPoNumber,
            )
        );
        $re->exec();
        echo $re->toPDF();

    }

    public function actionPurchaseOrders($pPoNumber){

        $this->pageTitle = 'Purchase Order';

        $re = new JasperReport('/Itabps/Reports/pp_purchaseord',
            JasperReport::FORMAT_XLS, array(
                'pPoNumber' => $pPoNumber,
            )
        );
        $re->exec();
        echo $re->reportToXLS();

    }

    /*
    // ============================= General Ledger Reporting ==================================================
    */

    public function actionGLReports()
    {
        $model = new Branchmaster;

        $this->render('general_ledger_report', array(
            'model'=>$model,
        ));
    }

    public function actionTrialBlance()
    {
        $model = new Branchmaster;

        $this->render('trial_balance', array(
            'model'=>$model,
        ));
    }

    public function actionTrialBalanceReport(){

        $this->pageTitle = 'Item Ledger';

        $branch = $_POST['Branchmaster']['cm_branch'];
        $fromDate = $_POST['from_date'];
        $toDate = $_POST['to_date'];
        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/am_trial_bl',
                JasperReport::FORMAT_PDF, array(
                    'pBranch' => $branch,
                    'pFromDate' => $fromDate,
                    'pToDate' => $toDate,
                )
            );

            $re->exec();
            echo $re->reportToPDF();

        }else{
            $re = new JasperReport('/Itabps/Reports/am_trial_bl',
                JasperReport::FORMAT_XLS, array(
                    'pBranch' => $branch,
                    'pFromDate' => $fromDate,
                    'pToDate' => $toDate,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }

    // Trial Balance for All Branches
    public function actionTrialBlanceAll()
    {
        $model = new Branchmaster;

        $this->render('trial_balance_all', array(
            'model'=>$model,
        ));
    }

    public function actionTrialBalanceAllReport(){

        $this->pageTitle = 'Item Ledger';

        $branch = $_POST['Branchmaster']['cm_branch'];
        $fromDate = $_POST['from_date'];
        $toDate = $_POST['to_date'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/gl_trailblall',
                JasperReport::FORMAT_PDF, array(
                    'pBranch' => $branch,
                    'pFromDate' => $fromDate,
                    'pToDate' => $toDate,
                )
            );

            $re->exec();
            echo $re->reportToPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/gl_trailblall',
                JasperReport::FORMAT_XLS, array(
                    'pBranch' => $branch,
                    'pFromDate' => $fromDate,
                    'pToDate' => $toDate,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }


    // Master Setup => Reporting....
    public function actionMasterSetupReports(){
        $model = new Codesparam;

        $this->render('master_setup_reports', array(
            'model'=>$model,
        ));
    }

    public function actionProductList(){
        $model = new Productmaster;

        $this->render('product_list', array(
            'model'=>$model,
        ));
    }
    public function actionProductListReports(){

        $this->pageTitle = 'Product List Reports';

        $pClass = $_POST['Productmaster']['cm_class'];
        $pCategory = $_POST['Productmaster']['cm_category'];


        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/cm_productlist',
                JasperReport::FORMAT_PDF, array(
                    'pClass' => $pClass,
                    'pCategory' => $pCategory,
                )
            );

            $re->exec();
            echo $re->toPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/cm_productlist',
                JasperReport::FORMAT_XLS, array(
                    'pClass' => $pClass,
                    'pCategory' => $pCategory,
                )
            );

            $re->exec();
            echo $re->toXLS();
        }


    }


    public function actionCustomerLedger(){
        $model = new Customermst;

        $this->render('customer_ledger', array(
            'model'=>$model,
        ));
    }

    public function actionCustomerLedgerReport(){

        $this->pageTitle = 'Customer Ledger Report';

        $pCustomer = $_POST['Customermst']['cm_cuscode'];
        $pFromDate = $_POST['from_date'];
        $pToDate = $_POST['to_date'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/ar_cusled',
                JasperReport::FORMAT_PDF, array(
                    'pCustomer' => $pCustomer,
                    'pFromDate' => $pFromDate,
                    'pToDate' => $pToDate,
                )
            );
            $re->exec();
            echo $re->reportToPDF();


        }else{
            $re = new JasperReport('/Itabps/Reports/ar_cusled',
                JasperReport::FORMAT_XLS, array(
                    'pCustomer' => $pCustomer,
                    'pFromDate' => $pFromDate,
                    'pToDate' => $pToDate,
                )
            );
            $re->exec();
            echo $re->reportToXLS();
        }


    }





    public function actionSupllierLedger(){
        $model = new Branchmaster;

        $this->render('supplier_ledger', array(
            'model'=>$model,
        ));
    }

    public function actionSupllierLedgerReports(){

        $this->pageTitle = 'Supplier Ledger';

        $pBranch = $_POST['Branchmaster']['cm_branch'];
        $pFromDate = $_POST['from_date'];
        $pToDate = $_POST['to_date'];
        $pSuplierID = $_POST['Branchmaster']['supplier_name'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/ap_supled',
                JasperReport::FORMAT_PDF, array(
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate' => $pToDate,
                    'pSuplierID'=>$pSuplierID,
                )
            );

            $re->exec();
            echo $re->reportToPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/ap_supled',
                JasperReport::FORMAT_XLS, array(
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate' => $pToDate,
                    'pSuplierID'=>$pSuplierID,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }
    public function actionBalanceSheet(){
        $model = new Branchmaster;

        $this->render('balance_sheet', array(
            'model'=>$model,
        ));
    }

    public function actionBalanceSheetReports(){

        $this->pageTitle = 'Balance Sheet ';

        $pYear = $_POST['Branchmaster']['cm_phone'];
        $pPeriod = $_POST['Branchmaster']['inserttime'];
        $pBranch = $_POST['Branchmaster']['cm_branch'];
        $pStyle = $_POST['Branchmaster']['insertuser'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/gl_blsheet',
                JasperReport::FORMAT_PDF, array(
                    'pYear' => $pYear,
                    'pPeriod' => $pPeriod,
                    'pBranch' => $pBranch,
                    'pStyle'=>$pStyle,
                )
            );

            $re->exec();
            echo $re->reportToPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/gl_blsheet',
                JasperReport::FORMAT_XLS, array(
                    'pYear' => $pYear,
                    'pPeriod' => $pPeriod,
                    'pBranch' => $pBranch,
                    'pStyle'=>$pStyle,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }

    public function actionPNL(){
        $model = new Branchmaster;

        $this->render('pnl', array(
            'model'=>$model,
        ));
    }

    public function actionPNLReports(){

        $this->pageTitle = 'Profit & Loss ';

        $pYear = $_POST['Branchmaster']['cm_phone'];
        $pPeriod = $_POST['Branchmaster']['inserttime'];
        $pBranch = $_POST['Branchmaster']['cm_branch'];
        $pStyle = $_POST['Branchmaster']['insertuser'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/gl_pnlsheet',
                JasperReport::FORMAT_PDF, array(
                    'pYear' => $pYear,
                    'pPeriod' => $pPeriod,
                    'pBranch' => $pBranch,
                    'pStyle'=>$pStyle,
                )
            );

            $re->exec();
            echo $re->reportToPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/gl_pnlsheet',
                JasperReport::FORMAT_XLS, array(
                    'pYear' => $pYear,
                    'pPeriod' => $pPeriod,
                    'pBranch' => $pBranch,
                    'pStyle'=>$pStyle,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }

    /*
     * ==============================================================================================
     * Chart of Account List
     * ==============================================================================================
     */

    public function actionChartOfAccount(){

        $this->pageTitle = 'Chart of Account';

        $model = new Chartofaccounts;

        $this->render('chart_of_account', array(
            'model'=>$model,
        ));
    }

    public function actionChartOfAccountList(){

        $this->pageTitle = 'Chart of Account List';

        $pType = $_POST['Chartofaccounts']['am_accounttype'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/am_chacclist',
                JasperReport::FORMAT_PDF, array(
                    'pType' => $pType,
                )
            );

            $re->exec();
            echo $re->reportToPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/am_chacclist',
                JasperReport::FORMAT_XLS, array(
                    'pType' => $pType,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }



    /*
     * ==============================================================================================
     * Journal Transaction
     * ==============================================================================================
     */

    public function actionJournalTransaction(){
        $this->pageTitle = 'Journal Transaction';

        $model = new Branchmaster;
        $trncode = new Transaction;

        $this->render('journal_transaction', array(
            'model'=>$model, 'trncode'=>$trncode,
        ));
    }

    public function actionJournalTransactionReports(){

        $this->pageTitle = 'Journal Transaction';

        $pTrn = $_POST['Transaction']['cm_trncode'];
        $pBranch = $_POST['Branchmaster']['cm_branch'];
        $pFromDate = $_POST['from_date'];
        $pToDate = $_POST['to_date'];
        $pStatus = $_POST['Branchmaster']['active'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/gl_transaction',
                JasperReport::FORMAT_PDF, array(
                    'pTrn' => $pTrn,
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate'=>$pToDate,
                    'pStatus'=>$pStatus,
                )
            );

            $re->exec();
            echo $re->reportToPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/gl_transaction',
                JasperReport::FORMAT_XLS, array(
                    'pTrn' => $pTrn,
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate'=>$pToDate,
                    'pStatus'=>$pStatus,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }



    /*
    // ============================= Purchase Module  Reporting ==================================================
    */

    public function actionPurchaseReports()
    {
        $this->pageTitle = 'Purchase Module Reports';

        $this->render('purchase_report', array(
            //'model'=>$model,
        ));
    }
    public function actionPurchaseOrdRepo()
    {
        $this->pageTitle = 'Purchase Order Reports';

        $model = new Purchaseordhd;

        $this->render('purchase_order_report', array(
            'model'=>$model,
        ));
    }

    public function actionPurchaseOrderReports(){

        $this->pageTitle = 'Purchase Order Reports';

        $pPoNumber = $_POST['Purchaseordhd']['pp_purordnum'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/pp_purchaseord',
                JasperReport::FORMAT_PDF, array(
                    'pPoNumber' => $pPoNumber,
                )
            );

            $re->exec();
            echo $re->reportToPDF();

        }else{

            $re = new JasperReport('/Itabps/Reports/pp_purchaseord',
                JasperReport::FORMAT_XLS, array(
                    'pPoNumber' => $pPoNumber,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }




    /*
    // ============================= Inventiry Module  Reporting ==================================================
    */

    public function actionInventoryReports()
    {
        $this->pageTitle = 'Inventory Module Reports';

        $this->render('inventory_report', array(
            //'model'=>$model,
        ));
    }

    public function actionInventoryMovement(){
        $this->pageTitle = 'Inventory Movement';

        $model = new Branchmaster;
        $trncode = new Productmaster;

        $this->render('inventory_movement', array(
            'model'=>$model, 'trncode'=>$trncode,
        ));
    }

    public function actionInventoryMovementReports(){

        $this->pageTitle = 'Inventory Movement';

        $pBranch = $_POST['Branchmaster']['cm_branch'];
        $pFromDate = $_POST['from_date'];
        $pToDate = $_POST['to_date'];
        $pProduct = $_POST['Productmaster']['cm_code'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/im_movement',
                JasperReport::FORMAT_PDF, array(
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate'=>$pToDate,
                    'pProduct'=>$pProduct,
                )
            );

            $re->exec();
            echo $re->reportToPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/im_movement',
                JasperReport::FORMAT_XLS, array(
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate'=>$pToDate,
                    'pProduct'=>$pProduct,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }

    public function actionStockDispatch(){
        $this->pageTitle = 'Stock Dispatch';

        $model = new Branchmaster;

        $this->render('stock_dispatch', array(
            'model'=>$model,
        ));
    }

    public function actionStockDispatchReports(){

        $this->pageTitle = 'Stock Dispatch';

        $pBranch = $_POST['Branchmaster']['cm_branch'];
        $pFromDate = $_POST['from_date'];
        $pToDate = $_POST['to_date'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/im_transfer',
                JasperReport::FORMAT_PDF, array(
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate'=>$pToDate,
                )
            );

            $re->exec();
            echo $re->reportToPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/im_transfer',
                JasperReport::FORMAT_XLS, array(
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate'=>$pToDate,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }


    public function actionSinglePoGrn($pPoNumber){

        $this->pageTitle = 'Single Po Wise GRN';

        $re = new JasperReport('/Itabps/Reports/pp_singlepogrn',
            JasperReport::FORMAT_PDF, array(
                'pPoNumber' => $pPoNumber,
            )
        );
        $re->exec();
        echo $re->toPDF();

    }




    //purchase order
    public function actionDeliveryOrderChallan($psmnumber){

        $this->pageTitle = 'Purchase Order';

        $re = new JasperReport('/Itabps/Reports/im_dochallan',
            JasperReport::FORMAT_HTML, array(
                'psmnumber' => $psmnumber,
            )
        );
        $re->exec();
        echo $re->toPDF();

    }

    public function actionDeliveryOrderChallans($psmnumber){

        $this->pageTitle = 'Purchase Order';

        $re = new JasperReport('/Itabps/Reports/im_dochallan',
            JasperReport::FORMAT_XLS, array(
                'psmnumber' => $psmnumber,
            )
        );
        $re->exec();
        echo $re->reportToXLS();

    }



    /*
    // ============================= Sales Module  Reporting ==================================================
    */

    public function actionSalesReports()
    {
        $this->pageTitle = 'Sales Module Reports';

        $this->render('sales_report', array(
            //'model'=>$model,
        ));
    }



    public function actionSalesOrder($psmnumber){

        $this->pageTitle = 'Sales Order';

        $re = new JasperReport('/Itabps/Reports/sm_salesorder',
            JasperReport::FORMAT_HTML, array(
                'psmnumber' => $psmnumber,
            )
        );
        $re->exec();
        echo $re->toPDF();

    }

    public function actionSalesOrders($psmnumber){

        $this->pageTitle = 'Sales Order';

        $re = new JasperReport('/Itabps/Reports/sm_salesorder',
            JasperReport::FORMAT_XLS, array(
                'psmnumber' => $psmnumber,
            )
        );
        $re->exec();
        echo $re->reportToXLS();

    }

    public function actionSingleVoucher($pVoucherNo){

        $this->pageTitle = 'GL Voucher';

        $re = new JasperReport('/Itabps/Reports/gl_singlevoucher',
            JasperReport::FORMAT_HTML, array(
                'pVoucherNo' => $pVoucherNo,
            )
        );
        $re->exec();
        echo $re->toPDF();

    }
    public function actionSingleVouchers($pVoucherNo){

        $this->pageTitle = 'GL Voucher';

        $re = new JasperReport('/Itabps/Reports/gl_singlevoucher',
            JasperReport::FORMAT_XLS, array(
                'pVoucherNo' => $pVoucherNo,
            )
        );
        $re->exec();
        echo $re->reportToXLS();

    }





    public function actionCustomerLedgerSales(){
        $model = new Customermst;

        $this->render('customer_ledger_sales', array(
            'model'=>$model,
        ));
    }

    public function actionCustomerLedgerSalesReport(){

        $this->pageTitle = 'Customer Ledger Report';

        $pCustomer = $_POST['Customermst']['cm_cuscode'];
        $pFromDate = $_POST['from_date'];
        $pToDate = $_POST['to_date'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/ar_cusled',
                JasperReport::FORMAT_PDF, array(
                    'pCustomer' => $pCustomer,
                    'pFromDate' => $pFromDate,
                    'pToDate' => $pToDate,
                )
            );

            $re->exec();
            echo $re->reportToPDF();
        }else{

            $re = new JasperReport('/Itabps/Reports/ar_cusled',
                JasperReport::FORMAT_XLS, array(
                    'pCustomer' => $pCustomer,
                    'pFromDate' => $pFromDate,
                    'pToDate' => $pToDate,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }

    /*
    // ============================= Account Payable  Reporting ==================================================
    */

    public function actionApReports()
    {
        $this->pageTitle = 'Account Payable Module Reports';

        $this->render('ap_reports', array(
            //'model'=>$model,
        ));
    }




    /*
     * =========================================================================================================
     *
     * Direct Sales Reports
     *
     * =========================================================================================================
     */

    public function actionDirectSale($psmnumber){

        $this->pageTitle = 'Direct Sales';

        $re = new JasperReport('/Itabps/Reports/sm_directsale',
            JasperReport::FORMAT_HTML, array(
                'psmnumber' => $psmnumber,
            )
        );
        $re->exec();
        echo $re->toPDF();

    }

    public function actionDirectSales($psmnumber){

        $this->pageTitle = 'Direct Sales';

        $re = new JasperReport('/Itabps/Reports/sm_directsale',
            JasperReport::FORMAT_XLS, array(
                'psmnumber' => $psmnumber,
            )
        );
        $re->exec();
        echo $re->reportToXLS();

    }


    /*
     * =========================================================================================================
     *
     * Stock Adjustment Reports
     *
     * =========================================================================================================
     */

    public function actionAdjustment($ptrnnumber){

        $this->pageTitle = 'Direct Sales';

        $re = new JasperReport('/Itabps/Reports/im_adjustment',
            JasperReport::FORMAT_HTML, array(
                'ptrnnumber' => $ptrnnumber,
            )
        );
        $re->exec();
        echo $re->toPDF();

    }

    public function actionAdjustments($ptrnnumber){

        $this->pageTitle = 'Direct Sales';

        $re = new JasperReport('/Itabps/Reports/im_adjustment',
            JasperReport::FORMAT_XLS, array(
                'ptrnnumber' => $ptrnnumber,
            )
        );
        $re->exec();
        echo $re->reportToXLS();

    }



    /*
     * =====================================================================================
     * Stock Balance
     * =====================================================================================
     */

    public function actionStockBalance(){
        $this->pageTitle = 'Stock Balance';

        $model = new Branchmaster;

        $this->render('stock_balance', array(
            'model'=>$model,
        ));
    }

    public function actionStockBalances(){

        $this->pageTitle = 'Stock Balance';

        $pBranch = $_POST['Branchmaster']['cm_branch'];
        $pDate = $_POST['from_date'];


        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/im_balance',
                JasperReport::FORMAT_PDF, array(
                    'pBranch' => $pBranch,
                    'pDate' => $pDate,
                )
            );

            $re->exec();
            echo $re->reportToPDF();

        }else{

            $re = new JasperReport('/Itabps/Reports/im_balance',
                JasperReport::FORMAT_XLS, array(
                    'pBranch' => $pBranch,
                    'pDate' => $pDate,
                )
            );

            $re->exec();
            echo $re->reportToXLS();

        }


    }


    /*
     * =====================================================================================
     * Stock Balance after Adjustment
     * =====================================================================================
     */

    public function actionStockBalanceAfterAd(){
        $this->pageTitle = 'Stock Balance after Adjustment';

        $model = new Branchmaster;

        $this->render('stock_balance_after_ad', array(
            'model'=>$model,
        ));
    }

    public function actionStockBalanceAfterAds(){

        $this->pageTitle = 'Stock Balance after Adjustment';

        $pBranch = $_POST['Branchmaster']['cm_branch'];
        $pDate = $_POST['from_date'];


        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/im_afteradjust',
                JasperReport::FORMAT_PDF, array(
                    'pBranch' => $pBranch,
                    'pDate' => $pDate,
                )
            );

            $re->exec();
            echo $re->reportToPDF();

        }else{

            $re = new JasperReport('/Itabps/Reports/im_afteradjust',
                JasperReport::FORMAT_XLS, array(
                    'pBranch' => $pBranch,
                    'pDate' => $pDate,
                )
            );

            $re->exec();
            echo $re->reportToXLS();

        }


    }


    /*
     * =====================================================================================
     * Expired Product List
     * =====================================================================================
     */

    public function actionExpiredProductList(){
        $this->pageTitle = 'Expired Product List';

        $model = new Customermst;

        $this->render('product_expired_item', array(
            'model'=>$model,
        ));
    }

    public function actionExpiredProductLists(){

        $this->pageTitle = 'Expired Product List';

        $pCategory = $_POST['Customermst']['cm_cuscode'];
        $pFromDate = $_POST['from_date'];
        $pToDate = $_POST['to_date'];

        if(isset($_POST['topdf']))
        {
            $re = new JasperReport('/Itabps/Reports/im_expireditem',
                JasperReport::FORMAT_PDF, array(
                    'pCategory' => $pCategory,
                    'pFromDate' => $pFromDate,
                    'pToDate' => $pToDate,
                )
            );

            $re->exec();
            echo $re->reportToPDF();

        }else{

            $re = new JasperReport('/Itabps/Reports/im_expireditem',
                JasperReport::FORMAT_XLS, array(
                    'pCategory' => $pCategory,
                    'pFromDate' => $pFromDate,
                    'pToDate' => $pToDate,
                )
            );

            $re->exec();
            echo $re->reportToXLS();

        }


    }






    /*
     * ==============================================================================================
     * A/C GL Report
     * ==============================================================================================
     */

    public function actionAcGlReports(){
        $this->pageTitle = 'Ledger Balance';

        $model = new Branchmaster;
        $coa = new Chartofaccounts;

        $this->render('ac_gl_report', array(
            'model'=>$model, 'coa'=>$coa,
        ));
    }

    public function actionLedgerAcGlReports(){

        #exit("LedgerAcGlReports");
        $this->pageTitle = 'Ledger Balance';

        $pAccountTile = $_POST['Chartofaccounts']['am_description'];
        $pBranch = $_POST['Branchmaster']['cm_branch'];
        $pFromDate = $_POST['from_date'];
        $pToDate = $_POST['to_date'];

        if(isset($_POST['topdf']))
        {
            /*$re = new JasperReport('Itabps/Reports/ac_gl_account',
                JasperReport::FORMAT_PDF, array(
                    'pAccountTile' => $pAccountTile,
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate'=>$pToDate,
                )
            );

            $res= $re->exec();
            echo $re->reportToPDF();*/

            /* Pdf Report */
            $re = new JasperReport('/entsol/Reports/AcAccounts',
                JasperReport::FORMAT_PDF, array(
                    'pAccountTile' => $pAccountTile,
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate'=>$pToDate,
                )
            );
            $re->exec();
            echo $re->reportToPDF(); //All pages

            //AllAccounts;
            exit();
        }else{

            $re = new JasperReport('/Itabps/Reports/ac_gl_account',
                JasperReport::FORMAT_XLS, array(
                    'pAccountTile' => $pAccountTile,
                    'pBranch' => $pBranch,
                    'pFromDate' => $pFromDate,
                    'pToDate'=>$pToDate,
                )
            );

            $re->exec();
            echo $re->reportToXLS();
        }


    }




}