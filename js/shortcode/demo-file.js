/*
  Author: Lumberjacks
  Template: Sawmill (HTML Template)
  Version: 1.0
  URL: http://themeforest.net/user/Lumberjacks/
*/

"use strict";

jQuery(document).ready(function (){

  jQuery(".quotes").slick({
    autoplay: true,
    autoplaySpeed: 5000,
    infinite: true,
    easing: 'easeInOutExpo',
    dots: true,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1
  });

});