 $(window).scroll(function() {
  var sticky = $('.mobile-menu'),
    scroll = $(window).scrollTop();
   
  if (scroll >= 40) { 
    sticky.addClass('fixed'); }
  else { 
   sticky.removeClass('fixed');

}
});

$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});

document.getElementById('numerical').addEventListener('input', function (e) {
  e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
});

