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

$(function(){
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





});






//console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
