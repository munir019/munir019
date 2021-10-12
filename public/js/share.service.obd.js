jQuery(document).ready(function($){
    if($('select#service_type').is(':visible')) {
        if($('select#service_type').attr('auto-load')=='true')
        $.getJSON( SSP+'service-type.json?time='+Date(), function( data ) {
            var items = [];
            items.push( "<option value=''>Select</option>" );
            $.each( data, function( key, val ) {
                items.push( "<option value='" + key + "'>" + val['name'] + "</option>" );
            });
            $('select#service_type').html(items.join(''));

            if($('select#service_type').attr('data-id')){
               var v = $('select#service_type').attr('data-id');
               v = v.split(',');
               for (var i=0;i<v.length;i++)
                   $('select#service_type').find('option[value="'+v[i]+'"]').attr('selected','selected');
            }
        });
    }

    if($('select#service_sector').is(':visible')) {
        if($('select#service_sector').attr('auto-load')=='true')
        $.getJSON( SSP+'service-sector.json?time='+Date(), function( data ) {
            var items = [];
            items.push( "<option value=''>Select</option>" );
            $.each( data, function( key, val ) {
                items.push( "<option value='" + key + "'>" + val['name'] + "</option>" );
            });
            $('select#service_sector').html(items.join(''));

            if($('select#service_sector').attr('data-id')){
                var v = $('select#service_sector').attr('data-id');
                v = v.split(',');
                for (var i=0;i<v.length;i++)
                    $('select#service_sector').find('option[value="'+v[i]+'"]').attr('selected','selected');
            }
        });
    }
});
