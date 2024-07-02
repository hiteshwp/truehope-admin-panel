<!--app-content open-->
<?php
    setlocale(LC_MONETARY,"en_IN");
?>
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- ROW-1 -->
            <div class="row mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden text-white bg-danger">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="number-font">TODAYS</h5>
                                        </div>
                                    </div>
                                    <div class="row dashboardcards">
                                        <div class="col">
                                            <p>Amount Raised</p>
                                            <h3 class="mb-2 number-font"><span><?php echo number_format($dashboard_data["data"]["today_data"]["totaldonation"]); ?></span></h3>
                                        </div>
                                        <div class="col">
                                            <p>Doners</p>
                                            <h3 class="mb-2 number-font"><span><?php echo $dashboard_data["data"]["today_data"]["totaldonors"]; ?></span></h3>
                                        </div>
                                        <div class="col">
                                            <p>Campaigns</p>
                                            <h3 class="mb-2 number-font"><span><?php echo $dashboard_data["data"]["today_data"]["totalcampaigns"]; ?></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden text-white bg-dark">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="number-font">MONTHLY</h5>
                                        </div>
                                    </div>
                                    <div class="row dashboardcards">
                                        <div class="col">
                                            <p>Amount Raised</p>
                                            <h3 class="mb-2 number-font"><span><?php echo number_format($dashboard_data["data"]["monthly_data"]["totaldonation"]); ?></span></h3>
                                        </div>
                                        <div class="col">
                                            <p>Doners</p>
                                            <h3 class="mb-2 number-font"><span><?php echo $dashboard_data["data"]["monthly_data"]["totaldonors"]; ?></span></h3>
                                        </div>
                                        <div class="col">
                                            <p>Campaigns</p>
                                            <h3 class="mb-2 number-font"><span><?php echo $dashboard_data["data"]["monthly_data"]["totalcampaigns"]; ?></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden text-white bg-success">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="number-font">QUARTERLY</h5>
                                        </div>
                                    </div>
                                    <div class="row dashboardcards">
                                        <div class="col">
                                            <p>Amount Raised</p>
                                            <h3 class="mb-2 number-font"><span><?php echo number_format($dashboard_data["data"]["quarterly_data"]["totaldonation"]); ?></span></h3>
                                        </div>
                                        <div class="col">
                                            <p>Doners</p>
                                            <h3 class="mb-2 number-font"><span><?php echo $dashboard_data["data"]["quarterly_data"]["totaldonors"]; ?></span></h3>
                                        </div>
                                        <div class="col">
                                            <p>Campaigns</p>
                                            <h3 class="mb-2 number-font"><span><?php echo $dashboard_data["data"]["quarterly_data"]["totalcampaigns"]; ?></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden text-white bg-danger">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="number-font">YEARLY</h5>
                                        </div>
                                    </div>
                                    <div class="row dashboardcards">
                                        <div class="col">
                                            <p>Amount Raised</p>
                                            <h3 class="mb-2 number-font"><span><?php echo number_format($dashboard_data["data"]["yearly_data"]["totaldonation"]); ?></span></h3>
                                        </div>
                                        <div class="col">
                                            <p>Doners</p>
                                            <h3 class="mb-2 number-font"><span><?php echo $dashboard_data["data"]["yearly_data"]["totaldonors"]; ?></span></h3>
                                        </div>
                                        <div class="col">
                                            <p>Campaigns</p>
                                            <h3 class="mb-2 number-font"><span><?php echo $dashboard_data["data"]["yearly_data"]["totalcampaigns"]; ?></span></h3>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <form id="frmgetdatabetweendates">
                        <div class="card ">
                            <div class="card-body">
                                <div class="row my-3">
                                    <div class="col-md-3">
                                            <span class="dashboardgetdatatexbox">From Date - <input type="date" class="form-control mapfromdate" id="mapfromdate" required/></span>
                                    </div>
                                    <div class="col-md-3">
                                            <span class="dashboardgetdatatexbox">To Date - <input type="date" class="form-control maptodate" id="maptodate" required/></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-success" id="btngetdatewiserecords" value="Fetch Records">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="chart-container">
                                            <canvas id="chartBar2" class="h-600"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Campaign Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive export-table">
                                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">Campaign ID</th>
                                                    <th class="border-bottom-0">Campaign Title</th>
                                                    <th class="border-bottom-0">Total Donation</th>
                                                    <th class="border-bottom-0">Total Donors</th>
                                                    <!-- <th class="border-bottom-0">Status</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if( $dashboard_data["data"]["todays_donation_data"] )
                                                    {
                                                        foreach( $dashboard_data["data"]["todays_donation_data"] as $dashboard_donation_data_list )
                                                        {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $dashboard_donation_data_list["ngo_payment_data_campaign_id"]; ?></td>
                                                                    <td><?php echo $dashboard_donation_data_list["ngo_payment_data_campaign_title"]; ?></td>                                                                  
                                                                    <td><?php echo number_format($dashboard_donation_data_list["ngo_payment_data_donation_amount"], 2); ?></td>
                                                                    <td><?php echo $dashboard_donation_data_list["total_donors"]; ?></td> 
                                                                    <!-- <td><a href='javascript:void()' class='btn btn-success btn-sm'>Detail</a></td> -->
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                ?>                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="border-bottom-0">Campaign ID</th>
                                                    <th class="border-bottom-0">Campaign Title</th>
                                                    <th class="border-bottom-0">Total Donation</th>
                                                    <th class="border-bottom-0">Total Donors</th>
                                                    <!-- <th class="border-bottom-0">Status</th> -->
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--app-content end-->