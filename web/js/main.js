$(function() {
    $('#subscribe').on('submit', function (e) {
        var name = $('#name'),
            email = $('#email');

        swal('Excellent!', 'Thanks, ' + name.value + '. Method Conf news will be headed your way soon.', 'success');

        name.val('');
        email.val('');

        e.preventDefault();
    });
    
    $('.more').on('click', function(){
        var parent = $(this).closest('.speaker_card');
        parent.toggleClass('expanded');
        console.log(parent);
        $('.more_content', parent).slideToggle();
        
        return false;
    });
    
    $('#expand_all').on('click', function () {
        $('.speaker_card').addClass('expanded');
        $('.speaker_card .more_content').slideDown();
        $(this).hide();
        $('#collapse_all').show();

        $('html, body').animate({ 
            scrollTop: $('#schedule_start').offset().top, 
        }, 250, 'linear');
        
        return false;
    });

    $('#collapse_all').on('click', function () {
        $('.speaker_card').removeClass('expanded');
        $('.speaker_card .more_content').slideUp();
        $(this).hide();
        $('#expand_all').show();

        $('html, body').animate({
            scrollTop: $('#schedule_start').offset().top,
        }, 250, 'linear');
        
        return false;
    });
    
    $('.jump').on('click', function () {
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top,
        }, 500);
        
        return false;
    });
});