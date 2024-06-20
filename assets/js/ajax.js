jQuery(document).ready(function() {
    let baseUrl = jQuery("body").data("baseurl");
    jQuery('#frmlogin').parsley();
    jQuery("body").on("submit", "#frmlogin", function (e) {
        e.preventDefault();

        if(jQuery('#frmlogin').parsley().isValid())
        {
            jQuery.ajax({  
                type:"POST",  
                data: jQuery('#frmlogin').serialize(),
                dataType: "json",
                async: false,
                url:baseUrl+"login",  
                beforeSend: function(data){  
                    jQuery('#btnlogin').attr('disabled',true);
                    jQuery('#btnlogin').val('Please Wait..');
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
                        jQuery('#btnlogin').attr('disabled',false);
                        jQuery('#btnlogin').val('Submit');
                        notif({
                            msg: "<b>Oops! </b>"+data.msg,
                            type: "error"
                        });
                    }
                }
            });
        }
    });

    jQuery("body").on('change','.campaignstatus', function(event) {
        event.preventDefault();
        let campaign_status = jQuery(this).val();
        if( campaign_status != "" )
        {
            if (confirm('Are you sure to update status?')) {
                
                let campaign_id = jQuery(this).data("campaign-id");
                jQuery.ajax({
                    url: jQuery("#file-datatable").data("tableid")+"update-campaign-social-status",
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

    jQuery("#frmetdatewisedonationrecords").parsley();
    jQuery("body").on('submit', '#frmetdatewisedonationrecords', function(event) {
        event.preventDefault();
        let fromdate   = jQuery("#mapfromdate").val();
        let todate     = jQuery("#maptodate").val();
        let term_id    = jQuery("#term_id").val();
        var baseUrl = jQuery("#file-datatable").data("tableid")+"get-datewise-donation-campaign-data-between-dates";
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

                    let dataTable = jQuery("#file-datatable").DataTable();
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

    jQuery("body").on('change','.campaignoption', function(event) {
        event.preventDefault();
        let selectedValue = jQuery(this).val();
        if( selectedValue == "Details" )
        {
            let campaign_id = jQuery(this).data("campaign-id");
            jQuery.ajax({
                url: jQuery("#file-datatable").data("tableid")+"update-campaign-by-taxonomy",
                data: {'action':'actUpdateCampaignByTaxonomy', "campaign_id":campaign_id, "selectedValue":selectedValue, },
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
                        console.log(data);
                        jQuery("#modal_ngoname").val(data.data.ngo_name);
                        jQuery("#modal_emailaddress").val(data.data.ngo_email);
                        jQuery("#modal_managername").val(data.data.ngo_manager_name);
                        jQuery("#modal_mobilenumber").val(data.data.ngo_mobile_no);
                        jQuery("#modal_address").val(data.data.ngo_address);
                        jQuery('#detailmodel').modal('show');
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
        else if( selectedValue == "Featured" || selectedValue == "Relaunch" )
        {
            if (confirm('Are you sure to '+selectedValue+' this campaign?')) 
            {
                let campaign_id = jQuery(this).data("campaign-id");
                jQuery.ajax({
                    url: jQuery("#file-datatable").data("tableid")+"update-campaign-by-taxonomy",
                    data: {'action':'actUpdateCampaignByTaxonomy', "campaign_id":campaign_id, "selectedValue":selectedValue, },
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
        else if( selectedValue == "Products" )
        {
            let campaign_id = jQuery(this).data("campaign-id");
            jQuery.ajax({
                url: jQuery("#file-datatable").data("tableid")+"update-campaign-by-taxonomy",
                data: {'action':'actUpdateCampaignByTaxonomy', "campaign_id":campaign_id, "selectedValue":selectedValue, },
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
                        console.log(data);
                        jQuery("#productlisttable").html(data.data.product_list);
                        jQuery('#productsmodel').modal('show');
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
        else if( selectedValue == "Campaign Update" )
        {
            let campaign_id = jQuery(this).data("campaign-id");
            jQuery('#campaignupdate').modal('show');
            jQuery(".campaign_id").val(campaign_id);
        }
        else
        {
            if (confirm('Are you sure to update campaign category?')) 
            { 
                let campaign_id = jQuery(this).data("campaign-id");
                jQuery.ajax({
                    url: jQuery("#file-datatable").data("tableid")+"update-campaign-by-taxonomy",
                    data: {'action':'actUpdateCampaignByTaxonomy', "campaign_id":campaign_id, "selectedValue":selectedValue, },
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

    jQuery('#frmupdateproducts').parsley();
    jQuery("body").on("submit", "#frmupdateproducts", function (e) {
        e.preventDefault();

        if(jQuery('#frmupdateproducts').parsley().isValid())
        {
            jQuery.ajax({  
                type:"POST",  
                data: jQuery('#frmupdateproducts').serialize(),
                dataType: "json",
                async: false,
                crossDomain: true,
                headers: {
                "Authorization": "Basic dHJ1ZV9ob3BlX2FwaV91c2VyOlRydWVAQEBIb3BlIyMjMTIz"
                },
                url:jQuery("#file-datatable").data("tableid")+"update-campaign-product-list",
                beforeSend: function(data){  
                    jQuery('.updateproducts').attr('disabled',true);
                    jQuery('.updateproducts').text('Please Wait..');
                },
                success:function(data){  
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
                        jQuery('.updateproducts').attr('disabled',false);
                        jQuery('.updateproducts').text('Update Products');
                        notif({
                            msg: "<b>Oops! </b>"+data.msg,
                            type: "error"
                        });
                    }
                }
            });
        }
    });

    jQuery("body").on("change", ".mediatype", function (e) {
        e.preventDefault();
        if( jQuery(this).val() == "Image" )
        {
            jQuery(".imagesection").slideDown();
            jQuery(".videosection").slideUp();
        }
        else if( jQuery(this).val() == "Video" )
        {
            jQuery(".videosection").slideDown();
            jQuery(".imagesection").slideUp();
        }
        else
        {
            jQuery(".videosection").slideUp();
            jQuery(".imagesection").slideUp();
        }
    });

    jQuery('#frmstorecampaignupdates').parsley();
    jQuery("body").on("submit", "#frmstorecampaignupdates", function (e) {
        e.preventDefault();

        if(jQuery('#frmstorecampaignupdates').parsley().isValid())
        {
            let formData = new FormData(this);
            jQuery.ajax({  
                type:"POST",  
                data: formData,
                dataType: "json",
                async: false,
                crossDomain: true,
                cache:false,
                contentType: false,
                processData: false,
                headers: {
                "Authorization": "Basic dHJ1ZV9ob3BlX2FwaV91c2VyOlRydWVAQEBIb3BlIyMjMTIz"
                },
                url:jQuery("#file-datatable").data("tableid")+"store-campaign-update",
                beforeSend: function(data){  
                    jQuery('.savecampaignupdate').attr('disabled',true);
                    jQuery('.savecampaignupdate').text('Please Wait..');
                },
                success:function(data){  
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
                        jQuery('.savecampaignupdate').attr('disabled',false);
                        jQuery('.savecampaignupdate').text('Save Update');
                        notif({
                            msg: "<b>Oops! </b>"+data.msg,
                            type: "error"
                        });
                    }
                }
            });
        }
    });

    jQuery('#frmcreatenewuser').parsley();
    jQuery("body").on("submit", "#frmcreatenewuser", function (e) {
        e.preventDefault();

        if(jQuery('#frmcreatenewuser').parsley().isValid())
        {
            jQuery.ajax({  
                type:"POST",  
                data: jQuery('#frmcreatenewuser').serialize(),
                dataType: "json",
                async: false,
                url:baseUrl+"create-user",  
                beforeSend: function(data){  
                    jQuery('#btnsaveuser').attr('disabled',true);
                    jQuery('#btnsaveuser').text('Please Wait..');
                },
                success:function(data){  
                    if( data.status == "Success" )
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
                        jQuery('#btnsaveuser').attr('disabled',false);
                        jQuery('#btnsaveuser').text('Save User');
                        notif({
                            msg: "<b>Oops! </b>"+data.msg,
                            type: "error"
                        });
                    }
                }
            });
        }
    });
    
});