/**
 * Rotate images and motos
 */
(function ($) {
  "use strict";

  $( document ).ready(function() {

    var images = [
      'creativity_01_200.png',
      'education_01_200.png',
      'equality_01_200.png',
      'research_01_200.png',
      'conversation_01_200.png',
    ];

    var mottos = [
      'creativity and collaboration',
      'open education for all',
      'universal access and equality',
      'open access to research',
      'the global conversation'
    ];

    var image_path_prefix = '/wp-content/themes/cc/images/yearend-takeover/CC_People/CCYE_People_200/';

    var i = 0;
    var totalIterations = 0;
    var delay = 1500;

    replaceCenterBoxImage();

    function replaceCenterBoxImage(){
      console.log(totalIterations + ':' + i + ':' + delay);
      $('img.person', '.centre-box').delay(delay).fadeOut(delay/5, function(){
        $(this).attr("src", image_path_prefix + images[i]);
        $(this).fadeIn(delay/5);
        $('.motto', '.centre-box').html(mottos[i]);
        i = (i + 1) % 5;
        totalIterations++;
        if (totalIterations < 60){
          if (delay > 200){
            delay -= 180;
          }
        } else {
          if (delay < 2000){
            delay += 50;
          }
        }
        replaceCenterBoxImage();
      });
    }


  });

})(jQuery);
