jQuery(document).ready(function($){
    function loadMinistry() {
        $.ajax({
            type:'POST',
            datType:'json',
            url: oisf,
            data: {'path': 'officeministry'},
            beforeSend: function(){
            },
            success: function (data) {
                var items = [];
                items.push( "<option value=''>Select</option>" );

                data  = JSON.parse(data);
                $.each( data, function( key, val ) {
                    items.push( "<option value='" + val['id'] + "'>" + val['nameBn'] + "</option>" );
                });
                $('select#ministry').html(items.join(''));

                if($('select#ministry').attr('data-id')){
                    var v = $('select#ministry').attr('data-id');
                    $('select#ministry').find('option[value="'+v+'"]').attr('selected','selected');
                    loadOfficeLayer(v);
                }
            }
        });
    }

    loadMinistry();

    if($('#ministryFixed').length){
        if($('select#ministryFixed').attr('data-id')){
            var v = $('select#ministryFixed').attr('data-id');
            $('select#ministryFixed').find('option[value="'+v+'"]').attr('selected','selected');
            loadOfficeLayer(v);
        }
    }

    function loadOfficeLayer(v) {
        $('select#office_layer').html('<option>Loading...</option>');
        $.ajax({
            type:'POST',
            datType:'json',
            url: oisf,
            data: {'path': 'officelayer?ministry='+v},
            beforeSend: function(){
            },
            success: function (data) {
                var items = [];
                items.push( "<option value=''>Select</option>" );
                data  = JSON.parse(data);
                $.each( data, function( key, val ) {

                    items.push( "<option value='" + val['id'] + "'>" + val['nameBn'] + "</option>" );
                });
                $('select#office_layer').html(items.join(''));

                if($('select#office_layer').attr('data-id')){
                    var v = $('select#office_layer').attr('data-id');
                    //var m = $('select#ministry').attr('data-id');
                    $('select#office_layer').find('option[value="'+v+'"]').attr('selected','selected');
                    loadOfficeOrigin(v);//,m
                }
            }
        });
    }

    $('select#ministry').change(function(){
        var v = $(this).val();
        loadOfficeLayer(v);
    });

    $('select#ministryFixed').change(function(){
        var v = $(this).val();
        loadOfficeLayer(v);
    });

    function loadOfficeOrigin(v/*,m*/) {
        $('select#office_origin').html('<option>Loading...</option>');
        $.ajax({
            type:'POST',
            datType:'json',
            url: oisf,
            data: {'path': 'officeorigin?layer='+ v },//+'ministry='+m
            beforeSend: function(){
            },
            success: function (data) {
                var items = [];
                items.push( "<option value=''>Select</option>" );
                data  = JSON.parse(data);
                $.each( data, function( key, val ) {

                    items.push( "<option value='" + val['id'] + "'>" + val['nameBn'] + "</option>" );
                });
                $('select#office_origin').html(items.join(''));

                if($('select#office_origin').attr('data-id')){
                    var v = $('select#office_origin').attr('data-id');
                    //var m = $('select#ministry').attr('data-id');
                    $('select#office_origin').find('option[value="'+v+'"]').attr('selected','selected');
                    loadOfficeOriginUnit(v);//,m
                }
            }
        });
    }

    $('select#office_layer').change(function(){
        var v = $(this).val();
        //var m = $('select#ministry').val();
        loadOfficeOrigin(v);//,m
    });

    function loadOfficeOriginUnit(v/*,m*/){
        $('select#office_origin_unit').html('<option>Loading...</option>');
        $.ajax({
            type:'POST',
            datType:'json',
            url: oisf,
            data: {'path': 'officeoriginunit?officeOrigin='+ v +'&status=1'},//&ministry='+m+'
            beforeSend: function(){
            },
            success: function (data) {
                var items = [];
                items.push( "<option value=''>Select</option>" );
                data  = JSON.parse(data);
                $.each( data, function( key, val ) {

                    items.push( "<option value='" + val['id'] + "'>" + val['nameBn'] + "</option>" );
                });
                $('select#office_origin_unit').html(items.join(''));

                if($('select#office_origin_unit').attr('data-id')){
                    var v = $('select#office_origin_unit').attr('data-id');
                    //var m = $('select#ministry').attr('data-id');
                    $('select#office_origin_unit').find('option[value="'+v+'"]').attr('selected','selected');
                    //loadServiceOffice(v,m);
                }
            }
        });
    }

    $('select#office_origin').change(function(){
        var v = $(this).val();
        //var m = $('select#ministry').val();
        loadOfficeOriginUnit(v);//,m
    });

    function loadServiceOffice(v,m) {
        $('select#service_officers').html('<option>Loading...</option>');
        $.ajax({
            type:'POST',
            datType:'json',
            url: oisf,
            data: {'path': 'officeoriginunitorganogram?originUnit='+ v},
            beforeSend: function(){
            },
            success: function (data) {
                var items = [];
                items.push( "<option value=''>Select</option>" );
                items.push( "<option value='0'>ফ্রন্ট ডেস্ক (Front Desk)</option>" );
                data  = JSON.parse(data);
                var s=0;
                $.each( data, function( key, val ) {
                    if(s==0)
                        items.push( "<option value='" + val['id'] + "' selected>" + val['nameBn'] + "</option>" );
                    else
                        items.push( "<option value='" + val['id'] + "'>" + val['nameBn'] + "</option>" );
                    s = s + 1;
                });
                $('select.service_officers').html(items.join(''));
                $('select.service_officers').each(function(){
                    if($(this).attr('data-id')){
                        var v = $(this).attr('data-id');
                        $(this).find('option[value="'+v+'"]').attr('selected','selected');
                    }
                    $(this).select2();
                });
            }
        });
    }
    $('select#office_origin_unit').change(function(){
        var v = $(this).val();
        //var m = $('select#ministry').val();
        loadServiceOffice(v);//,m
    });
});
