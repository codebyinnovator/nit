<?php
include('connect.php'); // Include your database connection
include('header.php');
// Fetch slides from database
$query = "SELECT * FROM slider WHERE is_active = 1 ORDER BY sort_order ASC";
$result = mysqli_query($conn, $query);
$slides = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<!-- saved from url=(0058)https://demo.hasthemes.com/jones-preview/jones/index.html# -->
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths" lang="en" style=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style>body {transition: opacity ease-in 0.2s; } 
body[unresolved] {opacity: 0; display: block; overflow: hidden; position: relative; } 
/* Modern Slider Base */
.slider-two-area {
    position: relative;
    overflow: hidden;
    width: 100%;
}

.slider-wrapper {
    width: 100%;
    height: auto;
}

/* Fixed Background Image */
.single-slide {
    height: 70vh;
    min-height: 500px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    position: relative;
}

.slide-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

/* Content Styling */
.banner-content {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
}

.text-content-wrapper {
    padding: 40px;
    width: 100%;
}

/* Alignment classes */
.text-left {
    text-align: left;
}
.text-center {
    text-align: center;
}
.text-right {
    text-align: right;
}

/* Different font sizes for different sliders */
.slide-1 .text-content h1 {
    font-size: 4.8rem !important;
}
.slide-2 .text-content h1 {
    font-size: 6.5rem !important;
    width: 80%;
}

.text-content h1 {
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
}

.full-width-desc {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 30px;
    max-width: 900px;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
}

/* Make description respect alignment */
.text-left .full-width-desc {
    margin-right: auto;
}
.text-center .full-width-desc {
    margin-left: auto;
    margin-right: auto;
}
.text-right .full-width-desc {
    margin-left: auto;
}

/* Navigation */
.banner-owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    pointer-events: none;
}

.banner-owl-prev, .banner-owl-next {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex !important;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    pointer-events: auto;
    backdrop-filter: blur(5px);
    border: none;
    position: relative;
    margin: 0 20px;
}

/* Vibrant Button - Now for all slides */
.vibrant-btn {
    display: inline-flex;
    align-items: center;
    padding: 15px 35px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    color: white;
    background: linear-gradient(45deg, #FF6B6B, #FF8E53);
    box-shadow: 0 4px 20px rgba(255, 107, 107, 0.4);
    transition: all 0.4s ease;
    border: none;
}

/* Button alignment */
.text-left .vibrant-btn {
    margin-right: auto;
}
.text-center .vibrant-btn {
    margin-left: auto;
    margin-right: auto;
}
.text-right .vibrant-btn {
    margin-left: auto;
}

.vibrant-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(255, 107, 107, 0.6);
}

.vibrant-btn .btn-icon {
    margin-left: 10px;
    transition: transform 0.3s ease;
}

.vibrant-btn:hover .btn-icon {
    transform: translateX(5px);
}

/* Responsive Design */
@media (max-width: 992px) {
    .single-slide {
        height: 60vh;
        min-height: 400px;
    }
    
    .slide-1 .text-content h1 {
        font-size: 4rem !important;
    }
    .slide-2 .text-content h1 {
        font-size: 5rem !important;
    }
    
    .full-width-desc {
        font-size: 1.1rem;
        max-width: 80%;
    }
}

@media (max-width: 768px) {
    .single-slide {
        height: 50vh !important;
        min-height: 100px;
    }

    .slide-1 .text-content h1 {
        font-size: 3.6rem !important;
    }
    .slide-2 .text-content h1 {
        font-size: 4rem !important;
        line-height: 1.5 !important;
    }
    
    .text-content h1 {
        font-size: 2rem;
        margin-bottom: 15px;
    }
    
    .full-width-desc {
        font-size: 1rem;
        max-width: 90%;
        margin-bottom: 20px;
    }
    
    .text-content-wrapper {
        padding: 20px;
    }
    
    .vibrant-btn {
        padding: 12px 25px;
        font-size: 1.4rem;
    }
}

