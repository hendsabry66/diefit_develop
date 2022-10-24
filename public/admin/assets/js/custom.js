$(document).on("submit", ".ajaxForm", function (event) {
    event.preventDefault();
    $('.error-message').each(function (){
        $(this).html('');
    });
    $('.has-error').each(function () {
        $(this).removeClass('has-error');
    });

    var formData = new FormData(this);
    formData.append('method', 'ajax');

    $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        dataType: "JSON",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.errors) {

                errors = data.errors;
                console.log(errors);
                for(var key in errors)
                {
                    $('#' + key).addClass('has-error');
                    $('#' + key + '-errors').html(errors[key]);
                }
                messages = Object.values(errors);
                console.log(messages);
                messages.forEach(function (message) {
                    toastr.error(message);
                });
            } else {
                messages = data.messages;
                console.log(messages.errors);

                if (messages.success) toastr.success(messages.success);
                if (messages.errors) toastr.error(messages.errors);
                if (messages.redirect)
                {
                    if (messages.tab && messages.tab == 'new')
                        window.open(messages.redirect, '_blank');
                    else
                        window.location.href = messages.redirect;
                }
            }
        },
        error: function (xhr, data) {
            $.each(xhr.responseJSON.errors, function(key,value) {
                toastr.error(value);
            });
        }
    });
});

var loading = $('#loadingDiv');
$(document)
    .ajaxStart(function () {
        loading.show();
    })
    .ajaxStop(function () {
        loading.hide();
    });

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function doAjax(method,action){
    $.ajax({
        type: method,
        url: action,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            if (data.errors) {
                errors = data.errors;
                console.log(errors);
                for(var key in errors)
                {
                    $('#' + key).addClass('has-error');
                    $('#' + key + '-errors').html(errors[key]);
                }
                messages = Object.values(errors);
                console.log(messages);
                messages.forEach(function (message) {
                    toastr.error(message);
                });
            } else {
                messages = data.messages;
                console.log(messages);

                if (messages.success) toastr.success(messages.success);
                if (messages.redirect) window.location.href = messages.redirect;
            }
        },
        error: function (xhr, data) {
            $.each(xhr.responseJSON.errors, function(key,value) {
                toastr.error(value);
            });
        }
    });
}

function toggleStatus(route, btn)
{
    if(route.length > 0)
        $.ajax(route, {
            type: 'PUT',
            success: function (data) {
                console.log(data);
                if (data.success)
                {
                    if (data.status == 1) {
                        $(btn).parents('td').prev().text('Active')
                    } else {
                        if (data.status == 0 && data.status != '') {
                            $(btn).parents('td').prev().text('Inactive')
                        }
                    }
                    toastr.success(data.success);
                }else if(data.error)
                {
                    if ($(btn).prop('checked')) {
                        $(btn).prop('checked', false);
                    }else{
                        $(btn).prop('checked', true);
                    }
                    toastr.error(data.error);
                }
            },
            error: function (xhr, data) {
                $.each(xhr.responseJSON.errors, function(key,value) {
                    toastr.error(value);
                });
            }
        });
}

$(".upload_image").on('change', function () {
    var fileReader = new FileReader();
    var preview = $(this).parent().find(".preview_image");
    fileReader.onload = function () {
        var data = fileReader.result;
        preview.prop('src', data);
    };
    fileReader.readAsDataURL($(this).prop('files')[0]);
});


$('.hamburger.close-sidebar-btn.hamburger--elastic').on('click' , function(){
    $('.profile_img').css('textIndent' , '-10px');
})

$('.addNewPrice').on('click' , function(){
	var getDef = $('.defOnePrice').html();
  	$('.allPrices').append('<div class="row">' + getDef + '</div>');
})

$('.view-attendees-btn').on('click' , function(){

    $('#view-attendees-container').slideToggle();
})

$('#owner_date_of_birth').on('blur' , function(){
    var today = new Date();
    var birthDate = new Date($(this).val());
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    if(age <= 18){
        alert('Age shuold be 18+ years old');
        $(this).val('');
    }

})


$(function(){
    //start move bread crumb according to window size
    function moveBreadCrumb(){
        if (window.matchMedia('(max-width: 991px)').matches) {
            $('.breadCrumbStyle').prependTo('.app-main');
        } else {
            $('.breadCrumbStyle').prependTo('.app-header__content .app-header-left');

        }
    }

    moveBreadCrumb();
    $( window ).resize(function() {
        moveBreadCrumb()
    });
    //end move bread crumb according to window size


    // $('<i class="fa fa-calendar calender-picker"></i>').insertAfter(`.all-radio-tabs-content .hasDatepicker`);

})
