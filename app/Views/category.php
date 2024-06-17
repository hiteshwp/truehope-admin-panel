<!--app-content open-->
<?php
    setlocale(LC_MONETARY,"en_IN");
?>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Campaign Details</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" id="frmetdatewisedonationrecords">
                                <div class="row my-5">
                                    <div class="col-md-3">
                                            <span class="dashboardgetdatatexbox">From Date - <input type="date" class="form-control mapfromdate" id="mapfromdate" required/></span>
                                    </div>
                                    <div class="col-md-3">
                                            <span class="dashboardgetdatatexbox">To Date - <input type="date" class="form-control maptodate" id="maptodate" required/></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-success" id="btngetdatewisedonationrecords" value="Fetch Records">
                                        <input type="hidden" value="<?php echo $category_id; ?>" id="term_id">
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive export-table">
                                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100" data-tableid="<?php echo API_BASE_URL; ?>">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">Campaign ID</th>
                                                    <th class="border-bottom-0">Campaign Title</th>
                                                    <th class="border-bottom-0">NGO Name</th>
                                                    <th class="border-bottom-0">Status</th>
                                                    <th class="border-bottom-0">Fund Raised</th>
                                                    <th class="border-bottom-0">Created Date</th>
                                                    <th class="border-bottom-0">Option</th>
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
                                                                    <td><?php echo $dashboard_donation_data_list["campaign_id"]; ?></td>
                                                                    <td><?php echo $dashboard_donation_data_list["campaign_title"]; ?></td>                                                                  
                                                                    <td>&nbsp;</td>
                                                                    <td class="campaign_status_wrapper">
                                                                        <select class="form-control campaignstatus" data-campaign-id="<?php echo $dashboard_donation_data_list["campaign_id"]; ?>">
                                                                            <option value="">Select Status</option>
                                                                            <option value="Approved" <?php if($dashboard_donation_data_list["campaign_sosical_status"] == "Approved" ){ echo "selected"; } ?>>Approved</option>
                                                                            <option value="Non Approved" <?php if($dashboard_donation_data_list["campaign_sosical_status"] == "Non Approved" ){ echo "selected"; } ?>>Non Approved</option>
                                                                            <option value="Stopped" <?php if($dashboard_donation_data_list["campaign_sosical_status"] == "Stopped" ){ echo "selected"; } ?>>Stopped</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><?php echo number_format($dashboard_donation_data_list["fund_raised"], 2); ?></td>
                                                                    <td><?php echo date("d-m-Y", strtotime($dashboard_donation_data_list["created_date"])); ?></td> 
                                                                    <td class="campaign_option_wrapper">
                                                                        <select class="form-control campaignoption" data-campaign-id="<?php echo $dashboard_donation_data_list["campaign_id"]; ?>">
                                                                            <option value="">Select Action</option>
                                                                            <option value="Mark Urgent">Mark Urgent</option>
                                                                            <option value="Mark Featured">Mark Featured</option>
                                                                            <option value="Stopped">Medical emergency</option>
                                                                            <option value="Stopped">Relaunch</option>
                                                                            <option value="Stopped">Products</option>
                                                                            <option value="Stopped">Campaign Update</option>
                                                                        </select>
                                                                    </td>
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
                                                    <th class="border-bottom-0">NGO Name</th>
                                                    <th class="border-bottom-0">Status</th>
                                                    <th class="border-bottom-0">Fund Raised</th>
                                                    <th class="border-bottom-0">Created Date</th>
                                                    <th class="border-bottom-0">Option</th>
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