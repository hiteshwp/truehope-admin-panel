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
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form method="post" id="frmchangepassword">
                                    <div class="col-md-12">
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="text" class="form-control" id="useremailaddress" name="useremailaddress" placeholder="Enter email address" readonly/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control" id="usernewpassword" name="usernewpassword" placeholder="******" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Retype Password</label>
                                                    <input type="password" class="form-control" id="userretypepassword" name="userretypepassword" placeholder="******" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-success" type="submit" id="btnupdateprofile">Update Profile</button>
                                                <input type="hidden" name="user_type" value=""/>
                                                <input type="hidden" name="user_id" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>