jQuery(document).ready(function($) {


// Search
$(".search-box i").on("click", function(){
    $(".search-overlay").toggleClass("search-overlay-active");
});
$(".search-overlay-close").on("click", function(){
    $(".search-overlay").removeClass("search-overlay-active");
});
// Search End


    // Mobile Nav
    $("#menu1").metisMenu();
    // MObile Nav End


    // Side menubar
    $("#close-btn, .toggle-btn").click(function() {
        $("#mySidenav, body").toggleClass("active");
    });

   // Search Toggle
   $("#search, #search1").click(function(){
      $(".search-toggle").slideToggle('fast');
  });
   // Search Toggle End


// Dropdown
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("fast");
            $(this).toggleClass('open');       
        }
        );
});
// Dropdown End



// News
$('#features').owlCarousel({
    loop:true,
    dots:false,
    margin:30,
    autoplay:false,
    autoplayTimeout:3000,
    nav:false,
    navText : ["<i class='las la-angle-left'></i>","<i class='las la-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        768:{
            items:2
        },
        992:{
            items:4
        }
    }
})
// News End



// News
$('#testimonials').owlCarousel({
    loop:true,
    dots:true,
    margin:30,
    autoplay:true,
    autoplayTimeout:5000,
    nav:false,
    navText : ["<i class='las la-angle-left'></i>","<i class='las la-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        768:{
            items:1
        },
        992:{
            items:1
        }
    }
})
// News End


// News
$('#partners').owlCarousel({
    loop:true,
    dots:false,
    margin:0,
    autoplay:true,
    autoplayTimeout:3000,
    nav:false,
    navText : ["<i class='las la-angle-left'></i>","<i class='las la-angle-right'></i>"],
    responsive:{
        0:{
            items:2
        },
        768:{
            items:3
        },
        992:{
            items:4
        }
    }
})
// News End




// Header active
var yourNavigation = $(".header");
stickyDiv = "active";
yourHeader = $('.header-part').height();

$(window).scroll(function() {
    if( $(this).scrollTop() > yourHeader ) {
        yourNavigation.addClass(stickyDiv);
    } else {
        yourNavigation.removeClass(stickyDiv);
    }
});

// Header Active End


// Scroll Top Js
$(function(){
        // Scroll Event
        $(window).on('scroll', function(){
            var scrolled = $(window).scrollTop();
            if (scrolled > 600) $('.go-top').addClass('active');
            if (scrolled < 600) $('.go-top').removeClass('active');
        });  
        // Click Event
        $('.go-top').on('click', function() {
            $("html, body").animate({ scrollTop: "0" },  300);
        });
    });

    // WOW Animation JS
    if($('.wow').length){
        var wow = new WOW({
            mobile: false
        });
        wow.init();
    }
// Scroll Top Js ENd




// Scroll Top Js
$(function(){
        // Scroll Event
        $(window).on('scroll', function(){
            var scrolled = $(window).scrollTop();
            if (scrolled > 800) $('.go-top').addClass('active');
            if (scrolled < 800) $('.go-top').removeClass('active');
        });  
        // Click Event
        $('.go-top').on('click', function() {
            $("html, body").animate({ scrollTop: "0" },  500);
        });
    });

    // WOW Animation JS
    if($('.wow').length){
        var wow = new WOW({
            mobile: false
        });
        wow.init();
    }
// Scroll Top Js ENd



// Thumbnail Slider
$('#image-gallery').lightSlider({
    gallery: true,
    item: 1,
    thumbItem: 6,
    slideMargin: 0,
    thumbMargin: 10,
    speed: 500,
    auto: true,
    loop: true,
    keyPress: true,
    controls: true,
    enableTouch: true,
    verticalHeight: 450,
    prevHtml: '<i class="fas fa-angle-left"></i>',
    nextHtml: '<i class="fas fa-angle-right"></i>',
    responsive: [{
        breakpoint: 767,
        settings: {
            thumbItem: 4,
        }
    },
    {
        breakpoint: 575,
        settings: {
            thumbItem: 3,
        }
    }
    ],
    onSliderLoad: function() {
        $('#image-gallery').removeClass('cS-hidden');
    }
});

    // Thumbnail Slider End




    // Gallery
    $(document).ready(function(){
      $('#lightgallery').lightGallery();
  });
// Gallery End



// Date Picker
$( function() {
    $( "#datepicker" ).datepicker();
} );
// Date Picker End


// Header active
var yourNavigation = $("#header");
stickyDiv = "active";
yourHeader = $('#header').height();

$(window).scroll(function() {
    if( $(this).scrollTop() > yourHeader ) {
        yourNavigation.addClass(stickyDiv);
    } else {
        yourNavigation.removeClass(stickyDiv);
    }
});

// Header Active End




});