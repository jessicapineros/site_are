'use strict';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');

const $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

//slider
//require('./scss/slick-theme.scss');
require('./slick.js');

$(document).ready(function(){
  /*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: https://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
  function updateViewportDimensions() {
  	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
  	return { width:x,height:y };
  }
  // setting the viewport width
  var viewport = updateViewportDimensions();
  var viewportWidth = $(window).width();

  //Burger - On gere l'affichage du menu responsif pour les écrans inférieurs au égaux à medium (<992px)
  $(".menu-responsive").toggle();
  $(".burger").click(function (){
      $(".menu-responsive").toggle("slow");
  })

  //slider
  $('.slider').slick({
    dots: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    autoplay: true,
    autoplaySpeed: 5000,
    mobileFirst: true,
    pauseOnFocus: false,
    pauseOnHover: false
  });

  //ScrollMagic - animations
  var controller = new ScrollMagic.Controller();

  //build a scene
  var homeH3 = new ScrollMagic.Scene({
    triggerElement: '#home h3',
    triggerHook: 0.9
  })
  .setClassToggle('#home h3', 'fadeIn')
  //.reverse(false)
  .addTo(controller);

  var catchphrase = new ScrollMagic.Scene({
    triggerElement: '.catchphrase',
    triggerHook: 0.8
  })
  .setClassToggle('.catchphrase', 'fadeIn')
  //.reverse(false)
  .addTo(controller);

  var buttonsMain = new ScrollMagic.Scene({
    triggerElement: '.buttons-main',
    triggerHook: 0.9
  })
  .setClassToggle('.buttons-main', 'fadeInUp')
  //.reverse(false)
  .addTo(controller);

  var comment = new ScrollMagic.Scene({
    triggerElement: '.comment',
    triggerHook: 0.7
  })
  .setClassToggle('.comment', 'fadeIn')
  //.reverse(false)
  .addTo(controller);

/*
  var footer = new ScrollMagic.Scene({
    triggerElement: 'footer',
    triggerHook: 0.7
  })
  .setClassToggle('footer', 'fadeIn')
  //.reverse(false)
  .addTo(controller);
*/

  $('.block1').each(function() {
     var block1 = new ScrollMagic.Scene({
         triggerElement: this,
         triggerHook: 1
       })
       .setClassToggle(this, 'fadeInUp') // add class to project01
       //.reverse(false)
       .addTo(controller);
     });

   $('.block2').each(function() {
      var block2 = new ScrollMagic.Scene({
          triggerElement: this,
          triggerHook: 0.8
        })
        .setClassToggle(this, 'fadeIn') // add class to project01
        //.reverse(false)
        .addTo(controller);
      });


    $('.blockLeft').each(function() {
       var blockLeft = new ScrollMagic.Scene({
           triggerElement: this,
           triggerHook: 0.9
         })
         .setClassToggle(this, 'fadeInLeftBig') // add class to project01
         .reverse(false)
         .addTo(controller);
       });

     $('.block-white').each(function() {
        var blockWhite = new ScrollMagic.Scene({
            triggerElement: this,
            triggerHook: 0.8
          })
          .setClassToggle(this, 'fadeInUp') // add class to project01
          .reverse(false)
          .addTo(controller);
        });

      $('.options').each(function() {
         var options = new ScrollMagic.Scene({
             triggerElement: this,
             triggerHook: 0.8
           })
           .setClassToggle(this, 'fadeInUp') // add class to project01
           .reverse(false)
           .addTo(controller);
         });


  //parallax scene
  var parallaxTL = new TimelineMax();
  parallaxTL
  .from('.bcg-parallax'/*element*/, 4/*duration*/, {y: '-20%', ease:Power0.easeNone/*ofset*/}, 0)

  var sildeParallaxScene = new ScrollMagic.Scene({
    triggerElement: '.main-image',
    triggerHook: 1,
    duration: '100%'
  })
  .setTween(parallaxTL)
  .addTo(controller);


  var pinIntroScene2 = new ScrollMagic.Scene({
    triggerElement: '.main-image',
    triggerHook: 0,
    duration: '100%'
  })
  .setPin('.main-image', {pushFollowers: false})
  .addTo(controller);




      // buttons animation
      $('.buttons-main a').hover(
             function(){ $(this).addClass('pulse') },
             function(){ $(this).removeClass('pulse') }
      );




});






//console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
