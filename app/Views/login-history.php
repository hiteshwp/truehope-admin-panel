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
                            <h3 class="card-title">User Login History - <?php echo $user_data["user_first_name"]." ".$user_data["user_last_name"]; ?></h3>
                            <a href="<?php echo base_url("user-list"); ?>" class="btn btn-danger ms-auto pageheader-btn">Back to User List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive export-table">
                                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100" data-tableid="<?php echo API_BASE_URL; ?>">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">User Id</th>
                                                    <th class="border-bottom-0">IP Address</th>
                                                    <th class="border-bottom-0">Platform</th>
                                                    <th class="border-bottom-0">Logged In Time</th>
                                                    <th class="border-bottom-0">Logged Out Time</th>
                                                    <th class="border-bottom-0">User Status</th>
                                                    <th class="border-bottom-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if( $user_activity_data )
                                                    {
                                                        foreach( $user_activity_data as $user_activity_data_list )
                                                        {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $user_activity_data_list["user_activities_id"]; ?></td>
                                                                    <td><?php echo $user_activity_data_list["user_ip_address"]; ?></td>
                                                                    <td><?php echo $user_activity_data_list["user_platform"]; ?></td>
                                                                    <td><?php echo date("d-m-Y h:i A", strtotime($user_activity_data_list["created_at"])); ?></td>
                                                                    <td><?php if( $user_activity_data_list["updated_at"] != "" ){ echo date("d-m-Y h:i A", strtotime($user_activity_data_list["updated_at"])); } ?></td>
                                                                    <td><?php if( $user_activity_data_list["user_activities_status"] == 1 ){ echo '<span class="badge rounded-pill bg-success-gradient me-1">Online</span>'; }else{ echo '<span class="badge rounded-pill bg-danger-gradient me-1">Offline</span>'; } ?></td>
                                                                    <td><?php if( $user_activity_data_list["user_activities_status"] == 1 ){ echo '<a class="btn btn-danger btn-sm userloggout" data-useractivity-id="'.$user_activity_data_list["user_activities_id"].'" href="javascript:void(0);">Logout</a>'; } ?></td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                ?>                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="border-bottom-0">User Id</th>
                                                    <th class="border-bottom-0">IP Address</th>
                                                    <th class="border-bottom-0">Platform</th>
                                                    <th class="border-bottom-0">Logged In Time</th>
                                                    <th class="border-bottom-0">Logged Out Time</th>
                                                    <th class="border-bottom-0">Status</th>
                                                    <th class="border-bottom-0">Action</th>
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