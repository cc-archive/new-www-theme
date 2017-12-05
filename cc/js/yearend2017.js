/**
 * Rotate images and motos
 */
(function ($) {
  "use strict";

  $( document ).ready(function() {

    // Donation button

    $('.pum-overlay #gform_submit_button_2').on('click', function(e){
      e.preventDefault();

      switch($('.pum-overlay #gform_12 input[type="radio"]:checked').attr('id')){
        case 'choice_12_1_0':
          $(location).attr('href','/donate/?type=One+Time&amount=$75');
          break;
        case 'choice_12_1_1':
          $(location).attr('href','/donate/?type=Monthly&mamount=$5');
          break;
        case 'choice_12_1_2':
          $(location).attr('href','/donate/?type=Monthly&mamount=$15');
          break;
        case 'choice_12_1_4':
          $(location).attr('href','/donate/?type=One+Time&amount=' + parseInt($('#input_12_1_other').val()));
          break;
        default:
          $(location).attr('href','/donate/');
      }
    });

    // Mobile donate button

    $('#eoy-mobile-donate-box .donate-button').on('click', function(e){
      e.preventDefault();

        $(location).attr('href','/donate/?type=One+Time&amount=' + parseInt($('#eoy-2017-donate-amount').val()));
    });



    // Image rotator

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
    var delay = 3000;

    replaceCenterBoxImage();

    function replaceCenterBoxImage(){
     // console.log(totalIterations + ':' + i + ':' + delay);
      $('img.person', '.pum-overlay .centre-box').delay(delay).hide(0, function(){
        $(this).attr("src", image_path_prefix + images[i]);
        $(this).show();
        $('.motto', '.pum-overlay .centre-box').html(mottos[i]);
        i = (i + 1) % 5;
        replaceCenterBoxImage();
      });
    }


  });

})(jQuery);
