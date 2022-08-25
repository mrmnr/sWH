$(document).ready(function(){
    $('.modal-btn-1').click(function(){
        var cat_id = $(this).data('id');
        $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: {cat_id: cat_id},
            success: function(response){ 
                $('.ajax_response').html(response); 
                $('#edit-category').modal('show'); 
            }
        });
    });
    $('.modal-btn-2').click(function(){
        var add_id = $(this).data('id');
        $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: {add_id: add_id},
            success: function(response){ 
                $('.ajax_response').html(response); 
                $('#edit-address').modal('show'); 
            }
        });
    });
    $('.modal-btn-3').click(function(){
        var timing_id = $(this).data('id');
        $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: {timing_id: timing_id},
            success: function(response){ 
                $('.ajax_response').html(response); 
                $('#edit-timing').modal('show'); 
            }
        });
    });
});