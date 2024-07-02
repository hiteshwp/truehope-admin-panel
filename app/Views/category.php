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
                                                    <th class="border-bottom-0">Campaign Status</th>
                                                    <th class="border-bottom-0">Fund Raised</th>
                                                    <th class="border-bottom-0">Created Date</th>
                                                    <th class="border-bottom-0">Campaign Option</th>
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
                                                                        <?php
                                                                            if( $curUserData["login_type"] != "Normal User" )
                                                                            {
                                                                                ?>
                                                                                    <select class="form-control campaignstatus" data-campaign-id="<?php echo $dashboard_donation_data_list["campaign_id"]; ?>">
                                                                                        <option value="">Select Status</option>
                                                                                        <option value="Approved" <?php if($dashboard_donation_data_list["campaign_sosical_status"] == "Approved" ){ echo "selected"; } ?>>Approved</option>
                                                                                        <option value="Non Approved" <?php if($dashboard_donation_data_list["campaign_sosical_status"] == "Non Approved" ){ echo "selected"; } ?>>Non Approved</option>
                                                                                        <option value="Stopped" <?php if($dashboard_donation_data_list["campaign_sosical_status"] == "Stopped" ){ echo "selected"; } ?>>Stopped</option>
                                                                                    </select>
                                                                                <?php
                                                                            } 
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo number_format($dashboard_donation_data_list["fund_raised"], 2); ?></td>
                                                                    <td><?php echo date("d-m-Y", strtotime($dashboard_donation_data_list["created_date"])); ?></td> 
                                                                    <td class="campaign_option_wrapper">
                                                                    <?php
                                                                        if( $curUserData["login_type"] != "Normal User" )
                                                                        {
                                                                            ?>
                                                                                <select class="form-control campaignoption" data-campaign-id="<?php echo $dashboard_donation_data_list["campaign_id"]; ?>">
                                                                                    <option value="">Select Action</option>
                                                                                    <option value="Details">Details</option>
                                                                                    <option value="5">Mark Urgent</option>
                                                                                    <option value="Featured">Mark Featured</option>
                                                                                    <option value="14">Medical emergency</option>
                                                                                    <option value="Relaunch">Relaunch</option>
                                                                                    <option value="Products">Products</option>
                                                                                    <option value="Campaign Update">Campaign Update</option>
                                                                                </select>
                                                                            <?php
                                                                        } 
                                                                    ?>
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
                                                    <th class="border-bottom-0">Campaign Status</th>
                                                    <th class="border-bottom-0">Fund Raised</th>
                                                    <th class="border-bottom-0">Created Date</th>
                                                    <th class="border-bottom-0">Campaign Option</th>
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

<div class="modal fade" id="detailmodel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">NGO Details</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>NGO Name</label>
                            <input type="text" class="form-control" id="modal_ngoname"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NGO Email address</label>
                            <input type="text" class="form-control" id="modal_emailaddress"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NGO Manager Name</label>
                            <input type="text" class="form-control" id="modal_managername"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NGO Mobile no</label>
                            <input type="text" class="form-control" id="modal_mobilenumber"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>NGO Address</label>
                            <input type="text" class="form-control" id="modal_address"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="productsmodel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <form method="post" id="frmupdateproducts">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Campaign Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="productlisttable"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success updateproducts">Updte Products</button>
                    <input type="hidden" name="action" value="actUpdateCampaignProduct"/>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="campaignupdate" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl " role="document">
        <form method="post" id="frmstorecampaignupdates">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Insert Campaign Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Update Title</label>
                                <input type="text" class="form-control" name="updatetitle" placeholder="Enter update title" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Media type</label>
                                <select class="form-control mediatype" name="mediatype" required>
                                    <option value="">Select type</option>
                                    <option value="Image">Image</option>
                                    <option value="Video">Video</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 imagesection" style="display:none">
                            <div class="form-group">
                                <label>Select image</label>
                                <input type="file" class="form-control" name="updateimage"/>
                            </div>
                        </div>
                        <div class="col-md-12 videosection" style="display:none">
                            <div class="form-group">
                                <label>Video url</label>
                                <input type="text" class="form-control" name="videourl" placeholder="Enter video url"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Section Content</label>
                                <textarea class="content" name="sectioncontent" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success savecampaignupdate">Save Update</button>
                    <input type="hidden" name="action" value="actStoreCampaignUpdate"/>
                    <input type="hidden" class="campaign_id" name="campaign_id" value=""/>
                </div>
            </div>
        </form>
    </div>
</div>