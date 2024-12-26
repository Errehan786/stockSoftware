<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="dashboard.php">
                    <h2 style="text-align:justify ;margin-top:20px;font-size: 18px;color: white;">Logo</h2>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Dashboard</span></li>
                         <li class="nav-item">
                            <a class="nav-link menu-link" href="#masterToggle" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="catgoryToggle">
                                <i class="ri-apps-2-line"></i> <span data-key="t-dashboards">Master</span>
                            </a>
                            <div class="collapse menu-dropdown" id="masterToggle">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="./createAccount.php" class="nav-link">Create Account</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./createRawMaterial.php" class="nav-link">Raw Material</a>
                                    </li>
                                      <li class="nav-item">
                                        <a href="./createFinishGoods.php" class="nav-link">Finished Goods</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./expense.php" class="nav-link">Expense</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                       <!---our leftbar--->
                           <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="fas fa-bars"></i> <span data-key="t-apps">Entry</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#sidebarSales" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSales" data-key="t-Sales">
                                            Sales
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarSales">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="salesEntry.php" class="nav-link" data-key="t-sales"> Finish Goods Sales </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="salesReturn.php" class="nav-link" data-key="t-month-grid">Finish Goods Sales Return </a>
                                                </li>
                                                 <li class="nav-item">
                                                    <a href="rawsemiMaterialsales.php" class="nav-link" data-key="t-month-grid">Raw Sales </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                     <li class="nav-item">
                                        <a href="#sidebarPurchase" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCalendar" data-key="t-Purchase">
                                            Purchase
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarPurchase">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="rawSemiPurchase.php" class="nav-link" data-key="t-main-calender"> Raw/Semi Purchase </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="rawSemiPurchaseReturn.php" class="nav-link" data-key="t-month-grid">Raw/Semi Return </a>
                                                </li>
                                                 <li class="nav-item">
                                                    <a href="finishedGoodsPurchase.php" class="nav-link" data-key="t-month-grid">Finished Goods Purchase</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="metalPurchaselot.php" class="nav-link" data-key="t-metalPurchaseL"> Metal Purchase (lot Wise) </a>
                                    </li>
                                    <!--  <li class="nav-item">-->
                                    <!--    <a href="metalPurchaseAvg.php" class="nav-link" data-key="t-metalPurchaseA"> Metal Purchase (Avg.) </a>-->
                                    <!--</li>-->
                                     <li class="nav-item">
                                        <a href="cableProduction.php" class="nav-link" data-key="t-cableProd"> Cable Production </a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="semiGoodsProduction.php" class="nav-link" data-key="t-semiGoodProd"> PVC Production </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                         <!---our leftbar--->
                           <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="fas fa-trash"></i> <span data-key="t-apps">Delete</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="groupDataDelete.php" class="nav-link" data-key="t-metalPurchaseL"> Group Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-stack-line"></i> <span data-key="t-dashboards">Reports</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="salescreditReports.php" class="nav-link" data-key="t-analytics">Sales Credit Reports</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="purchaseReport.php" class="nav-link" data-key="t-analytics">Purchase Report </a>
                                    </li>
                                      <li class="nav-item">
                                        <a href="cashBook.php" class="nav-link" data-key="t-analytics">Cash Book</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="metalPurchaseDetail.php" class="nav-link" data-key="t-analytics">Metal Purchase Details</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="cableProductionReport.php" class="nav-link" data-key="t-analytics">Cable Production Report</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="receivables.php" class="nav-link" data-key="t-analytics">Receivables (Sundry Debtors)</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="payables.php" class="nav-link" data-key="t-analytics">Payables (sundry Creditors)</a>
                                    </li>
                                      <li class="nav-item">
                                        <a href="stockRegister.php" class="nav-link" data-key="t-analytics">Stock Register</a>
                                    </li>
                                      <li class="nav-item">
                                        <a href="stockCopper.php" class="nav-link" data-key="t-analytics">Stock - Copper</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        
                       <!---our leftbarend--->
                        <!--  <li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="./accountDetails.php">-->
                        <!--        <i class="ri-account-circle-line"></i> <span data-key="t-dashboards">Account</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <!--  <li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="#catgoryToggle" data-bs-toggle="collapse" role="button"-->
                        <!--        aria-expanded="false" aria-controls="catgoryToggle">-->
                        <!--        <i class="ri-apps-2-line"></i> <span data-key="t-dashboards">Material</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="catgoryToggle">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./rawmaterialList.php" class="nav-link">Raw Material </a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./finishmaterialList.php" class="nav-link">Finished Goods</a>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!--   <li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="#catgoryToggle" data-bs-toggle="collapse" role="button"-->
                        <!--        aria-expanded="false" aria-controls="catgoryToggle">-->
                        <!--        <i class="ri-apps-2-line"></i> <span data-key="t-dashboards">Invoice</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="catgoryToggle">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./salesInvoice.php" class="nav-link">Sale Invoice</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./salesReturn.php" class="nav-link">Sales Return</a>-->
                        <!--            </li>-->
                        <!--              <li class="nav-item">-->
                        <!--                <a href="./rawsemiMaterialsales.php" class="nav-link">Raw/Semi Material Sales</a>-->
                        <!--            </li>-->
                        <!--              <li class="nav-item">-->
                        <!--                <a href="./rawMaterialpurchaseinvoice.php" class="nav-link">Raw Material Purchase Invoice</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./rawMaterialpurchasereturns.php" class="nav-link">Raw Material Purchase Returns</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./readyProductpurchaseinvoice.php" class="nav-link">Ready Product Purchase Invoice</a>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!-- <li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"-->
                        <!--        aria-expanded="false" aria-controls="sidebarDashboards">-->
                        <!--        <i class="ri-stack-line"></i> <span data-key="t-dashboards">Purchase</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="sidebarDashboards">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="purchaseEntryForm.php" class="nav-link" data-key="t-analytics">Purchase Entry</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="cableProduction.php" class="nav-link" data-key="t-analytics">Cable Production</a>-->
                        <!--            </li>-->
                        <!--              <li class="nav-item">-->
                        <!--                <a href="semiGoodsProduction.php" class="nav-link" data-key="t-analytics">Semi Goods Production</a>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!-- <li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"-->
                        <!--        aria-expanded="false" aria-controls="sidebarDashboards">-->
                        <!--        <i class="ri-stack-line"></i> <span data-key="t-dashboards">Cash</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="sidebarDashboards">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="cashReceipt.php" class="nav-link" data-key="t-analytics">Cash Receipt</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="cashPayment.php" class="nav-link" data-key="t-analytics">Cash Payment </a>-->
                        <!--            </li>-->
                        <!--              <li class="nav-item">-->
                        <!--                <a href="bankReceiptdeposites.php" class="nav-link" data-key="t-analytics">Bank Receipt/ Deposites</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="bankPaymentwithdrawal.php" class="nav-link" data-key="t-analytics">Bank Payment/ Withdrawal</a>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!-- <li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="#sidebarReports" data-bs-toggle="collapse" role="button"-->
                        <!--        aria-expanded="false" aria-controls="sidebarReports">-->
                        <!--        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">History</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="sidebarReports">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="accountledger.php" class="nav-link" data-key="t-horizontal">Account Ledger</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="readygoodsFormulation.php" class="nav-link" data-key="t-detached">Ready Goods Formulation</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="semigoodsFormulation.php" class="nav-link" data-key="t-detached">Semi Goods Formulation</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="productledgerReadygoods.php" class="nav-link" data-key="t-detached">Product Legder - Ready Goods</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="productledgerRawmaterial.php" class="nav-link" data-key="t-detached">Product Legder - Raw Material</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="productledgerMetal.php" class="nav-link" data-key="t-detached">Product Ledger - Metal</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="salesBook.php" class="nav-link" data-key="t-detached">Sales Book</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="salesreturnsBook.php" class="nav-link" data-key="t-detached">Sales Returns Book</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="rawsalesBook.php" class="nav-link" data-key="t-detached">Raw Sales Book</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="rawPurchaseBook.php" class="nav-link" data-key="t-detached">Raw Purchases Book</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="rawPurchasesreturnBook.php" class="nav-link" data-key="t-detached">Raw Purchases Returns Book</a>-->
                        <!--            </li>-->
                        <!--             <li class="nav-item">-->
                        <!--                <a href="fgoodsPurchasebook.php" class="nav-link" data-key="t-detached">Finished Goods Purchases Book</a>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                          
                      
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"-->
                        <!--        aria-expanded="false" aria-controls="sidebarDashboards">-->
                        <!--        <i class="ri-stack-line"></i> <span data-key="t-dashboards">Purchase</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="sidebarDashboards">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="purchaseEntryForm.php" class="nav-link" data-key="t-analytics">Purchase Entry</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./category.php" class="nav-link" data-key="t-crm">Category</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./categoryItemsPurchaseList.php" class="nav-link">Items</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./Expense.php" class="nav-link">Expense</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./vendor.php" class="nav-link"> Vendor </a> -->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./create-currency.php" class="nav-link">Currency</a>-->
                        <!--            </li>-->
                        <!--            <?php if(isset($_SESSION['userName']) && $_SESSION['userName']=="Admin"){?>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./create-company.php" class="nav-link">Company</a>-->
                        <!--            </li>-->
                        <!--            <?php }?>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="./rawMaterialOverview.php">-->
                        <!--        <i class="ri-stack-line"></i> <span data-key="t-dashboards">Raw Material Overview</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="#catgoryToggle" data-bs-toggle="collapse" role="button"-->
                        <!--        aria-expanded="false" aria-controls="catgoryToggle">-->
                        <!--        <i class="ri-apps-2-line"></i> <span data-key="t-dashboards">Product Manufacture</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="catgoryToggle">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./productmanufacturebatch.php" class="nav-link">Product Manufactured Batches</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./ProductAvailability.php" class="nav-link">Product Availability</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./productformulation.php" class="nav-link">Product Formula</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./ProductFormation.php" class="nav-link">Products</a>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button"-->
                        <!--        aria-expanded="false" aria-controls="sidebarLayouts">-->
                        <!--        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Sales</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="sidebarLayouts">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./customer.php" class="nav-link" data-key="t-detached">Customer Details</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./orderSheetForm.php" class="nav-link" data-key="t-detached">Order Sheet Form</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./orderSheetList.php" class="nav-link" data-key="t-horizontal">Order Sheet Overview</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./deliverSheetForm.php" class="nav-link" data-key="t-horizontal">Delivery Sheet Form</a>-->
                        <!--            </li>-->
                                    
                                    <!-- <li class="nav-item">
                        <!--                <a href="./deliverSheetList.php" class="nav-link" data-key="t-horizontal">-->
                        <!--                    Delivery Sheet List-->
                        <!--                </a>-->
                        <!--            </li> -->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="#sidebarReports" data-bs-toggle="collapse" role="button"-->
                        <!--        aria-expanded="false" aria-controls="sidebarReports">-->
                        <!--        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Reports</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="sidebarReports">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./manufacturingReport.php" class="nav-link" data-key="t-horizontal">Manufacturing Report</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./salesReport.php" class="nav-link" data-key="t-detached">Sales Report</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="./rawMaterialReport.php" class="nav-link" data-key="t-detached">Raw Materials Availability Report</a>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="vendor.php">-->
                        <!--        <i class="ri-computer-line"></i> <span data-key="t-dashboards">Vendor</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <!-- end Dashboard Menu -->
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>