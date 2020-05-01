$(document).ready(function(){
    'use strict';
    $('#lead').click(function (event) {
        event.preventDefault();
        console.log("lead clicked");
        getleads();
    });


    function getleads() {
        $.ajax({
            url:'leads/bridge.php',
            method: 'POST',
            data:{id:1},
            success: function (data) {
                $('#page-content').html(data);
            }
        })
    }
});