$(document).ready(function() {
    let baseUrl = $("body").data("baseurl");
    $('#frmlogin').parsley();
    $("body").on("submit", "#frmlogin", function (e) {
        e.preventDefault();

        if($('#frmlogin').parsley().isValid())
        {
            $.ajax({  
                type:"POST",  
                data: $('#frmlogin').serialize(),
                dataType: "json",
                async: false,
                url:baseUrl+"login",  
                beforeSend: function(data){  
                    $('#btnlogin').attr('disabled',true);
                    $('#btnlogin').val('Please Wait..');
                },
                success:function(data){  
                    if( data.status == "Success" )
                    {
                        notif({
                            msg: "<b>Whoa! </b> "+data.msg,
                            type: "success"
                        });
                        setTimeout(function() {
                            window.location = baseUrl+"dashboard";
                        }, 3000);
                    }
                    else
                    {
                        $('#btnlogin').attr('disabled',false);
                        $('#btnlogin').val('Submit');
                        notif({
                            msg: "<b>Oops! </b>"+data.msg,
                            type: "error"
                        });
                    }
                }
            });
        }
    });

    $("body").on('change','.campaignstatus', function(event) {
        event.preventDefault();
        let campaign_status = $(this).val();
        if( campaign_status != "" )
        {
            if (confirm('Are you sure to update status?')) {
                
                let campaign_id = $(this).data("campaign-id");
                jQuery.ajax({
                    url: $("#file-datatable").data("tableid")+"update-campaign-social-status",
                    data: {'action':'actUpdateCampaignStatus', "campaign_id":campaign_id, "campaign_status":campaign_status},
                    type: "POST",
                    dataType : "json",
                    crossDomain: true,
                    headers: {
                    "Authorization": "Basic dHJ1ZV9ob3BlX2FwaV91c2VyOlRydWVAQEBIb3BlIyMjMTIz"
                    },
                    beforeSend: function(data){  

                    },
                    success: function(data)
                    {
                        if( data.status == true )
                        {
                            notif({
                                msg: "<b>Whoa! </b> "+data.msg,
                                type: "success"
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                        else
                        {
                            notif({
                                msg: "<b>Oops! </b>"+data.msg,
                                type: "error"
                            });
                        }
                    }
                });
            }
        }
    });

    $("#frmetdatewisedonationrecords").parsley();
    jQuery("body").on('submit', '#frmetdatewisedonationrecords', function(event) {
        event.preventDefault();
        let fromdate   = jQuery("#mapfromdate").val();
        let todate     = jQuery("#maptodate").val();
        let term_id    = jQuery("#term_id").val();
        var baseUrl = $("#file-datatable").data("tableid")+"get-datewise-donation-campaign-data-between-dates";
        jQuery.ajax({
            url: baseUrl,
            data: {'action':'getDatewiseDonationCampaignDataBetweenDates', "mapfromdate":fromdate, "maptodate":todate, "term_id":term_id},
            type: "POST",
            dataType : "json",
            crossDomain: true,
            headers: {
            "Authorization": "Basic dHJ1ZV9ob3BlX2FwaV91c2VyOlRydWVAQEBIb3BlIyMjMTIz"
            },
            beforeSend: function(data){  
                jQuery("#btngetdatewisedonationrecords").val('Please Wait...');
                jQuery("#btngetdatewisedonationrecords").attr("disabled", true);
            },
            success: function(data)
            {
                jQuery("#btngetdatewisedonationrecords").val('Fetch Records');
                jQuery("#btngetdatewisedonationrecords").attr("disabled", false);
                if( data.status == true )
                {
                    notif({
                        msg: "<b>Whoa! </b> "+data.msg,
                        type: "success"
                    });

                    let dataTable = $("#file-datatable").DataTable();
                    dataTable.clear().draw();
                    jQuery.each(data.data.campaign_donation_data, function(index, value) 
                    {
                        console.log(value);

                        // var status = "";
                        // if( value.ngo_payment_data_status == "1" )
                        // {
                        //     status = "Paid";
                        // }
                        var approved,
                            nonapproved,
                            stopped;

                        if( value.campaign_sosical_status == "Approved" )
                        {
                            approved = "selected";
                        }
                        else if( value.campaign_sosical_status == "Non Approved" )
                        {
                            nonapproved = "selected";
                        }
                        else if( value.campaign_sosical_status == "Stopped" )
                        {
                            stopped = "selected";
                        }

                        var status = '<select class="form-control campaignstatus" data-campaign-id="'+value.campaign_id+'"><option value="">Select Status</option><option value="Approved" '+approved+'>Approved</option><option value="Non Approved" '+nonapproved+'>Non Approved</option><option value="Stopped" '+stopped+'>Stopped</option></select>';
                        var ngo_name = '';

                        var amount = parseFloat(value.fund_raised).toFixed(2);
                        var option = '<select class="form-control campaignoption" data-campaign-id="'+value.campaign_id+'"><option value="">Select Action</option><option value="Mark Urgent">Mark Urgent</option><option value="Mark Featured">Mark Featured</option><option value="Stopped">Medical emergency</option><option value="Stopped">Relaunch</option><option value="Stopped">Products</option><option value="Stopped">Campaign Update</option></select>';

                        dataTable.row.add([value.campaign_id, value.campaign_title, ngo_name, status, amount, value.created_date, option]);
                    });
                    dataTable.draw();
                }
            }
        });
    });
});