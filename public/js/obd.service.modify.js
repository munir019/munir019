jQuery(document).ready(function($){
        var cur = 1;
        var len = $('.obd-step-form').find('ul.obd-stpes').children('li').length;

    $('#common-service').on('click',function () {
        if($(this).is(':checked')){
            commonService = 1;
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').removeAttr('required');//#service_office_level, .service_officers
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').attr('disabled','disabled');//#service_office_level, .service_officers
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').css({'background':'#f7f7f7'});//#service_office_level, .service_officers
        }else{
            commonService = 0;
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').removeAttr('disabled');//#service_office_level, .service_officers
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').attr('required','required');//#service_office_level, .service_officers
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').css({'background':'none'});//#service_office_level, .service_officers
        }
    });

    $('#add-more-officers').on('click',function (e) {
        var service_officers_row = $('.office-list').clone();
        $('.service-officers-row').append(service_officers_row.html());
    });

    var service_fail_officers_row = '<input name="service_fail_officers[]" style="background: none" class="form-control service_fail_officers">';
    $('#add-more-fail-officers').on('click',function (e) {
        $('.service-fail-officers-row').append(service_fail_officers_row);
    });

    var service_rules_row = $('.service-rules-row').clone();
    $('#add-more-rules').on('click',function (e) {
        $('.service-rules-row').append(service_rules_row.html());
    });

    var echallan_row = $('.echallan-hide').clone();
    var er=1;
    $('#add-more-echallan').on('click',function (e) {
        var t = echallan_row.html();
        t = t.replace(/fixed-payment-e/g,'fixed-payment-e-'+er);
        $('.echallan-row').append(t);
        er = er + 1;
    });

    var own_office_payment_row = $('.own-office-hide').clone();
    var or=1;
    $('#add-more-own-office-payment').on('click',function (e) {
        var t = own_office_payment_row.html();
        t = t.replace(/fixed-payment-o/g,'fixed-payment-o-'+er);
        $('.own-office-payment-row').append(t);
        or = or + 1;
    });

    //$('#eChallan, #accountPay, #own-office-payment-panel').hide();

    $('#service-payment').on('click',function(){
        if($('#service-payment').is(':checked'))
            $('#auto-payment, #eChallan, #accountPay, #payment-with').show();
        else
            $('#auto-payment, #eChallan, #accountPay, #payment-with').hide();
    });

    $('#own-office-payment').on('click',function () {
        if($(this).is(':checked'))
            $('#own-office-payment-panel').show();
        else
            $('#own-office-payment-panel').hide();
    });

    $('.service_docs').on('click',function(){
        var p = $(this).parents('div.checkbox');
        if($(this).is(':checked'))
            p.find('.req').show();
        else
            p.find('.req').hide();
    });

    $('#service_type').change(function(){
        var val = $(this).val();
        var o = [];
        $.each(val,function(i,v){
            o.push(v);
        });

        if(($.inArray("1", o)!== -1 && $.inArray("3", o)!== -1) || ($.inArray("1", o)!== -1 && $.inArray("4", o)!== -1)){
            var p = $(this).parents('div.form-group');
            var l = p.find('.select2-selection__rendered li').length;
            p.find('.select2-selection__rendered li:nth-child('+(l-1)+')').remove();
            o = o.slice(0, -1);
            $(this).val(o);
            alert('Please select any one of নাগরিক / কর্মকর্তা-কর্মচারি বা সরকারি দপ্তর');
        }
        if(($.inArray("2", o)!== -1 && $.inArray("3", o)!== -1) || ($.inArray("2", o)!== -1 && $.inArray("4", o)!== -1)){
            var p = $(this).parents('div.form-group');
            var l = p.find('.select2-selection__rendered li').length;
            p.find('.select2-selection__rendered li:nth-child('+(l-1)+')').remove();
            o = o.slice(0, -1);
            $(this).val(o);
            alert('Please select any one of ব্যবসায়ী / কর্মকর্তা-কর্মচারি বা সরকারি দপ্তর');
        }
    });

    $('input[name="service_other_application"]').on('click',function(){
        if($('#eksheba-integration').is(':checked')){
            $('.others-url').hide();
            $('input[name="service_other_application_url"]').val('');
        }else if($('#eNothi-integration').is(':checked')){
            $('input[name="service_other_application_url"]').val('https://nothi.gov.bd');
        }else{
            $('.others-url').show();
            $('input[name="service_other_application_url"]').val('');
        }
    });

    $('#echallan-payment').on('click',function(){
        $('#accountPay').hide();
    });
    $('#ekpay-payment, #sonali-payment').on('click',function(){
        $('#accountPay').show();
    });
});