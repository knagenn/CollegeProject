window. setInterval(function() {
    jQuery.ajax({
        url: 'data_transfer.php',
        type: 'post',
        data: `type=get_notification`,
        success: function (success) {
            if(success==0){
                jQuery('#notify').html('0');
            }else{
                jQuery('#notify').html(success);
            }
        }
    });
}, 200000);

function notification_fun() {
    $('.notification_remove').remove();
    jQuery.ajax({
        url: 'data_transfer.php',
        type: 'post',
        data: `type=get_notification_data`,
        success: function (response) {
            $.each(response, function(key, value){
                $('#notify_data').append(
                    `<a href="notification_deatils.php?id=${value['id']}&type=${value['type']}&nav_id=${value['nav_id']}" target="blank" onclick="notification_index(${value['id']})" class="dropdown-item notification_remove">
                        <div class="media">
                            <img src="dist/img/dummy_profile.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ${value['title']}
                            </h3>
                            <p class="text-sm">${value['message']}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${value['added_on']}</p>
                            </div>
                        </div>
                    </a>`
                );
                if(value['status']==0){
                    $('.envelope_style').addClass("zmdi zmdi-email");
                }else{
                    $('.envelope_style').addClass("zmdi zmdi-email-open");
                }
            });
        }
    });
}

$('#add_button').click(function () {
    $('.add_div').show();
    $('#add_button').hide();
    $('#show_button').show();
    $('.show_div').hide();
});
$('#show_button').click(function () {
    window.location.href=window.location.href;
});












