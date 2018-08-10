$(window).ready(function(e) {
    $('a').on('click', function(e) {
        $('a').removeClass('active_dir');
        $(this).addClass('active_dir');
        // e.preventDefault();
    });
  });