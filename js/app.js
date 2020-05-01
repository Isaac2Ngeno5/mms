$(document).ready(function(){
    'use strict';
    $('#lead').click(function (event) {
        event.preventDefault();
        console.log("lead clicked");
        getLeads();
    });

    $('#add-lead').click(function (e) {
        e.preventDefault();
        console.log("add lead clicked");
        getAddLead();
    });



    function getLeads() {
        $.ajax({
            url:'leads/bridge.php',
            method: 'POST',
            data:{id:1},
            success: function (data) {
                $('#page-content').html(data);
            }
        });
    }

    function getAddLead() {
        $.ajax({
            url:'leads/bridge.php',
            method: 'POST',
            data:{id:2},
            success: function (data) {
                $('#page-content').html(data);
            }
        });
    }
});