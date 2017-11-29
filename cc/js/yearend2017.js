/**
 * Rotate images and motos
 */
(function ($) {
  "use strict";

  $( document ).ready(function() {

    var images = [
      'education_01_100_crop.png',
      'equality_01_100_crop.png',
      'research_01_100_crop.png',
      'conversation_01_100_crop.png',
      'creativity_01_100_crop.png'
    ];

    var mottos = [
      'open education for all',
      'universal access and equality',
      'open access to research',
      'the global conversation',
      'creativity and collaboration'
    ];

    var image_path_prefix = '/wp-content/themes/cc/images/yearend-takeover/CCYE_People_100_cropped/';

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
