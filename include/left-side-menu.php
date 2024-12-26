<div class="app-menu navbar-menu">
    <!-- Logo Section -->
    <div class="navbar-brand-box">
        <a href="createAccount.php" class="logo-link">
            <h2 style="text-align: justify; margin-top: 20px; font-size: 18px; color: white;">Logo</h2>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <!-- Dynamic Two Column Menu Placeholder -->
            <div id="two-column-menu"></div>

            <ul class="navbar-nav" id="navbar-nav">
                <!-- Dashboard Section -->
                <li class="menu-title"><span data-key="t-menu">Dashboard</span></li>

                <!-- Master Section -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#masterToggle" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="masterToggle">
                        <i class="ri-apps-2-line"></i> <span data-key="t-dashboards">Master</span>
                    </a>
                    <div class="collapse menu-dropdown" id="masterToggle">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="./createAccount.php" class="nav-link">Create Account</a></li>
                            <li class="nav-item"><a href="./createRawMaterial.php" class="nav-link">Raw Material</a></li>
                            <li class="nav-item"><a href="./createFinishGoods.php" class="nav-link">Finished Goods</a></li>
                            <li class="nav-item"><a href="./expense.php" class="nav-link">Expense</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Entry Section -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#entrySection" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="entrySection">
                        <i class="ri-menu-line"></i> <span data-key="t-apps">Entry</span>
                    </a>
                    <div class="collapse menu-dropdown" id="entrySection">
                        <ul class="nav nav-sm flex-column">
                            <!-- Sales Submenu -->
                            <li class="nav-item">
                                <a href="#salesMenu" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="salesMenu">
                                    Sales
                                </a>
                                <div class="collapse menu-dropdown" id="salesMenu">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item"><a href="salesEntry.php" class="nav-link">Finished Goods Sales</a></li>
                                        <li class="nav-item"><a href="salesReturn.php" class="nav-link">Finished Goods Sales Return</a></li>
                                        <li class="nav-item"><a href="rawsemiMaterialsales.php" class="nav-link">Raw Sales</a></li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Purchase Submenu -->
                            <li class="nav-item">
                                <a href="#purchaseMenu" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="purchaseMenu">
                                    Purchase
                                </a>
                                <div class="collapse menu-dropdown" id="purchaseMenu">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item"><a href="rawSemiPurchase.php" class="nav-link">Raw/Semi Purchase</a></li>
                                        <li class="nav-item"><a href="rawSemiPurchaseReturn.php" class="nav-link">Raw/Semi Return</a></li>
                                        <li class="nav-item"><a href="finishedGoodsPurchase.php" class="nav-link">Finished Goods Purchase</a></li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Additional Links -->
                            <li class="nav-item"><a href="metalPurchaselot.php" class="nav-link">Metal Purchase (Lot Wise)</a></li>
                            <li class="nav-item"><a href="cableProduction.php" class="nav-link">Cable Production</a></li>
                            <li class="nav-item"><a href="semiGoodsProduction.php" class="nav-link">PVC Production</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Delete Section -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#deleteSection" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="deleteSection">
                        <i class="ri-delete-bin-fill"></i> <span data-key="t-apps">Delete</span>
                    </a>
                    <div class="collapse menu-dropdown" id="deleteSection">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="groupDataDelete.php" class="nav-link">Group Delete</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Reports Section -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#reportsSection" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="reportsSection">
                        <i class="ri-stack-line"></i> <span data-key="t-dashboards">Purchase Reports</span>
                    </a>
                    <div class="collapse menu-dropdown" id="reportsSection">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="purchaseReport.php" class="nav-link">Purchase Report</a></li>
                            <li class="nav-item"><a href="rawMaterialpurchasereturnsview.php" class="nav-link">Purchase Return Report</a></li>
                            <li class="nav-item"><a href="finishedGoodsPurchaseReport.php" class="nav-link">Finished Goods Purchase Report</a></li>
                        </ul>
                    </div>
                </li>
                
                <!-- Reports Section -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#reportsSection" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="reportsSection">
                        <i class="ri-bar-chart-box-line"></i><span data-key="t-dashboards">Sales Reports</span>
                    </a>
                    <div class="collapse menu-dropdown" id="reportsSection">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="salesReport.php" class="nav-link">Finished Goods Sales Report</a></li>
                            <li class="nav-item"><a href="finishedGoodsSaleReturn.php" class="nav-link">Finished Goods Sales Return Report</a></li>
                            <li class="nav-item"><a href="rawSaleReport.php" class="nav-link">Raw Sale Report</a></li>
                            <li class="nav-item"><a href="pvcProductionReport.php" class="nav-link">PVC Production Report</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
