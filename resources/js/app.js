import './bootstrap';
import './users';
// import './search';
import './region';
import './drones';
import './multiselect';
import Swal from 'sweetalert2';
import 'jquery.easing/jquery.easing';

import.meta.glob([
  '../img/**/*'
]);

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


    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      if ($(".sidebar").hasClass("toggled")) {
        $('.sidebar .collapse').collapse('hide');
      };
    });
  
    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function() {
      if ($(window).width() < 768) {
        $('.sidebar .collapse').collapse('hide');
      };
      
      // Toggle the side navigation when window is resized below 480px
      if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
        $("body").addClass("sidebar-toggled");
        $(".sidebar").addClass("toggled");
        $('.sidebar .collapse').collapse('hide');
      };
    });
  
    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
      if ($(window).width() > 768) {
        var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
      }
    });
  
    // Scroll to top button appear
    $(document).on('scroll', function() {
      var scrollDistance = $(this).scrollTop();
      if (scrollDistance > 100) {
        $('.scroll-to-top').fadeIn();
      } else {
        $('.scroll-to-top').fadeOut();
      }
    });
  
    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(e) {
      var $anchor = $(this);
      $('html, body').stop().animate({
        scrollTop: ($($anchor.attr('href')).offset().top)
      }, 1000, 'easeInOutExpo');
      e.preventDefault();
    });
  