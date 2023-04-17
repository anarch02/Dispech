// drone Models
import Swal from 'sweetalert2';

var addDrone = '#add-drone-form';

$(addDrone).on('submit', function(event){
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
            $(addDrone).trigger("reset");
            // alert(response.success);
            if(response)
            {
                Swal.fire(
                    'New drone created!',
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

// Edit model
// $('body').on('click', '#update-drone-button', function(){
//     var id = $(this).data('id');
//     var title = $(this).data('title');

//     $('#up_id').val(id);
//     $('#up_title').val(title);
// });

// Delete model
$('body').on('click', '#delete-drone-button', function(){
    var id = $(this).data('id');

    $('#deleteIdDrone').val(id);
});

