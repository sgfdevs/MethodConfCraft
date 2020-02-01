$(function() {
    $('#subscribe').on('submit', function (e) {
        var name = $('#name'),
            email = $('#email'),
            form = $(this),
            nameVal = name.val(),
            emailVal = email.val()

        if(validateEmail(email.val()))
        {
            $.post(form.attr('action'), form.serialize()).done(function( data ) {
                console.log(data);
                name.val('');
                email.val('');

                swal('Excellent!', 'Thanks, ' + nameVal + '. Method Conf news will be headed your way soon.', 'success');
            });

        } else {
            swal('Whoops', 'Something went wrong... Please double check that your email address is valid. And if so, yell at us on the Twitter and tell us our stuff is broken.', 'error');
        }

        e.preventDefault();
    });

    function validateEmail(email)
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
    
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

    $('.image_slides ol li').on('click', function(){
        setImage($(this).index());
    });

    $('.image_slides i').on('click', function(){
        var direction = $(this).data('direction'),
            totalSlides = $('.image_slides ol li').length,
            currentSlide = $('.image_slides ol li.current').index(),
            nextIndex = 0;

        

        if(direction == 'next') {
            if(currentSlide + 1 != totalSlides) {
                nextIndex = currentSlide + 1;
            }
        } else {
            if(currentSlide == 0) {
                nextIndex = totalSlides - 1;
            } else {
                nextIndex = currentSlide - 1;
            }
        }
        
        setImage(nextIndex);
    });

    function setImage(index) {
        var imageSlides = $('.image_slides');

        $('.images img:visible', imageSlides).removeClass('current');
        $('.images img:eq('+ index +')', imageSlides).addClass('current')
        $('li', imageSlides).removeClass('current');
        $('li:eq('+ index +')', imageSlides).addClass('current');
    }

    Tito.on('registration:started', function(data){
        fbq('track', 'ViewContent', {value: 1, content_type: 'registration:started'});
    });

    Tito.on('registration:filling', function(data){
        fbq('track', 'ViewContent', {value: 1, content_type: 'registration:filling'});
    });

    Tito.on('registration:finished', function(data){
        fbq('track', 'Purchase', {currency: "USD", value: data.total});
    });

    Tito.on('registration:complete', function(data){
        fbq('track', 'ViewContent', {value: 1, content_type: 'registration:complete'});
    });
});




















