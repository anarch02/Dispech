// Users actions
import Swal from 'sweetalert2';


$('#add-user-form').on('submit', function(event){
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
                    'New user created!',
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
$('body').on('click', '#update-user-button', function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var email = $(this).data('email');

    $('#up_id').val(id);
    $('#up_name').val(name);
    $('#up_email').val(email);
});

$('body').on('click', '#delete-user-button', function(){
    var id = $(this).data('id');
    // alert('all right');

    $('#deleteIdUser').val(id);
});