@media (max-width: 576px) {

    .slide-1 .text-content h1 {
        font-size: 2.6rem !important;
    }
    .slide-2 .text-content h1 {
        font-size: 3rem !important;
        line-height: 1.5 !important;
    }
    .single-slide {
        height: 45vh !important;
        min-height: 200px;
    }
    
    .text-content h1 {
        font-size: 1.5rem;
    }
    
    .full-width-desc {
        font-size: 1.2rem;
        max-width: 100%;
        line-height: 1.5;
    }
    
    .banner-owl-prev, .banner-owl-next {
        width: 35px;
        height: 35px;
        margin: 0 5px;
    }
    
    .vibrant-btn {
        padding: 10px 20px;
        font-size: 1.2rem;
    }
}
</style>
        
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Jones - Education HTML Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Place favicon.ico in the root directory -->
        
        <link rel="stylesheet" href="./Jones - Education HTML Template_files/bootstrap.min.css">
        <link rel="stylesheet" href="./Jones - Education HTML Template_files/meanmenu.css">
        <link rel="stylesheet" href="./Jones - Education HTML Template_files/animate.css">
        <link rel="stylesheet" href="./Jones - Education HTML Template_files/magnific-popup.css">
        <link rel="stylesheet" href="./Jones - Education HTML Template_files/owl.carousel.min.css">
        <link rel="stylesheet" href="./Jones - Education HTML Template_files/font-awesome.min.css">
        <link rel="stylesheet" href="./Jones - Education HTML Template_files/style.css">
        <link rel="stylesheet" href="./Jones - Education HTML Template_files/responsive.css">
        <script src="./Jones - Education HTML Template_files/modernizr-2.8.3.min.js"></script>
        <!-- Font Awesome CSS (Free version - latest 6.x) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<!-- Slider Two Area Start -->
		<div class="slider-two-area">    
            <div class="slider-wrapper owl-carousel">
                <?php foreach ($slides as $index => $slide): ?>
                <div class="single-slide slide-<?php echo $index + 1; ?>" style="background-image: url('<?php echo htmlspecialchars($slide['image_path']); ?>')">
                    <div class="slide-overlay"></div>
                    <div class="banner-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-content-wrapper <?php echo ($slide['content_position'] == 'center') ? 'text-center' : 'text-'.$slide['content_position']; ?>">
                                        <div class="text-content">
                                            <h1 style="color: <?php echo htmlspecialchars($slide['title_color']); ?>">
                                                <?php echo htmlspecialchars($slide['title']); ?>
                                            </h1>
                                            <?php if (!empty($slide['description'])): ?>
                                            <p class="full-width-desc" style="color: <?php echo htmlspecialchars($slide['text_color']); ?>">
                                                <?php echo htmlspecialchars($slide['description']); ?>
                                            </p>
                                            <?php endif; ?>
                                            <div class="banner-btn">
                                                <a href="view_courses.php" class="vibrant-btn">
                                                    View Courses
                                                    <span class="btn-icon">→</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

		<!-- Slider Two Area End -->
        <!-- Features Two Area Start -->
        <section class="features-two-area ptb-150">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="ht-single-features-wrapper">
                            <div class="ht-single-features">
                                <img src="./Jones - Education HTML Template_files/book.png" class="ht-f-icon" alt="">
                                <div class="ht-f-text">
                                    <h4>Books &amp; Library</h4>
                                    <p>Lorem ipsum dolor consecteturs adipiscing elit. Pellentes fring illa dolor sit amet turpis.</p>
                                </div>
                                <span>1</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ht-single-features-wrapper">
                            <div class="ht-single-features">
                                <img src="./Jones - Education HTML Template_files/taking_face.png" class="ht-f-icon" alt="">
                                <div class="ht-f-text">
                                    <h4>online courses</h4>
                                    <p>Lorem ipsum dolor consecteturs adipiscing elit. Pellentes fring illa dolor sit amet turpis.</p>
                                </div>
                                <span>2</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ht-single-features-wrapper">
                            <div class="ht-single-features">
                                <img src="./Jones - Education HTML Template_files/face.png" class="ht-f-icon" alt="">
                                <div class="ht-f-text">
                                    <h4>Best Industry Leader</h4>
                                    <p>Lorem ipsum dolor consecteturs adipiscing elit. Pellentes fring illa dolor sit amet turpis.</p>
                                </div>
                                <span>3</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features Two Area End -->
        <!-- About Fun Area Two Start -->
        <div class="about-fun-area-two bg-dark-blue fix">
            <div class="about-container">
                <div class="about-content">
                    <h1>About Us</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris efficitur id lore fringillas. Sed eget cursus mi, ut auctor tellus. Curabitur suscipit venenatis hendrerit. sapien, consequat ut mattis a, fringilla sit amet magna. Donec egestas gravida metusa porta. Mauris vestibulum enim sed laoreet egestas. Suspendisse et erat ac libero</p>
                    <p>aliquam aliquet facilisis quis ipsum. Curabitur tempor ultricies nulla. Duis urn orci,ornare laoreet sed, cursus eu tortor Nullam sed blandit.</p>
                </div>
                <div class="fun-factor-wrapper">
                    <div class="single-fun-factor">
                        <h1><span class="counter">96</span></h1>
                        <h5>Courses</h5>
                    </div>
                    <div class="single-fun-factor">
                        <h1><span class="counter">40</span></h1>
                        <h5>Teachers</h5>
                    </div>
                    <div class="single-fun-factor">
                        <h1><span class="counter">300</span></h1>
                        <h5>Students</h5>
                    </div>
                    <div class="single-fun-factor">
                        <h1><span class="counter">950</span></h1>
                        <h5>Books</h5>
                    </div>
                </div>
            </div>
            <div class="about-image-container">
                <div class="ht-video-bg">
                    <a class="video-popup" href="https://www.youtube.com/watch?v=JzHEtFDBoks">
                        <i class="fa fa-play"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- About Fun Two Area End -->
        <!-- Course Area Start -->
        <section class="course-area pt-150 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-8 col-sm-10">
                        <div class="section-wrapper">
                            <div class="section-title">
                                <h3>Our Courses</h3>
                                <p>Proin accumsan est ac iaculis ullamcorper. Integer euismod hendrerit urna Quisque a varius augue, sed elementum lacus. Integer convallis quis</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="ht-single-course hover">
                            <div class="ht-course-top">
                                <div class="course-top-left">
                                    <img src="./Jones - Education HTML Template_files/1.jpg" alt="">
                                    <div class="course-teacher-name">
                                        <h5>Alex bin do</h5>
                                        <span>Business</span>
                                    </div>
                                </div>
                                <span class="course-fee">Free</span>
                            </div>
                            <div class="ht-course-image">
                                <a href="https://demo.hasthemes.com/jones-preview/jones/course.html" class="hover-effect">
                                    <img src="./Jones - Education HTML Template_files/1(1).jpg" alt="">
                                </a>
                            </div>
                            <div class="ht-course-text">
                                <div class="ht-course-meta">
                                    <span><i class="fa fa-user"></i>8086</span>
                                    <span><i class="fa fa-comments"></i>90</span>
                                    <div class="ht-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <h4>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/course.html">Lorem ipsum dolor sit amet, cosec eteture adipiscing.</a>
                                </h4>
                                <a href="https://demo.hasthemes.com/jones-preview/jones/course.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="ht-single-course hover">
                            <div class="ht-course-top">
                                <div class="course-top-left">
                                    <img src="./Jones - Education HTML Template_files/2.jpg" alt="">
                                    <div class="course-teacher-name">
                                        <h5>sathy Bhuiyan</h5>
                                        <span>Arts</span>
                                    </div>
                                </div>
                                <span class="course-fee">$55.00</span>
                            </div>
                            <div class="ht-course-image">
                                <a href="https://demo.hasthemes.com/jones-preview/jones/course.html" class="hover-effect">
                                    <img src="./Jones - Education HTML Template_files/2(1).jpg" alt="">
                                </a>
                            </div>
                            <div class="ht-course-text">
                                <div class="ht-course-meta">
                                    <span><i class="fa fa-user"></i>8086</span>
                                    <span><i class="fa fa-comments"></i>90</span>
                                    <div class="ht-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <h4>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/course.html">Lorem ipsum dolor sit amet, cosec eteture adipiscing.</a>
                                </h4>
                                <a href="https://demo.hasthemes.com/jones-preview/jones/course.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="ht-single-course hover">
                            <div class="ht-course-top">
                                <div class="course-top-left">
                                    <img src="./Jones - Education HTML Template_files/3.jpg" alt="">
                                    <div class="course-teacher-name">
                                        <h5>sathy noor</h5>
                                        <span>Mathmetics</span>
                                    </div>
                                </div>
                                <span class="course-fee"><span class="prev-free">$70.00</span>$35.00</span>
                            </div>
                            <div class="ht-course-image">
                                <a href="https://demo.hasthemes.com/jones-preview/jones/course.html" class="hover-effect">
                                    <img src="./Jones - Education HTML Template_files/3(1).jpg" alt="">
                                    <span class="discount">50%<span>OFF</span></span>
                                </a>
                            </div>
                            <div class="ht-course-text">
                                <div class="ht-course-meta">
                                    <span><i class="fa fa-user"></i>8086</span>
                                    <span><i class="fa fa-comments"></i>90</span>
                                    <div class="ht-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <h4>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/course.html">Lorem ipsum dolor sit amet, cosec eteture adipiscing.</a>
                                </h4>
                                <a href="https://demo.hasthemes.com/jones-preview/jones/course.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Course Area End -->
        <!-- Registration Info Area Start -->
        <div class="registration-info-area pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div class="registration-info-wrapper">
                            <h1>Registration Now</h1>
                            <h2>Get 50 Courses Only <span>$99</span></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris efficituid lore fringillas. Sed eget cursus mi, ut auctor tellus. Curabitur suscipit venenatis hendrerit. sapien, consequat ut mattis a, fringilla sit amet magna.</p>
                            <div class="registration-countdown">
                                <div class="timer">
                                    <div data-countdown="2017/11/01" class="timer-grid"><div class="count-column"><div class="cdown days"><span class="counting">0</span>Days</div></div><div class="count-column"><div class="cdown hours"><span class="counting">0</span>Hours</div></div><div class="count-column"><div class="cdown minutes"><span class="counting">00</span>Minutes</div></div><div class="count-column"><div class="cdown seconds"><span class="counting">00</span>Seconds</div></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="registration-small-form">
                            <h4>Registration</h4>
                            <form action="https://demo.hasthemes.com/jones-preview/jones/index.html#" method="post">
                                <input type="text" placeholder="Name*">
                                <input type="text" placeholder="Email*">
                                <input type="text" placeholder="Phone*">
                                <input type="text" placeholder="Accounts">
                                <button type="button" class="default-btn">Get IT Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Registration Info Area End -->
        <!-- Events Two Area Start -->
        <section class="event-two-area pt-150 pb-145 bg-dark-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-8 col-sm-10">
                        <div class="section-wrapper">
                            <div class="section-title style-2 text-white">
                                <h3>Our Events</h3>
                                <p>Proin accumsan est ac iaculis ullamcorper. Integer euismod hendrerit urna Quisque a varius augue, sed elementum lacus. Integer convallis quis</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="event-carousel owl-carousel carousel-style-1 owl-loaded owl-drag">
                        
                        
                        
                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1200px, 0px, 0px); transition: all; width: 4200px;"><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-event">
                                <div class="ht-event-image">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/event.html"><img src="./Jones - Education HTML Template_files/4.jpg" alt=""></a>
                                </div>
                                <div class="ht-event-text">
                                    <div class="ht-event-meta">
                                        <span class="event-date">15<span>June</span></span>
                                        <div class="event-title">
                                            <h4><a href="https://demo.hasthemes.com/jones-preview/jones/event.html">Womans day</a></h4>
                                            <span><i class="fa fa-clock-o"></i>10.30 AM - 15.30 PM</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris efficitur  lore fringillas. Sed eget cursus mi, ut auctor tellus. Curabitur suscipit venenatis sapien, consequat ut mattis a, fringilla sit amet magna.</p>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-event">
                                <div class="ht-event-image">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/event.html"><img src="./Jones - Education HTML Template_files/5.jpg" alt=""></a>
                                </div>
                                <div class="ht-event-text">
                                    <div class="ht-event-meta">
                                        <span class="event-date">25<span>march</span></span>
                                        <div class="event-title">
                                            <h4><a href="https://demo.hasthemes.com/jones-preview/jones/event.html">Womans day</a></h4>
                                            <span><i class="fa fa-clock-o"></i>10.30 AM - 15.30 PM</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris efficitur  lore fringillas. Sed eget cursus mi, ut auctor tellus. Curabitur suscipit venenatis sapien, consequat ut mattis a, fringilla sit amet magna.</p>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-event">
                                <div class="ht-event-image">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/event.html"><img src="./Jones - Education HTML Template_files/3(2).jpg" alt=""></a>
                                </div>
                                <div class="ht-event-text">
                                    <div class="ht-event-meta">
                                        <span class="event-date">25<span>march</span></span>
                                        <div class="event-title">
                                            <h4><a href="https://demo.hasthemes.com/jones-preview/jones/event.html">Womans day</a></h4>
                                            <span><i class="fa fa-clock-o"></i>10.30 AM - 15.30 PM</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris efficitur  lore fringillas. Sed eget cursus mi, ut auctor tellus. Curabitur suscipit venenatis sapien, consequat ut mattis a, fringilla sit amet magna.</p>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-event">
                                <div class="ht-event-image">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/event.html"><img src="./Jones - Education HTML Template_files/4.jpg" alt=""></a>
                                </div>
                                <div class="ht-event-text">
                                    <div class="ht-event-meta">
                                        <span class="event-date">15<span>June</span></span>
                                        <div class="event-title">
                                            <h4><a href="https://demo.hasthemes.com/jones-preview/jones/event.html">Womans day</a></h4>
                                            <span><i class="fa fa-clock-o"></i>10.30 AM - 15.30 PM</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris efficitur  lore fringillas. Sed eget cursus mi, ut auctor tellus. Curabitur suscipit venenatis sapien, consequat ut mattis a, fringilla sit amet magna.</p>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-event">
                                <div class="ht-event-image">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/event.html"><img src="./Jones - Education HTML Template_files/5.jpg" alt=""></a>
                                </div>
                                <div class="ht-event-text">
                                    <div class="ht-event-meta">
                                        <span class="event-date">25<span>march</span></span>
                                        <div class="event-title">
                                            <h4><a href="https://demo.hasthemes.com/jones-preview/jones/event.html">Womans day</a></h4>
                                            <span><i class="fa fa-clock-o"></i>10.30 AM - 15.30 PM</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris efficitur  lore fringillas. Sed eget cursus mi, ut auctor tellus. Curabitur suscipit venenatis sapien, consequat ut mattis a, fringilla sit amet magna.</p>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-event">
                                <div class="ht-event-image">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/event.html"><img src="./Jones - Education HTML Template_files/3(2).jpg" alt=""></a>
                                </div>
                                <div class="ht-event-text">
                                    <div class="ht-event-meta">
                                        <span class="event-date">25<span>march</span></span>
                                        <div class="event-title">
                                            <h4><a href="https://demo.hasthemes.com/jones-preview/jones/event.html">Womans day</a></h4>
                                            <span><i class="fa fa-clock-o"></i>10.30 AM - 15.30 PM</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris efficitur  lore fringillas. Sed eget cursus mi, ut auctor tellus. Curabitur suscipit venenatis sapien, consequat ut mattis a, fringilla sit amet magna.</p>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-event">
                                <div class="ht-event-image">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/event.html"><img src="./Jones - Education HTML Template_files/4.jpg" alt=""></a>
                                </div>
                                <div class="ht-event-text">
                                    <div class="ht-event-meta">
                                        <span class="event-date">15<span>June</span></span>
                                        <div class="event-title">
                                            <h4><a href="https://demo.hasthemes.com/jones-preview/jones/event.html">Womans day</a></h4>
                                            <span><i class="fa fa-clock-o"></i>10.30 AM - 15.30 PM</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris efficitur  lore fringillas. Sed eget cursus mi, ut auctor tellus. Curabitur suscipit venenatis sapien, consequat ut mattis a, fringilla sit amet magna.</p>
                                </div>
                            </div>
                        </div></div></div></div><div class="banner-owl-nav"><div class="banner-owl-prev"><i class="fa fa-long-arrow-left"></i></div><div class="banner-owl-next"><i class="fa fa-long-arrow-right"></i></div></div><div class="owl-dots"><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div></div></div>
                </div>
            </div>
        </section>
        <!-- Events Two Area End -->
        <!-- Blog Two Area Start -->
        <section class="blog-two-area ptb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-8 col-sm-10">
                        <div class="section-wrapper">
                            <div class="section-title text-dark">
                                <h3>Our latest blog</h3>
                                <p>Proin accumsan est ac iaculis ullamcorper. Integer euismod hendrerit urna Quisque a varius augue, sed elementum lacus. Integer convallis quis</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="blog-carousel owl-carousel owl-loaded owl-drag">
                        
                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1200px, 0px, 0px); transition: all; width: 3000px;"><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-blog">
                                <div class="ht-blog-img">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html"><img src="./Jones - Education HTML Template_files/4(1).jpg" alt=""></a>
                                </div>
                                <div class="ht-blog-text">
                                    <span class="ht-post-meta">17 May 2017</span>
                                    <h4>
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Mauris vehicula euismass eleifend lorem ipsum eu.</a>
                                    </h4>
                                    <p>Lorem ipsum dolor sit ame, consctetursm adipiscing elit. Mauris efficitur idss,</p>
                                    <div class="ht-blog-btn-links">
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                                        <div class="social-links">
                                            <a href="https://www.facebook.com/devitems/"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/devitemsllc/"><i class="fa fa-twitter"></i></a>
                                            <a href="https://plus.google.com/117030536115448126648"><i class="fa fa-google-plus"></i></a>
                                            <a href="https://www.pinterest.com/devitems/"><i class="fa fa-pinterest-p"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-blog">
                                <div class="ht-blog-img">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html"><img src="./Jones - Education HTML Template_files/4(1).jpg" alt=""></a>
                                </div>
                                <div class="ht-blog-text">
                                    <span class="ht-post-meta">17 May 2017</span>
                                    <h4>
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Mauris vehicula euismass eleifend lorem ipsum eu.</a>
                                    </h4>
                                    <p>Lorem ipsum dolor sit ame, consctetursm adipiscing elit. Mauris efficitur idss,</p>
                                    <div class="ht-blog-btn-links">
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                                        <div class="social-links">
                                            <a href="https://www.facebook.com/devitems/"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/devitemsllc/"><i class="fa fa-twitter"></i></a>
                                            <a href="https://plus.google.com/117030536115448126648"><i class="fa fa-google-plus"></i></a>
                                            <a href="https://www.pinterest.com/devitems/"><i class="fa fa-pinterest-p"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-blog">
                                <div class="ht-blog-img">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html"><img src="./Jones - Education HTML Template_files/4(1).jpg" alt=""></a>
                                </div>
                                <div class="ht-blog-text">
                                    <span class="ht-post-meta">17 May 2017</span>
                                    <h4>
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Mauris vehicula euismass eleifend lorem ipsum eu.</a>
                                    </h4>
                                    <p>Lorem ipsum dolor sit ame, consctetursm adipiscing elit. Mauris efficitur idss,</p>
                                    <div class="ht-blog-btn-links">
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                                        <div class="social-links">
                                            <a href="https://www.facebook.com/devitems/"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/devitemsllc/"><i class="fa fa-twitter"></i></a>
                                            <a href="https://plus.google.com/117030536115448126648"><i class="fa fa-google-plus"></i></a>
                                            <a href="https://www.pinterest.com/devitems/"><i class="fa fa-pinterest-p"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned active" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-blog">
                                <div class="ht-blog-img">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html"><img src="./Jones - Education HTML Template_files/4(1).jpg" alt=""></a>
                                </div>
                                <div class="ht-blog-text">
                                    <span class="ht-post-meta">17 May 2017</span>
                                    <h4>
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Mauris vehicula euismass eleifend lorem ipsum eu.</a>
                                    </h4>
                                    <p>Lorem ipsum dolor sit ame, consctetursm adipiscing elit. Mauris efficitur idss,</p>
                                    <div class="ht-blog-btn-links">
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                                        <div class="social-links">
                                            <a href="https://www.facebook.com/devitems/"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/devitemsllc/"><i class="fa fa-twitter"></i></a>
                                            <a href="https://plus.google.com/117030536115448126648"><i class="fa fa-google-plus"></i></a>
                                            <a href="https://www.pinterest.com/devitems/"><i class="fa fa-pinterest-p"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-single-blog">
                                <div class="ht-blog-img">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html"><img src="./Jones - Education HTML Template_files/4(1).jpg" alt=""></a>
                                </div>
                                <div class="ht-blog-text">
                                    <span class="ht-post-meta">17 May 2017</span>
                                    <h4>
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Mauris vehicula euismass eleifend lorem ipsum eu.</a>
                                    </h4>
                                    <p>Lorem ipsum dolor sit ame, consctetursm adipiscing elit. Mauris efficitur idss,</p>
                                    <div class="ht-blog-btn-links">
                                        <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                                        <div class="social-links">
                                            <a href="https://www.facebook.com/devitems/"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/devitemsllc/"><i class="fa fa-twitter"></i></a>
                                            <a href="https://plus.google.com/117030536115448126648"><i class="fa fa-google-plus"></i></a>
                                            <a href="https://www.pinterest.com/devitems/"><i class="fa fa-pinterest-p"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div><div class="owl-dots disabled"><div class="owl-dot active"><span></span></div></div></div>
                </div>
            </div>
        </section>
        <!-- Blog Two Area End -->
        <!-- Testimonial Two Area Start -->
        <section class="testimonial-two-area bg-2 overlay-green pt-150 pb-145">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-8 col-sm-10">
                        <div class="section-wrapper">
                            <div class="section-title style-2 text-white">
                                <h3>our client reviews</h3>
                                <p>Proin accumsan est ac iaculis ullamcorper. Integer euismod hendrerit urna Quisque a varius augue, sed elementum lacus. Integer convallis quis</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="testimonial-carousel owl-carousel carousel-style-1 owl-loaded owl-drag">
                        
                        
                        
                        
                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1200px, 0px, 0px); transition: all; width: 4800px;"><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-testimonial-two dark">
                                <div class="ht-testi-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. quam sodales, libero eget posuere sodales, massa orci blanditma uris, sed finibus lorem est non enim. Vivamus sed eleifend sapien. Nam at ipsum urna. Suspendisse vitae</p>
                                    <span class="testi-img"><img src="./Jones - Education HTML Template_files/1(2).jpg" alt=""></span>
                                    <h5>Wiliam Alex</h5>
                                    <span>CEO at Design</span>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-testimonial-two">
                                <div class="ht-testi-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. quam sodales, libero eget posuere sodales, massa orci blanditma uris, sed finibus lorem est non enim. Vivamus sed eleifend sapien. Nam at ipsum urna. Suspendisse vitae</p>
                                    <span class="testi-img"><img src="./Jones - Education HTML Template_files/2(2).jpg" alt=""></span>
                                    <h5>Alex Bin Do</h5>
                                    <span>Senior Designer</span>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-testimonial-two dark">
                                <div class="ht-testi-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. quam sodales, libero eget posuere sodales, massa orci blanditma uris, sed finibus lorem est non enim. Vivamus sed eleifend sapien. Nam at ipsum urna. Suspendisse vitae</p>
                                    <span class="testi-img"><img src="./Jones - Education HTML Template_files/1(2).jpg" alt=""></span>
                                    <h5>Sathy Bhuiyan</h5>
                                    <span>CEO at Design</span>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-testimonial-two">
                                <div class="ht-testi-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. quam sodales, libero eget posuere sodales, massa orci blanditma uris, sed finibus lorem est non enim. Vivamus sed eleifend sapien. Nam at ipsum urna. Suspendisse vitae</p>
                                    <span class="testi-img"><img src="./Jones - Education HTML Template_files/2(2).jpg" alt=""></span>
                                    <h5>Alex Bin Do</h5>
                                    <span>Senior Designer</span>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-testimonial-two dark">
                                <div class="ht-testi-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. quam sodales, libero eget posuere sodales, massa orci blanditma uris, sed finibus lorem est non enim. Vivamus sed eleifend sapien. Nam at ipsum urna. Suspendisse vitae</p>
                                    <span class="testi-img"><img src="./Jones - Education HTML Template_files/1(2).jpg" alt=""></span>
                                    <h5>Wiliam Alex</h5>
                                    <span>CEO at Design</span>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-testimonial-two">
                                <div class="ht-testi-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. quam sodales, libero eget posuere sodales, massa orci blanditma uris, sed finibus lorem est non enim. Vivamus sed eleifend sapien. Nam at ipsum urna. Suspendisse vitae</p>
                                    <span class="testi-img"><img src="./Jones - Education HTML Template_files/2(2).jpg" alt=""></span>
                                    <h5>Alex Bin Do</h5>
                                    <span>Senior Designer</span>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-testimonial-two dark">
                                <div class="ht-testi-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. quam sodales, libero eget posuere sodales, massa orci blanditma uris, sed finibus lorem est non enim. Vivamus sed eleifend sapien. Nam at ipsum urna. Suspendisse vitae</p>
                                    <span class="testi-img"><img src="./Jones - Education HTML Template_files/1(2).jpg" alt=""></span>
                                    <h5>Sathy Bhuiyan</h5>
                                    <span>CEO at Design</span>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 600px;"><div class="col-xs-12">
                            <div class="ht-testimonial-two">
                                <div class="ht-testi-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. quam sodales, libero eget posuere sodales, massa orci blanditma uris, sed finibus lorem est non enim. Vivamus sed eleifend sapien. Nam at ipsum urna. Suspendisse vitae</p>
                                    <span class="testi-img"><img src="./Jones - Education HTML Template_files/2(2).jpg" alt=""></span>
                                    <h5>Alex Bin Do</h5>
                                    <span>Senior Designer</span>
                                </div>
                            </div>
                        </div></div></div></div><div class="owl-nav"><div class="owl-prev"><i class="fa fa-long-arrow-left"></i></div><div class="owl-next"><i class="fa fa-long-arrow-right"></i></div></div><div class="owl-dots"><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div></div></div>
                </div>
            </div>
        </section>
        <!-- Testimonial Two Area End -->
        <!-- Service Area Start -->
        <div class="service-area pt-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-8 col-sm-10">
                        <div class="section-wrapper">
                            <div class="section-title style-2 text-dark">
                                <h3>Learn Something New</h3>
                                <p>Proin accumsan est ac iaculis ullamcorper. Integer euismod hendrerit urna Quisque a varius augue, sed elementum lacus. Integer convallis quis</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="service-carousel owl-carousel carousel-style-1 owl-loaded owl-drag">
                        
                        
                        
                        
                        
                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1200px, 0px, 0px); transition: all; width: 3900px;"><div class="owl-item cloned" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-dark-blue">
                                <div class="ht-service">
                                    <span class="srv-fee">$60.00</span>
                                    <span class="fearures-icon"><i class="fa fa-mobile"></i></span>
                                    <h5>Mobile App</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-green">
                                <div class="ht-service">
                                    <span class="srv-fee">$80.00</span>
                                    <span class="fearures-icon"><i class="fa fa-laptop"></i></span>
                                    <h5>Developing</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-dark-blue">
                                <div class="ht-service">
                                    <span class="srv-fee">$30.00</span>
                                    <span class="fearures-icon"><i class="fa fa-android"></i></span>
                                    <h5>Android</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-dark-blue">
                                <div class="ht-service">
                                    <span class="srv-fee">$80.00</span>
                                    <span class="fearures-icon"><i class="fa fa-laptop"></i></span>
                                    <h5>Developing</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-green">
                                <div class="ht-service">
                                    <span class="srv-fee">$50.00</span>
                                    <span class="fearures-icon"><i class="fa fa-paint-brush"></i></span>
                                    <h5>Graphic Design</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-dark-blue">
                                <div class="ht-service">
                                    <span class="srv-fee">$60.00</span>
                                    <span class="fearures-icon"><i class="fa fa-mobile"></i></span>
                                    <h5>Mobile App</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-green">
                                <div class="ht-service">
                                    <span class="srv-fee">$80.00</span>
                                    <span class="fearures-icon"><i class="fa fa-laptop"></i></span>
                                    <h5>Developing</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-dark-blue">
                                <div class="ht-service">
                                    <span class="srv-fee">$30.00</span>
                                    <span class="fearures-icon"><i class="fa fa-android"></i></span>
                                    <h5>Android</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-dark-blue">
                                <div class="ht-service">
                                    <span class="srv-fee">$80.00</span>
                                    <span class="fearures-icon"><i class="fa fa-laptop"></i></span>
                                    <h5>Developing</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-green">
                                <div class="ht-service">
                                    <span class="srv-fee">$50.00</span>
                                    <span class="fearures-icon"><i class="fa fa-paint-brush"></i></span>
                                    <h5>Graphic Design</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-dark-blue">
                                <div class="ht-service">
                                    <span class="srv-fee">$60.00</span>
                                    <span class="fearures-icon"><i class="fa fa-mobile"></i></span>
                                    <h5>Mobile App</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-green">
                                <div class="ht-service">
                                    <span class="srv-fee">$80.00</span>
                                    <span class="fearures-icon"><i class="fa fa-laptop"></i></span>
                                    <h5>Developing</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 300px;"><div class="col-xs-12">
                            <div class="ht-service-wrapper bg-dark-blue">
                                <div class="ht-service">
                                    <span class="srv-fee">$30.00</span>
                                    <span class="fearures-icon"><i class="fa fa-android"></i></span>
                                    <h5>Android</h5>
                                    <p>Lorem ipsum dolor sit amets. consectetur adipiscing elit. </p>
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div></div></div></div><div class="owl-nav"><div class="owl-prev"><i class="fa fa-long-arrow-left"></i></div><div class="owl-next"><i class="fa fa-long-arrow-right"></i></div></div><div class="owl-dots"><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div></div></div>
                </div>
            </div>
        </div>
        <!-- Service Area End -->
        <!-- Newsletter Area Start -->
       
        <!--Start of Search Form-->
        <div class="modal fade" id="search_box" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <form class="search-pop-up" action="https://demo.hasthemes.com/jones-preview/jones/index.html#" method="post">
                            <input type="text" placeholder="Search..........">
                            <button type="button"><i class="fa fa-search"></i></button>
                        </form>
                    </div>	
                </div>	
            </div>
        </div>
        <!--End of Search Form-->
        <!--Start of Login Form-->
        <div class="modal fade" id="login_box" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="signup-links-container sign-up-box">
                            <h3 class="sub-title">Login with social Network</h3>
                            <a href="https://www.facebook.com/devitems/" class="facebook">
                                <i class="fa fa-facebook"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="https://plus.google.com/117030536115448126648" class="google">
                                <i class="fa fa-google-plus"></i>
                                <span>Google</span>
                            </a>
                            <a href="https://twitter.com/devitemsllc/" class="twitter">
                                <i class="fa fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="https://www.linkedin.com/company/devitems-llc" class="linkedin">
                                <i class="fa fa-linkedin"></i>
                                <span>Linkedin</span>
                            </a>
                        </div>
                        <div class="signup-form-container sign-up-box">
                            <h3 class="sub-title">Login with your site account</h3>
                            <form action="https://demo.hasthemes.com/jones-preview/jones/index.html#" method="post" class="signup-form">
                                <input type="text" placeholder="User Name Or Email" name="f_name">
                                <input type="password" placeholder="Password" name="password">
                                <div class="from-wrap">
                                    <div class="form-left"><input type="checkbox"> Remember Me</div>
                                    <div class="form-right"><a href="https://demo.hasthemes.com/jones-preview/jones/index.html#">Lost Your Password?</a></div>
                                </div>
                                <button type="submit" class="default-btn">Login</button>
                                <p>Not a Member Yet? <a href="https://demo.hasthemes.com/jones-preview/jones/signup.html">Register Now</a></p>
                            </form>
                        </div>
                    </div>	
                </div>	
            </div>
        </div>
        <!--End of Login Form-->
        
        <script src="./Jones - Education HTML Template_files/jquery-1.12.4.min.js"></script>
        <script src="./Jones - Education HTML Template_files/bootstrap.min.js"></script>
        <script src="./Jones - Education HTML Template_files/jquery.meanmenu.js"></script>
        <script src="./Jones - Education HTML Template_files/jquery.magnific-popup.js"></script>
        <script src="./Jones - Education HTML Template_files/jquery.countdown.min.js"></script>
        <script src="./Jones - Education HTML Template_files/ajax-mail.js"></script>
        <script src="./Jones - Education HTML Template_files/owl.carousel.min.js"></script>
        <script src="./Jones - Education HTML Template_files/plugins.js"></script>
        <script src="./Jones - Education HTML Template_files/main.js"></script><a id="scrollUp" href="https://demo.hasthemes.com/jones-preview/jones/index.html#top" style="position: fixed; z-index: 2147483647;"><i class="fa fa-long-arrow-up"></i></a>

        <script>
            $(document).ready(function(){
                $(".slider-wrapper").owlCarousel({
                    items: 1,
                    loop: true,
                    nav: true,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    animateOut: 'fadeOut',
                    navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
                });
            });
        </script>
    
