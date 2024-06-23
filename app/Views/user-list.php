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
                            <h3 class="card-title">Manage User</h3>
                            <a href="javascript:void(0);" class="btn btn-danger ms-auto pageheader-btn" data-bs-toggle="modal" data-bs-target="#newusermodel">Create New User</a>
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
                                                    <th class="border-bottom-0">First Name</th>
                                                    <th class="border-bottom-0">Last Name</th>
                                                    <th class="border-bottom-0">Email Address</th>
                                                    <th class="border-bottom-0">User Role</th>
                                                    <th class="border-bottom-0">Login History</th>
                                                    <th class="border-bottom-0">Status</th>
                                                    <th class="border-bottom-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if( $user_data )
                                                    {
                                                        foreach( $user_data as $user_data_list )
                                                        {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $user_data_list["user_id"]; ?></td>
                                                                    <td><?php echo $user_data_list["user_first_name"]; ?></td>
                                                                    <td><?php echo $user_data_list["user_last_name"]; ?></td>
                                                                    <td><?php echo $user_data_list["user_email_id"]; ?></td>
                                                                    <td><?php if( $user_data_list["user_role"] == 1 ){ echo "Admin User"; }else{ echo "Normal User"; } ?></td>
                                                                    <td><a class="btn btn-info btn-sm" href="<?php echo base_url("/user-list/login-history/").$user_data_list["user_id"]; ?>">View History</a></td>
                                                                    <td><?php if( $user_data_list["user_status"] == 1 ){ echo '<span class="badge rounded-pill bg-success-gradient me-1 ">Active</span>'; }else{ echo '<span class="badge rounded-pill bg-danger-gradient me-1 ">Deactive</span>'; } ?></td>
                                                                    <td><a class="btn btn-success btn-sm btneditusermodal" data-userid="<?php echo $user_data_list["user_id"]; ?>" data-firstname="<?php echo $user_data_list["user_first_name"]; ?>" data-lastname="<?php echo $user_data_list["user_last_name"]; ?>" data-email="<?php echo $user_data_list["user_email_id"]; ?>" data-role="<?php echo $user_data_list["user_role"]; ?>" data-status="<?php echo $user_data_list["user_status"]; ?>" data-bs-toggle="modal" data-bs-target="#editusermodel" href="javascript:void(0);">Edit</a>&nbsp;<a class="btn btn-warning btn-sm btnuserdeactive" data-userid="<?php echo $user_data_list["user_id"]; ?>" href="javascript:void(0);">Deactive</a></td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                ?>                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="border-bottom-0">User Id</th>
                                                    <th class="border-bottom-0">First Name</th>
                                                    <th class="border-bottom-0">Last Name</th>
                                                    <th class="border-bottom-0">Email Address</th>
                                                    <th class="border-bottom-0">User Role</th>
                                                    <th class="border-bottom-0">Login History</th>
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

<div class="modal fade" id="newusermodel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <form method="post" id="frmcreatenewuser">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New user details</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" id="userfirstname" name="userfirstname" placeholder="Enter first name" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" id="userlastname" name="userlastname" placeholder="Enter last name" required/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control" id="useremailaddress" name="useremailaddress" placeholder="Enter email address" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="******" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>User Role</label>
                                <select name="userrole" id="userrole" class="form-control" required>
                                    <option value="">Select role</option>
                                    <option value="1">Admin User</option>
                                    <option value="2">Normal User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit" id="btnsaveuser">Save User</button>
                    <input type="hidden" name="action" value="actStoreUserData"/>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editusermodel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <form method="post" id="frmupdatenewuser">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update user details</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" id="updateuserfirstname" name="userfirstname" placeholder="Enter first name" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" id="updateuserlastname" name="userlastname" placeholder="Enter last name" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>User Status</label>
                                <select name="userstatus" id="updateuserstatus" class="form-control" required>
                                    <option value="">Select status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control" id="updateuseremailaddress" name="useremailaddress" placeholder="Enter email address" readonly/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="updateuserpassword" name="userpassword" placeholder="******"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>User Role</label>
                                <select name="userrole" id="updateuserrole" class="form-control" required>
                                    <option value="">Select role</option>
                                    <option value="1">Admin User</option>
                                    <option value="2">Normal User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit" id="btnupdateuser">Update User</button>
                    <input type="hidden" name="action" value="actUpdateUserData"/>
                    <input type="hidden" name="updateuserid" id="updateuserid" value=""/>
                </div>
            </div>
        </form>
    </div>
</div>