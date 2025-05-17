/*
    Template Name: Jones - Education HTML Template
    Description: This is html5 template
    Author: HasTech
    Version: 1.0
*/
/*================================================
[  Table of contents  ]
================================================
	01. Sticky Menu
    02. Last 2 li child add class
	03. jQuery MeanMenu
	04. MagnificPopup
    05. Countdown
    06. Owl Carousel
    07. Counter Up
	08. ScrollUp
	09. Wow js
 
======================================
[ End table content ]
======================================*/

(function ($) {
"use strict";

/*------------------------------------
    01. Sticky Menu
-------------------------------------- */  
    var windows = $(window);
    var stick = $(".header-sticky");
	windows.on('scroll',function() {    
		var scroll = windows.scrollTop();
		if (scroll < 245) {
			stick.removeClass("sticky");
		}else{
			stick.addClass("sticky");
		}
	}); 
    
/*------------------------------------
    02. Last 2 li child add class
-------------------------------------- */  
    $('ul.menu>li').slice(-2).addClass('last-elements');
    
/*------------------------------------
    03. jQuery MeanMenu
-------------------------------------- */
	$('.main-menu nav').meanmenu({
		meanScreenWidth: "991",
		meanMenuContainer: '.mobile-menu'
	}); 
    
/*-------------------------------------
    04. MagnificPopup
--------------------------------------- */
     $('.video-popup').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        zoom: {
            enabled: true,
        }
    });
    
/*---------------------------------
    05. Countdown
----------------------------------- */	
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
        $this.html(event.strftime('<div class="count-column"><div class="cdown days"><span class="counting">%-D</span>Days</div></div><div class="count-column"><div class="cdown hours"><span class="counting">%-H</span>Hours</div></div><div class="count-column"><div class="cdown minutes"><span class="counting">%M</span>Minutes</div></div><div class="count-column"><div class="cdown seconds"><span class="counting">%S</span>Seconds</div></div>'));
        });
    });	
    
/*----------------------------------------
    06. Owl Carousel
---------------------------------------- */
/*----------------------------------------
    Product Slide
---------------------------------------- */
    $('.slider-wrapper').owlCarousel({
        loop:true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 2500,
        autoplay:true,
        autoplayTimeout:5000,
        items:1,
        nav:true,
        navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        dots:false
    });
/*----------------------------------------
    Course Carousel
---------------------------------------- */
    $('.course-carousel').owlCarousel({
        loop:true,
        items:3,
        nav:true,
        navText : ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            480:{
                items:1
            },
            768:{
                items:2
            }, 
            992:{
                items:3
            }, 
            1200:{
                items:3
            }
        }
    });
/*----------------------------------------
    Event Carousel
---------------------------------------- */
    $('.event-carousel').owlCarousel({
        loop:true,
        items:2,
        nav:true,
        navText : ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            480:{
                items:1
            },
            768:{
                items:1
            }, 
            992:{
                items:2
            }, 
            1200:{
                items:2
            }
        }
    });
/*----------------------------------------
    Testimonial Carousel
---------------------------------------- */
    $('.testimonial-carousel').owlCarousel({
        loop:true,
        items:2,
        nav:true,
        navText : ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            480:{
                items:1
            },
            768:{
                items:1
            }, 
            992:{
                items:2
            }, 
            1200:{
                items:2
            }
        }
    });
/*----------------------------------------
    Blog Carousel
---------------------------------------- */
    $('.blog-carousel').owlCarousel({
        loop:true,
        items:2,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            480:{
                items:1
            },
            768:{
                items:1
            }, 
            992:{
                items:2
            }, 
            1200:{
                items:2
            }
        }
    });
/*----------------------------------------
    Service Carousel
---------------------------------------- */
    $('.service-carousel').owlCarousel({
        loop:true,
        items:4,
        nav:true,
        navText : ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            480:{
                items:1
            },
            768:{
                items:2
            }, 
            992:{
                items:3
            }, 
            1200:{
                items:4
            }
        }
    });
/*----------------------------------------
    Testimonial Carousel Three
---------------------------------------- */
    $('.testimonial-carousel-three').owlCarousel({
        loop:true,
        items:1,
        nav:true,
        navText : ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            480:{
                items:1
            },
            768:{
                items:1
            }, 
            992:{
                items:1
            }, 
            1200:{
                items:1
            }
        }
    });
/*----------------------------------------
    Event Carousel Three
---------------------------------------- */
    $('.event-carousel-three').owlCarousel({
        loop:true,
        items:1,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            480:{
                items:1
            },
            768:{
                items:1
            }, 
            992:{
                items:1
            }, 
            1200:{
                items:1
            }
        }
    });
    
/*-----------------------------------------
    07. Counter Up
------------------------------------------ */	
    $('.counter').counterUp({
        delay: 70,
        time: 8000
    });
    
/*------------------------------------------
    08. ScrollUp
------------------------------------------- */	
	$.scrollUp({
        scrollText: '<i class="fa fa-long-arrow-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });  
    
/*------------------------------------------
    09. Wow js
-------------------------------------------- */    
    new WOW().init();
    
})(jQuery);	