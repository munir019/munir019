jQuery(document).ready(function($){

    var commonService = 0;

    $('#common-service').on('click',function () {
        if($(this).is(':checked')){
            commonService = 1;
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').removeAttr('required');//#service_office_level,.service_officers
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').attr('disabled','disabled');//#service_office_level, .service_officers
        }else{
            commonService = 0;
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').removeAttr('disabled');//#service_office_level, .service_officers
            $('#ministry, #office_layer, #office_origin, #office_origin_unit').attr('required','required');//#service_office_level, .service_officers
        }
    });

    if($('.obd-step-form').is(':visible')) {

        $('.obd-step-form').find('.obd-next-btn');
        $('.obd-step-form').find('.obd-previous-btn').hide();
        $('.obd-step-form').find('.obd-submit-btn').hide();

        $('.obd-step-form').find('ul.obd-stpes li:first-child').addClass('active');
        $('.obd-step-form').find('.obd-content').children('section').hide();
        $('.obd-step-form').find('.obd-content section:first-child').show();

        //$('.obd-step-form').find('.obd-content section:first-child').hide();
        //$('.obd-step-form').find('.obd-content section:nth-child(3)').show();

        var cur = 1;
        var len = $('.obd-step-form').find('ul.obd-stpes').children('li').length;

        $('.obd-step-form').find('.obd-next-btn').on('click',function(){
            form.validate().settings.ignore = ":disabled,:hidden";
            if(form.valid()) {
                $('.obd-step-form').find('ul.obd-stpes li:nth-child(' + cur + ')').attr('class', 'active-green');
                $('.obd-step-form').find('.obd-content section:nth-child(' + cur + ')').hide();
                cur = cur + 1;

                $('.obd-step-form').find('ul.obd-stpes li:nth-child(' + cur + ')').attr('class', 'active');
                $('.obd-step-form').find('.obd-content section:nth-child(' + cur + ')').show();

                if (cur > 1) $('.obd-step-form').find('.obd-previous-btn').show();
                else $('.obd-step-form').find('.obd-previous-btn').hide();

                if(cur==len) {
                    $('.obd-step-form').find('.obd-submit-btn').show();
                    $('.obd-step-form').find('.obd-next-btn').hide();
                    preview();
                }else
                    $('.obd-step-form').find('.obd-submit-btn').hide();

            }
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });

        function preview(){
            var i=0;
            var output = [];
            var pre = $('#preview');

            form.find('span.service_name').html(form.find('input.service_name').val());
            form.find('span.service_name_en').html(form.find('input.service_name_en').val());
            form.find('span.ministry').html(form.find('select.ministry').find(":selected").text());
            form.find('span.office_layer').html(form.find('select.office_layer').find(":selected").text());
            form.find('span.office_origin').html(form.find('select.office_origin').find(":selected").text());
            form.find('span.office_origin_unit').html(form.find('select.office_origin_unit').find(":selected").text());
            form.find('span.service_provider_office_name').html(form.find('input.service_provider_office_name').val());
            form.find('span.service_place').html(form.find('input.service_place').val());

            var t = '';
            form.find('select.service_type').find(":selected").each(function(){
                if(t!='')
                    t = t + ', ';
                t = t + $(this).text();
            });
            form.find('span.service_type').html(t);

            var t = '';
            form.find('select.service_sector').find(":selected").each(function(){
                if(t!='')
                    t = t + ', ';
                t = t + $(this).text();
            });
            form.find('span.service_sector').html(t);

            form.find('span.service_keyword').html(form.find('input.service_keyword').val());
            //form.find('span.service_office_level').html(form.find('select.service_office_level').find(":selected").text());
            form.find('input.service_common').hide();

            output = [];i=1;
            /*$('select.service_officers').each(function(){
                if($(this).val()!='') {
                    var t = $(this).find(":selected").text();
                    t = '<span>' + i + '. </span>' + t + ' (' + $(this).val() + ')';
                    output.push(t);
                    i = i + 1;
                }
            });
            $('span.service_officers').html(output.join('<br>'));*/

            form.find('div.service_common').hide();
            if(commonService == 1){
                form.find('span.ministry').html('Not Applicable');
                form.find('span.office_layer').html('Not Applicable');
                form.find('span.office_origin').html('Not Applicable');
                form.find('span.office_origin_unit').html('Not Applicable');
                form.find('span.service_provider_office_name').html('Not Applicable');
                //form.find('span.service_office_level').html('Not Applicable');
                //$('span.service_officers').html('Not Applicable');
                form.find('div.service_common').show();
            }

            output = [];i=1;
            $('input.service_fail_officers').each(function(){
                if($(this).val()!='') {
                    output.push('<span>' + i + '.</span> ' + $(this).val());
                    i = i + 1;
                }
            });
            $('span.service_fail_officers').html(output.join('<br>'));

            form.find('span.service_time_duration').html(form.find('input.service_time_duration').val());
            form.find('span.service_time_duration_details').html(form.find('textarea.service_time_duration_details').val());

            form.find('span.service_way_of_service').html(form.find('textarea.service_way_of_service').val());
            form.find('span.service_papers_available').html(form.find('textarea.service_papers_available').val());
            form.find('span.service_payment_details').html(form.find('textarea.service_payment_details').val());

            output = [];i=1;
            $('input.service_rules').each(function(){
                if($(this).val()!='') {
                    output.push('<span>' + i + '.</span> ' + $(this).val());
                    i = i + 1;
                }
            });
            $('span.service_rules').html(output.join('<br>'));

            output = [];i=1;
            $('input.service_docs').each(function(){
                if($(this).is(':checked')){
                    var t = '<span>' + i + '.</span> ' + $(this).attr('data-val');

                    if($('input.service_docs_req_'+$(this).attr('data-id')).is(':checked'))
                        t = t + '<span class="color-red">*</span>';

                    output.push(t);
                    i = i + 1;
                }
                /*if($(this).val()!='') {
                    output.push('<span>' + i + '</span>' + $(this).val());
                    i = i + 1;
                }*/

            });
            $('span.service_docs').html(output.join('<br>'));

            if($('#is-application').is(':checked')){
                form.find('div.pre-application').show();

                if(form.find('input.service_to').val()!='')
                    form.find('label.service_to').html(form.find('input.service_to').val());

                if(form.find('input#is-application-office').is(':checked'))
                    form.find('label.service_to_office_name').html(form.find('input.service_provider_office_name').val());

                if(form.find('input.service_to_sub').val()!='')
                    form.find('label.service_to_sub').html(form.find('input.service_to_sub').val());

                if(form.find('input#is-application-custom').is(':checked'))
                    form.find('label.service_to_custom').html('<textarea cols="25" rows="1"></textarea>');

                var l = [];

                if(form.find('input#is-application-district').is(':checked'))
                    l.push('জেলা সমূহ');
                if(form.find('input#is-application-upazilla').is(':checked'))
                    l.push('উপজেলা সমূহ');
                if(form.find('input#is-application-citycorporation').is(':checked'))
                    l.push('সিটি কর্পোরেশন সমূহ');

                form.find('label.service_to_list').html(l.join(', '));

                if(form.find('input.service_to_applicant_title').val()!='')
                    form.find('label.service_to_applicant_title').html(form.find('input.service_to_applicant_title').val());

            }else{
                form.find('div.pre-application').hide();
            }

            if($('#service-payment').is(':checked')){
                form.find('div.pre-payment').children('div.card-block').children('div').show();
                form.find('div.pre-payment').children('div.card-block').children('div.default-config').hide();

                var ecac = [], ecn = [], eca = [], ecc = [], opn = [], opa = [], opc = [];
                form.find('input.service_challan_account').each(function(){
                    ecac.push($(this).val());
                });
                form.find('input.service_echallan_name').each(function(){
                    ecn.push($(this).val());
                });
                form.find('input.service_echallan_amount').each(function(){
                    eca.push($(this).val());
                });
                form.find('input.service_echallan_not_fixed').each(function(){
                    if($(this).is(':checked'))
                        ecc.push(1);
                    else
                        ecc.push(0);
                });

                if($('#service-auto-payment').is(':checked'))
                    $('.auto-payment').html('Auto payment');
                else
                    $('.auto-payment').html('Payment after verification.');

                if($('#own-office-payment').is(':checked')){
                    form.find('input.service_payment_name').each(function(){
                        opn.push($(this).val());
                    });
                    form.find('input.service_payment_amount').each(function(){
                        opa.push($(this).val());
                    });
                    form.find('input.service_payment_not_fixed').each(function(){
                        if($(this).is(':checked'))
                            opc.push(1);
                        else
                            opc.push(0);
                    });
                    form.find('#preview').find('div.own_payment').show();
                }else{
                    opn = []; opa = [];
                    form.find('#preview').find('div.own_payment').hide();
                }

                pre.find('div.echallan').find('.echallan_name').html('');
                pre.find('div.echallan').find('.echallan_amount').html('');
                pre.find('div.echallan').find('.own_payment_name').html('');
                pre.find('div.echallan').find('.own_payment_amount').html('');

                pre.find('div.echallan').find('.echallan_name').html('');
                pre.find('div.echallan').find('.echallan_amount').html('');
                var amount=0, ec=0;
                for(var j=0;j<ecn.length;j++){
                    if(ecac[j]!='') {
                        if(ecc[j]==1) {
                            pre.find('div.echallan').find('.echallan_name').append('<div>(Custom payment to - ' + ecac[j] + ') ' + ecn[j] + '</div>');
                            pre.find('div.echallan').find('.echallan_amount').append('<div>0 Tk.</div>');
                            ec = 1;
                        }
                        else {
                            pre.find('div.echallan').find('.echallan_name').append('<div>(' + ecac[j] + ') ' + ecn[j] + '</div>');
                            pre.find('div.echallan').find('.echallan_amount').append('<div>' + eca[j] + ' Tk.</div>');
                            amount = amount + parseInt(eca[j]);
                            ec = 1;
                        }
                    }
                }

                if(ec==0)
                    pre.find('.echallan').hide();
                else
                    pre.find('.echallan').show();

                pre.find('div.own_payment').find('.own_payment_name').html('');
                pre.find('div.own_payment').find('.own_payment_amount').html('');
                for(var j=0;j<opn.length;j++) {
                    if(opc[j]==1){
                        pre.find('div.own_payment').find('.own_payment_name').append('<div>(Custom payment) ' + opn[j] + '</div>');
                        pre.find('div.own_payment').find('.own_payment_amount').append('<div>0 Tk.</div>');
                    }else {
                        pre.find('div.own_payment').find('.own_payment_name').append('<div>' + opn[j] + '</div>');
                        pre.find('div.own_payment').find('.own_payment_amount').append('<div>' + opa[j] + ' Tk.</div>');
                        amount = amount + parseInt(opa[j]);
                    }
                }
                pre.find('.total_payment').html(amount+' Tk.');

            }else{
                form.find('div.pre-payment').children('div.card-block').children('div').hide();
                form.find('div.pre-payment').children('div.card-block').children('div.default-config').show();
            }

            if($('#default-db').is(':checked')){
                form.find('div.pre-database').children('div.card-block').children('div').hide();
                form.find('div.pre-database').children('div.card-block').children('div.default-config').show();
            }else{
                pre.find('div.pre-database').children('div.card-block').children('div').show();
                pre.find('div.pre-database').find('div.default-config').hide();

                pre.find('span.db_host').html(form.find('input.db_host').val());
                pre.find('span.db_name').html(form.find('input.db_name').val());
                pre.find('span.db_user').html(form.find('input.db_user').val());
                pre.find('span.db_password').html(form.find('input.db_password').val());
                pre.find('span.db_port').html(form.find('input.db_port').val());
            }

            if($('#has-integration').is(':checked')){
                form.find('div.pre-integration').show();
                //pre.find('span.other_application').html(form.find('select.service_other_application').find(":selected").text());
                if(form.find('#eNothi-integration').is(':checked')) {
                    pre.find('span.other_application').html('eNothi');
                    pre.find('span.other_application_url').html('https://nothi.gov.bd');
                }else {
                    pre.find('span.other_application').html('Other');
                    pre.find('span.other_application_url').html(form.find('input.service_other_application_url').val());
                }

            }else{
                form.find('div.pre-integration').hide();
            }
        }

        $('.obd-step-form').find('.obd-previous-btn').on('click',function(){

            $('.obd-step-form').find('ul.obd-stpes li:nth-child('+cur+')').attr('class','active-gray');
            $('.obd-step-form').find('.obd-content section:nth-child('+cur+')').hide();
            cur = cur - 1;

            $('.obd-step-form').find('ul.obd-stpes li:nth-child('+cur+')').attr('class','active');
            $('.obd-step-form').find('.obd-content section:nth-child('+cur+')').show();

            if(cur==1) $('.obd-step-form').find('.obd-previous-btn').hide();
            else $('.obd-step-form').find('.obd-previous-btn').show();

            if(cur!=len) {
                $('.obd-step-form').find('.obd-submit-btn').hide();
                $('.obd-step-form').find('.obd-next-btn').show();
            }
        });

        /*var service_officers_row = $('.service-officers-row').clone();
        service_officers_row.find('.required').remove();
        service_officers_row.find('input').removeAttr('required');
        $('#add-more-officers').on('click',function (e) {
            if($('.service-officers-row select').length==1)
                service_officers_row = $('.service-officers-row').clone();

            $('.service-officers-row').append(service_officers_row.html());
        });*/

        var service_fail_officers_row = $('.service-fail-officers-row').clone();
        $('#add-more-fail-officers').on('click',function (e) {
            $('.service-fail-officers-row').append(service_fail_officers_row.html());
        });

        var service_rules_row = $('.service-rules-row').clone();
        $('#add-more-rules').on('click',function (e) {
            $('.service-rules-row').append(service_rules_row.html());
        });

        $('#is-application').on('click',function(){
            if($('#is-application').is(':checked'))
                $('#application-setting').show();
            else
                $('#application-setting').hide();
        });

        var echallan_row = $('.echallan-row').clone();
        var er=1;
        $('#add-more-echallan').on('click',function (e) {
            var t = echallan_row.html();
            t = t.replace(/fixed-payment-e/g,'fixed-payment-e-'+er);
            $('.echallan-row').append(t);
            er = er + 1;
        });

        var own_office_payment_row = $('.own-office-payment-row').clone();
        var or=1;
        $('#add-more-own-office-payment').on('click',function (e) {
            var t = own_office_payment_row.html();
            t = t.replace(/fixed-payment-o/g,'fixed-payment-o-'+er);
            $('.own-office-payment-row').append(t);
            or = or + 1;
        });

        $('#eChallan, #accountPa, #db-setting, #own-office-payment-panel, #payment-with').hide();

        $('#service-payment').on('click',function(){
            if($('#service-payment').is(':checked'))
                $('#auto-payment, #eChallan, #accountPay, #payment-with').show();
            else
                $('#auto-payment, #eChallan, #accountPay, #payment-with').hide();
        });

        $('#echallan-payment').on('click',function(){
            $('#accountPay').hide();
        });
        $('#ekpay-payment, #sonali-payment').on('click',function(){
            $('#accountPay').show();
        });

        $('#own-office-payment').on('click',function () {
            if($(this).is(':checked'))
                $('#own-office-payment-panel').show();
            else
                $('#own-office-payment-panel').hide();
        });

        $('#default-db').on('click',function(){
            if($('#default-db').is(':checked'))
                $('#db-setting').hide();
            else
                $('#db-setting').show();
        });

        /*$('select#ministry').change(function () {
            if($(this).attr('data-type')=='select'){
                var i = $(this).val();
                var loadOn = $(this).attr('data-load-on');
                $.getJSON( SSP+'office-layer.json', function( data ) {
                    var items = [];
                    items.push('<option>Select</option>');
                    var j=1;
                    $.each( data, function( key, val ) {
                        if(val['ministry_id']==i) {
                            items.push('<option value="'+key+'">'+val['name']+'</option>');
                            j = j + 1;
                        }
                    });
                    $('#'+loadOn).html('');
                    $('#'+loadOn).html(items.join(''));
                });
            }
        });*/

        $('.others-url').hide();
        $('#has-integration').on('click',function(){
            if($('#has-integration').is(':checked'))
                $('#integration-setting').show();
            else
                $('#integration-setting').hide();
        });

        $('#eNothi-integration').on('click',function(){
            $('.others-url').hide();
            $('.service_other_application_url').val('');
        });

        $('#others-integration').on('click',function(){
            $('.others-url').show();
        });

        $('.service_docs').on('click',function(){
            var p = $(this).parents('div.checkbox');
            if($(this).is(':checked'))
                p.find('.req').show();
            else
                p.find('.req').hide();
        });
    }

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
});