<veepn-lock-screen><template shadowrootmode="open"><style>html{box-sizing:border-box;text-size-adjust:100%;word-break:normal;-moz-tab-size:4;tab-size:4}*,:before,:after{background-repeat:no-repeat;box-sizing:border-box}:before,:after{text-decoration:inherit;vertical-align:inherit}*{padding:0;margin:0}hr{overflow:visible;height:0;color:inherit;border:0;border-top:1px solid}details,main{display:block}summary{display:list-item}small{font-size:80%}[hidden]{display:none!important}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}a{background-color:transparent}a:active,a:hover{outline-width:0}code,kbd,pre,samp{font-family:monospace}pre{font-size:1em}b,strong{font-weight:bolder}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{border-color:inherit;text-indent:0}iframe{border-style:none}input{border-radius:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;-moz-appearance:textfield;appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-decoration{-webkit-appearance:none;-moz-appearance:none;appearance:none}textarea{overflow:auto;resize:vertical}button,input,optgroup,select,textarea{font:inherit;color:inherit}optgroup{font-weight:700}button{overflow:visible}button,select{text-transform:none}button,[type=button],[type=reset],[type=submit],[role=button]{cursor:pointer}button::-moz-focus-inner,[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{border-style:none;padding:0}button,html [type=button],[type=reset],[type=submit]{-webkit-appearance:button;-moz-appearance:button;appearance:button}button,input,select,textarea{background-color:transparent;border-style:none}button:-moz-focusring,[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{outline:1px dotted ButtonText}select{-webkit-appearance:none;-moz-appearance:none;appearance:none}a:focus,button:focus,input:focus,select:focus,textarea:focus{outline-width:0}select::-ms-expand{display:none}select::-ms-value{color:currentcolor}legend{border:0;color:inherit;display:table;white-space:normal;max-width:100%}::-webkit-file-upload-button{-webkit-appearance:button;-moz-appearance:button;appearance:button;color:inherit;font:inherit}[disabled]{cursor:default}img{border-style:none}progress{vertical-align:baseline}[aria-busy=true]{cursor:progress}[aria-controls]{cursor:pointer}[aria-disabled=true]{cursor:default}ul,ol{list-style-type:none}figure{margin:0}.lock-screen{font-family:FigtreeVF,sans-serif;letter-spacing:normal;position:fixed;z-index:2147483638;top:0;right:0;bottom:0;left:0;padding:32px 40px;color:#222e3a;background-color:#fdfdfd;display:flex;flex-direction:column;row-gap:12px;overflow:auto;background-image:radial-gradient(circle at 0% 0%,#e6fffdcc,#e6fffd00 50%),radial-gradient(circle at 100% 0%,#ebfffecc,#ebfffe00 50%),radial-gradient(circle at 100% 100%,#f0f5ffcc,#f0f5ff00 50%),radial-gradient(circle at 0% 100%,#f2f2ffcc,#f2f2ff00 50%),radial-gradient(circle at 50% 50%,#fff,#fffc,#f5f5ff66,#f0f0ff33,#f0f0ff00),linear-gradient(to bottom right,#e6fffd,#f2f2ff);background-size:100% 100%;background-repeat:no-repeat}.lock-screen__header{display:flex;align-items:center;justify-content:space-between}.lock-screen__logo{display:inline-flex;align-items:center;column-gap:12px;font-size:18px;font-weight:600}.lock-screen__close{display:flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background-color:#222e3a1a}.lock-screen__main{flex-grow:1;align-content:center}.lock-screen__container{max-width:1120px;margin-inline:auto;display:flex;align-items:center;gap:24px}@media (width < 972px){.lock-screen__container{flex-direction:column}}.lock-screen__timer{display:flex;align-items:center;justify-content:center;width:100%}.lock-screen__content{width:100%}.lock-screen__title{font-size:48px;font-weight:700;line-height:56px;margin-bottom:16px}.lock-screen__description{font-size:18px;line-height:32px;margin-bottom:24px}.lock-screen__actions{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px}.lock-screen__action{height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:700;text-align:center;padding:8px 24px}.upgrade-btn{color:#fff;background:linear-gradient(180deg,#20df9e,#13cf8f)}.skip-btn{color:#3066ff;border-width:1px;border-style:solid;border-color:#3066ff;position:relative}.skip-btn__tooltip{font-size:14px;line-height:24px;font-weight:400;position:absolute;z-index:1;left:50%;top:calc(100% + 18px);padding:8px 12px;color:#fff;border:1px solid #4a5764;background-color:#222e3a;border-radius:8px;width:max-content;pointer-events:none;animation:slide-in .6s ease-in-out forwards}@keyframes slide-in{0%{opacity:0;transform:translate(-50%,-100%)}to{opacity:1;transform:translate(-50%)}}.skip-btn__tooltip:after{content:"";display:block;position:absolute;z-index:1;top:-8px;left:50%;width:0;height:0;border-style:solid;border-width:0 8px 8px;border-color:transparent transparent #222e3a;transform:translate(-6px)}.skip-btn__icon{display:none}.skip-btn:disabled{cursor:not-allowed}.skip-btn:disabled .skip-btn__tooltip,.skip-btn:disabled .skip-btn__text{display:none}.skip-btn:disabled .skip-btn__icon{display:initial;animation:tick-tock .8s steps(8,end) infinite}@keyframes tick-tock{to{transform:rotate(360deg)}}.timer{position:relative;max-width:422px;width:100%;aspect-ratio:1/1;border-radius:50%;background-color:#fff;box-shadow:0 0 40px #2b374114;display:flex;align-items:center;justify-content:center;pointer-events:none;-webkit-user-select:none;user-select:none}.timer__circle-backward{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:0;max-width:100%;height:auto;opacity:.4}.timer__circle-forward{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%) rotate(45deg);z-index:1;max-width:100%;height:auto;animation:sector 5s linear forwards}.timer__fire-icon{position:absolute;top:22%;left:50%;transform:translate(-50%);z-index:2}.timer__text{font-size:clamp(18px,10vw,88px);letter-spacing:-1px;text-align:center;font-variant-numeric:tabular-nums;position:relative;z-index:3}.timer--finished .timer__text{color:#98a0a9}.timer--finished .timer__circle-forward{display:none}@keyframes sector{0%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%,0% 100%,0% 2%)}25%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%,0% 100%,0% 100%)}25.000001%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%,0% 100%)}50%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%,100% 100%)}50.000001%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%)}75%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 0%)}75.000001%{clip-path:polygon(50% 50%,0% 2%,100% 0%)}to{clip-path:polygon(50% 50%,0% 2%,0% 0%)}}@media (prefers-color-scheme: dark){.lock-screen{color:#fff;background-image:radial-gradient(circle at 0% 0%,#2f4f4fcc,#2f4f4f00 50%),radial-gradient(circle at 100% 0%,#193042cc,#19304200 50%),radial-gradient(circle at 100% 100%,#1c3041cc,#1c304100 50%),radial-gradient(circle at 0% 100%,#1b263bcc,#1b263b00 50%),radial-gradient(circle at 50% 50%,#141e28,#141e28cc,#1b263b66,#1c304133,#1c304100),linear-gradient(to bottom right,#2f4f4f,#1b263b)}.lock-screen__close{background-color:#ffffff1a}.skip-btn{color:#fff;border-color:#fff}.skip-btn__tooltip{color:#222e3a;border:1px solid #f5f6f7;background-color:#fff}.skip-btn__tooltip:after{border-color:transparent transparent #fff}.timer{background-color:#191b25}.timer__circle-backward{opacity:1}.timer--finished .timer__text{color:#5c6977}}</style></template><style>@font-face{font-family:FigtreeVF;src:url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"),url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");font-weight:100 1000;font-display:swap}</style></veepn-lock-screen><veepn-guard-alert><template shadowrootmode="open"><style>html{box-sizing:border-box;text-size-adjust:100%;word-break:normal;-moz-tab-size:4;tab-size:4}*,:before,:after{background-repeat:no-repeat;box-sizing:border-box}:before,:after{text-decoration:inherit;vertical-align:inherit}*{padding:0;margin:0}hr{overflow:visible;height:0;color:inherit;border:0;border-top:1px solid}details,main{display:block}summary{display:list-item}small{font-size:80%}[hidden]{display:none}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}a{background-color:transparent}a:active,a:hover{outline-width:0}code,kbd,pre,samp{font-family:monospace}pre{font-size:1em}b,strong{font-weight:bolder}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{border-color:inherit;text-indent:0}iframe{border-style:none}input{border-radius:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;-moz-appearance:textfield;appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-decoration{-webkit-appearance:none;-moz-appearance:none;appearance:none}textarea{overflow:auto;resize:vertical}button,input,optgroup,select,textarea{font:inherit;color:inherit}optgroup{font-weight:700}button{overflow:visible}button,select{text-transform:none}button,[type=button],[type=reset],[type=submit],[role=button]{cursor:pointer}button::-moz-focus-inner,[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{border-style:none;padding:0}button,html [type=button],[type=reset],[type=submit]{-webkit-appearance:button;-moz-appearance:button;appearance:button}button,input,select,textarea{background-color:transparent;border-style:none}button:-moz-focusring,[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{outline:1px dotted ButtonText}select{-webkit-appearance:none;-moz-appearance:none;appearance:none}a:focus,button:focus,input:focus,select:focus,textarea:focus{outline-width:0}select::-ms-expand{display:none}select::-ms-value{color:currentcolor}legend{border:0;color:inherit;display:table;white-space:normal;max-width:100%}::-webkit-file-upload-button{-webkit-appearance:button;-moz-appearance:button;appearance:button;color:inherit;font:inherit}[disabled]{cursor:default}img{border-style:none}progress{vertical-align:baseline}[aria-busy=true]{cursor:progress}[aria-controls]{cursor:pointer}[aria-disabled=true]{cursor:default}ul,ol{list-style-type:none}figure{margin:0}.guard-popup{font-family:FigtreeVF,sans-serif;position:fixed;z-index:2147483638;top:8px;left:24px;overflow:visible;color:#222e3a;background-color:#fff;max-width:416px;width:calc(100% - 48px);border-radius:16px;box-shadow:0 4px 20px #00000040;padding:24px}.guard-popup__header{display:flex;justify-content:space-between;align-items:center;column-gap:16px;margin-bottom:24px}.guard-popup__close{display:flex;align-items:center;justify-content:center;width:24px;height:24px;opacity:.7}.guard-popup__img{line-height:0;margin-bottom:24px}.guard-popup__img img{width:100%;aspect-ratio:368/142;object-fit:cover;border-radius:12px;overflow:hidden}.guard-popup__title{font-size:24px;line-height:32px;margin-bottom:8px}.guard-popup__description{font-size:20px;line-height:28px;font-weight:500;color:#4a5764;margin-bottom:28px}.guard-popup__actions{display:flex;justify-content:flex-end;column-gap:16px}.guard-popup__btn{display:flex;align-items:center;justify-content:center;padding:8px 16px;border-radius:5px;font-size:16px;line-height:24px;font-weight:700;cursor:pointer;color:#fff;background:linear-gradient(180deg,#5695fd,#1554ff)}</style></template><style>@font-face{font-family:FigtreeVF;src:url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"),url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");font-weight:100 1000;font-display:swap}</style></veepn-guard-alert></body></html>

<?php
include"footer.php"
?>