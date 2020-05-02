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

    $('#save-lead').click(function(e){
        e.preventDefault();
        console.log("save lead clicked");
        saveNewLead();
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

    function saveNewLead(){
        var leadName = $('#name').val();
        var date = $('#date').val();
        var contactName = $('#contactName').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var address = $('#address').val();

        if(leadName == '' || date == '' || contactName == '' || phone == '' ){
            var errorMessage = `<div class="alert alert-info">Please fill all fields</div>`;
            $(errorMessage).appendTo($('#add-lead-form'));
            return ;
        }

        var data = {
            leadName,
            date,
            contactName,
            phone,
            email,
            address
        };

        data.id = 1;

        $.ajax({
            url:'leads/data.php',
            method: 'POST',
            data:data,
            success: function (data) {
                $('#page-content').html(data);
            }
        });

    }
});