jQuery(document).ready( function(){

    sendRequest('#create_action', {action : 'create_action', count : count});
    sendRequest('#delete_action', {action : 'delete_action'});
    sendRequest('#delete_sql_action', {action : 'delete_sql_action'});

    function sendRequest(selector, data) {
        jQuery(selector).on('click', function(e) {
            e.preventDefault();

            if (data && data.action === 'create_action') {
                data.count = jQuery('#count').val();
            }

            jQuery.ajax({
                url : dwp_ajax.ajax_url,
                type : 'post',
                data: data,
                success : function( ) {
                    jQuery('#count').val(0);
                    alert('SUCCESS');
                }
            });
        });
    }

});
