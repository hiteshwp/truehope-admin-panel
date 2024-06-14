</div>

            <!-- FOOTER -->
            <footer class="footer">
                <div class="container">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-md-12 col-sm-12 text-center">
                            Copyright © <?php echo date("Y"); ?> <a href="javascript:void(0);"><?php echo SITE_TITLE; ?></a> | Designed & Developed by <a href="https://www.webintoto.com"> Webintoto </a> | All rights reserved
                        </div>
                    </div>
                </div>
            </footer>
            <!-- FOOTER END -->
        </div>

        <!-- BACK-TO-TOP -->
        <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

        <!-- JQUERY JS -->
        <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>

        <!-- BOOTSTRAP JS -->
        <script src="<?php echo base_url("assets/plugins/bootstrap/js/popper.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js"); ?>"></script>

        <!-- SPARKLINE JS-->
        <script src="<?php echo base_url("assets/js/jquery.sparkline.min.js"); ?>"></script>

        <!-- CHART-CIRCLE JS-->
        <script src="<?php echo base_url("assets/js/circle-progress.min.js"); ?>"></script>

        <!-- CHARTJS CHART JS-->
        <script src="<?php echo base_url("assets/plugins/chart/Chart.bundle.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/chart/utils.js"); ?>"></script>

        <!-- BOOTSTRAP-DATERANGEPICKER JS -->
		<script src="<?php echo base_url("assets/plugins/bootstrap-daterangepicker/moment.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/bootstrap-daterangepicker/daterangepicker.js"); ?>"></script>

		<!-- INTERNAL Bootstrap-Datepicker js-->
		<script src="<?php echo base_url("assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"); ?>"></script>

        <!-- TIMEPICKER JS -->
		<script src="<?php echo base_url("assets/plugins/time-picker/jquery.timepicker.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/time-picker/toggles.min.js"); ?>"></script>

        <script src="<?php echo base_url("assets/plugins/date-picker/date-picker.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/date-picker/jquery-ui.js"); ?>"></script>

        <!-- PIETY CHART JS-->
        <script src="<?php echo base_url("assets/plugins/peitychart/jquery.peity.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/peitychart/peitychart.init.js"); ?>"></script>

        <!-- INTERNAL Data tables js-->
        <script src="<?php echo base_url("assets/plugins/datatable/js/jquery.dataTables.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/datatable/js/dataTables.bootstrap5.js"); ?>"></script>
        <script src="<?php echo base_url("assets/plugins/datatable/dataTables.responsive.min.js"); ?>"></script>

        <!-- ECHART JS-->
        <script src="<?php echo base_url("assets/plugins/echarts/echarts.js"); ?>"></script>

        <!-- SIDE-MENU JS-->
        <script src="<?php echo base_url("assets/plugins/sidemenu/sidemenu.js"); ?>"></script>

        <!-- Sticky js -->
        <script src="<?php echo base_url("assets/js/sticky.js"); ?>"></script>

        <!-- CHARTJS JS -->
		<script src="<?php echo base_url("assets/plugins/chart/Chart.bundle.js"); ?>"></script>
		<!-- <script src="<?php echo base_url("assets/js/chart.js"); ?>"></script> -->

        <!-- DATA TABLE JS-->
		<script src="<?php echo base_url("assets/plugins/datatable/js/jquery.dataTables.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/js/dataTables.bootstrap5.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/js/dataTables.buttons.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/js/buttons.bootstrap5.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/js/jszip.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/pdfmake/pdfmake.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/pdfmake/vfs_fonts.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/js/buttons.html5.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/js/buttons.print.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/js/buttons.colVis.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/dataTables.responsive.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/datatable/responsive.bootstrap5.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/js/table-data.js"); ?>"></script>

        <!-- SWEET-ALERT JS -->
		<script src="<?php echo base_url("assets/plugins/sweet-alert/sweetalert.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/js/sweet-alert.js"); ?>"></script>

        <!-- SIDEBAR JS -->
        <script src="<?php echo base_url("assets/plugins/sidebar/sidebar.js"); ?>"></script>

        <!-- APEXCHART JS -->
        <script src="<?php echo base_url("assets/js/apexcharts.js"); ?>"></script>

        <!-- NOTIFY JS -->
        <script src="<?php echo base_url("assets/plugins/notify/js/notifIt.js"); ?>"></script>

        <!-- INDEX JS -->
        <script src="<?php echo base_url("assets/js/index1.js"); ?>"></script>

		<script src="<?php echo base_url("assets/js/form-elements.js"); ?>"></script>

        <!-- CUSTOM JS -->
        <script src="<?php echo base_url("assets/js/custom.js"); ?>"></script>

        <!-- PARSLEY JS -->
        <script src="<?php echo base_url("assets/js/parsley.js"); ?>"></script>

        <!-- AJAX JS -->
        <script src="<?php echo base_url("assets/js/ajax.js"); ?>"></script>

        <?php if(session()->getFlashdata('login-success')):?>
         <script type="text/javascript">
             $(document).ready(function() {
               let msg = "<?php echo session()->getFlashdata('login-success') ?>";
               notif({
                    msg: "<b>Whoa! </b> "+msg,
                    type: "success"
                });
             });
         </script>
     <?php endif;?>
    
    <?php
        $router = service('router');
        $controller  = $router->controllerName();
        $method = $router->methodName();

        if( $controller == "\App\Controllers\DashboardController" && $method == "index" ) 
        {
            ?>
                <script type="text/javascript">
                    $(document).ready(function () 
                    {
                        let ctx = document.getElementById("chartBar2");
                        let myChart;
                        var baseUrl = "<?php echo API_BASE_URL.'dashboard'; ?>";
                        $.ajax({
                            url: baseUrl,
                            data: {'action':'getTotalGraphData'},
                            type: "POST",
                            dataType : "json",
                            crossDomain: true,
                            headers: {
                            "Authorization": "Basic dHJ1ZV9ob3BlX2FwaV91c2VyOlRydWVAQEBIb3BlIyMjMTIz"
                            },
                            success: function(data)
                            {
                                if( data.status == true )
                                {
                                    myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: data.data.graph_data.graph_month_data,
                                            datasets: [{
                                                label: "Donations",
                                                data: data.data.graph_data.graph_donation_data,
                                                borderColor: "#000",
                                                borderWidth: "0",
                                                backgroundColor: "#000"
                                            }, {
                                                label: "Donors",
                                                data: data.data.graph_data.graph_donnor_data,
                                                borderColor: "#f31816",
                                                borderWidth: "0",
                                                backgroundColor: "#f31816"
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                xAxes: [{
                                                    ticks: {
                                                        fontColor: "#77778e",
                                                    },
                                                    gridLines: {
                                                        color: 'rgba(119, 119, 142, 0.2)'
                                                    }
                                                }],
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true,
                                                        fontColor: "#77778e",
                                                    },
                                                    gridLines: {
                                                        color: 'rgba(119, 119, 142, 0.2)'
                                                    },
                                                }]
                                            },
                                            legend: {
                                                labels: {
                                                    fontColor: "#77778e"
                                                },
                                            },
                                        }
                                    });
                                }
                            }
                        });

                        //jQuery("body").on('click', '#btngetdatewiserecords', function(event) {
                        $("#frmgetdatabetweendates").parsley();
                        jQuery("body").on('submit', '#frmgetdatabetweendates', function(event) {
                            event.preventDefault();
                            let fromdate   = jQuery("#mapfromdate").val();
                            let todate     = jQuery("#maptodate").val();
                            let thisData   = jQuery(this);
                            var baseUrl = jQuery("body").data("au")+"get-dashboard-data-between-dates";
                            jQuery.ajax({
                                url: baseUrl,
                                data: {'action':'getTotalGraphDataByBetweenDates', "mapfromdate":fromdate, "maptodate":todate},
                                type: "POST",
                                dataType : "json",
                                crossDomain: true,
                                headers: {
                                "Authorization": "Basic dHJ1ZV9ob3BlX2FwaV91c2VyOlRydWVAQEBIb3BlIyMjMTIz"
                                },
                                beforeSend: function(data){  
                                    jQuery("#btngetdatewiserecords").val('Please Wait...');
                                    jQuery("#btngetdatewiserecords").attr("disabled", true);
                                },
                                success: function(data)
                                {
                                    jQuery("#btngetdatewiserecords").val('Fetch Records');
                                    jQuery("#btngetdatewiserecords").attr("disabled", false);
                                    if( data.status == true )
                                    {
                                        notif({
                                            msg: "<b>Whoa! </b> "+data.msg,
                                            type: "success"
                                        });
                                        if (myChart) {
                                            myChart.destroy();
                                        }
                                        myChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: data.data.map_records.dates,
                                                datasets: [{
                                                    label: "Donations",
                                                    data: data.data.map_records.date_amount,
                                                    borderColor: "#000",
                                                    borderWidth: "0",
                                                    backgroundColor: "#000"
                                                }, {
                                                    label: "Donors",
                                                    data: data.data.map_records.date_donors,
                                                    borderColor: "#f31816",
                                                    borderWidth: "0",
                                                    backgroundColor: "#f31816"
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                scales: {
                                                    xAxes: [{
                                                        ticks: {
                                                            fontColor: "#77778e",
                                                        },
                                                        gridLines: {
                                                            color: 'rgba(119, 119, 142, 0.2)'
                                                        }
                                                    }],
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true,
                                                            fontColor: "#77778e",
                                                        },
                                                        gridLines: {
                                                            color: 'rgba(119, 119, 142, 0.2)'
                                                        },
                                                    }]
                                                },
                                                legend: {
                                                    labels: {
                                                        fontColor: "#77778e"
                                                    },
                                                },
                                            }
                                        });
                                        myChart.render();

                                        let dataTable = $("#file-datatable").DataTable();
                                        dataTable.clear().draw();
                                        jQuery.each(data.data.donation_data, function(index, value) 
                                        {
                                            console.log(value);

                                            // var date = new Date(value.created_at);
                                            // var transactiondate = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '-' + date.getFullYear();

                                            // var status = "";
                                            // if( value.ngo_payment_data_status == "1" )
                                            // {
                                            //     status = "Paid";
                                            // }

                                            var status = "<a href='javascript:void()' class='btn btn-success btn-sm'>Detail</a>";

                                            var amount = parseFloat(value.ngo_payment_data_donation_amount).toFixed(2);

                                            dataTable.row.add([value.ngo_payment_data_campaign_id, value.ngo_payment_data_campaign_title, amount, value.total_donors, status]);
                                        });
                                        dataTable.draw();
                                    }
                                }
                            });
                        });
                    });
                </script>
            <?php
        }
    ?>
    </body>

</html>