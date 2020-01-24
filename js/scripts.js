//Activeer op click
function triggerClick() {
    document.querySelector('#eve_image').click();
}

//Hide masseges
function Hide(HideID)
{
    HideID.style.display = "none";
}

//Image weergeven bij opladen
function displayImage(e) {
    if (e.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector('#display').setAttribute('src', e.target.result);
        };
        reader.readAsDataURL(e.files[0]);
    }
}

//Input veld eve_prijs (min & max) weergeven of disablen bij check 'gratis'
function disableMyText(){
    if(document.getElementById("check").checked == true){
        document.getElementById("eve_minprijs").disabled = true;
        document.getElementById("eve_maxprijs").disabled = true;
        document.getElementById("eve_minprijs").style.display ="none";
        document.getElementById("eve_maxprijs").style.display ="none";
    }else{
        document.getElementById("eve_minprijs").disabled = false;
        document.getElementById("eve_maxprijs").disabled = false;
        document.getElementById("eve_minprijs").style.display ="inline";
        document.getElementById("eve_maxprijs").style.display ="inline";
    }
}

// Scroll To Top
$(document).ready(function(){
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#goToTop').fadeIn();
        } else {
            $('#goToTop').fadeOut();
        }
    });
    $('#goToTop').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1000);
        return false;
    });
});

//Smooth scrolling
// Select all links with hashes
$('a[href*="#"]')
// Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function(event) {
        // On-page links
        if (
            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            &&
            location.hostname == this.hostname
        ) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000, function() {
                    // Callback after animation
                    // Must change focus!
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) { // Checking if the target was focused
                        return false;
                    } else {
                        $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                        $target.focus(); // Set focus again
                    };
                });
            }
        }
    });


function Verberg() {
    setTimeout(function () {
        $('#message').fadeOut();
    }, 2000);
}