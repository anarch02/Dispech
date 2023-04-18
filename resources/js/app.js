import './bootstrap';
import './users';
// import './search';
import './region';
import './drones';
import './multiselect';
import Swal from 'sweetalert2';


// Admin actions

var addAdmin = '#add-admin-form';

$(addAdmin).on('submit', function(event){
    event.preventDefault();

    var url = $(this).attr('data-action');

    $.ajax({
        url: url,
        method: 'POST',
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(response)
        {
            if(response)
            {
                Swal.fire(
                    'New model created!',
                    'You clicked the button!',
                    'success'
                  )
            }
            $('.table').load(location.href+ ' .table');
        },
        error: function(err) {
            let error = err.responseJSON;
            $.each(error.errors, function(index, value){
                $('.errorsMessage').append('<span class="text-danger">'+value+'</span>');
            });
        }
    });
});



// Edit model
$('body').on('click', '#update-admin-button', function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var email = $(this).data('email');

    $('#up_id').val(id);
    $('#up_name').val(name);
    $('#up_email').val(email);
});

// MOdel Actions


$('#add-model-form').on('submit', function(event){
    event.preventDefault();

    var url = $(this).attr('data-action');

    $.ajax({
        url: url,
        method: 'POST',
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(response)
        {
            $('#add-model-form').trigger("reset");
            // alert(response.success);
            if(response)
            {
                Swal.fire(
                    'New model created!',
                    'You clicked the button!',
                    'success'
                  )
            }
            $('.table').load(location.href+ ' .table');
        },
        error: function(err) {
            let error = err.responseJSON;
            $.each(error.errors, function(index, value){
                $('.errorsMessage').append('<span class="text-danger">'+value+'</span>');
            });
        }
    });
});


// Edit model
$('body').on('click', '#update-model-button', function(){
    var id = $(this).data('id');
    var title = $(this).data('title');
    // alert(title);
    // var idtitle = id + title;
    $('#up_id').val(id);
    $('#up_title').val(title);
});



// Organization

var addOrganization = '#add-organization-form';

$(addOrganization).on('submit', function(event){
    event.preventDefault();

    var url = $(this).attr('data-action');

    $.ajax({
        url: url,
        method: 'POST',
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(response)
        {
            $(addOrganization).trigger("reset");
            // alert(response.success);
            if(response)
            {
                Swal.fire(
                    'New organization created!',
                    'You clicked the button!',
                    'success'
                  )
            }
            $('.table').load(location.href+ ' .table');
        },
        error: function(err) {
            let error = err.responseJSON;
            $.each(error.errors, function(index, value){
                $('.errorsMessage').append('<span class="text-danger">'+value+'</span><br>');
            });
        }
    });
});

// Delete model
$('body').on('click', '#deleteOrganization', function(){
    var id = $(this).data('id');

    $('#deleteIdOrganization').val(id);
});


