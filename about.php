<?php
include("connect.php");
include("header.php");

// Fetch NiT section data
$nit_section = $conn->query("SELECT * FROM about_sections WHERE section_type = 'nit' LIMIT 1")->fetch_assoc();

// Fetch NCC section data
$ncc_section = $conn->query("SELECT * FROM about_sections WHERE section_type = 'ncc' LIMIT 1")->fetch_assoc();
?>

<!DOCTYPE html>
<!-- saved from url=(0057)https://demo.hasthemes.com/jones-preview/jones/about.html -->
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths" lang="en" style=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style>body {transition: opacity ease-in 0.2s; } 
body[unresolved] {opacity: 0; display: block; overflow: hidden; position: relative; } 
</style>
        
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Jones - Education HTML Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="apple-touch-icon" href="https://demo.hasthemes.com/jones-preview/jones/apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        
        <link rel="stylesheet" href="./about_files/bootstrap.min.css">
        <link rel="stylesheet" href="./about_files/meanmenu.css">
        <link rel="stylesheet" href="./about_files/animate.css">
        <link rel="stylesheet" href="./about_files/magnific-popup.css">
        <link rel="stylesheet" href="./about_files/owl.carousel.min.css">
        <link rel="stylesheet" href="./about_files/font-awesome.min.css">
        <link rel="stylesheet" href="./about_files/style.css">
        <link rel="stylesheet" href="./about_files/responsive.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="./about_files/modernizr-2.8.3.min.js"></script>
        <style>       
        
        /* About Sections - Your Original Style */
        .about-video-image-area {
            margin-bottom: 4em;
        }
        
        .about-top-area, .about-bottom-area {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            padding: 50px 0;
        }
        
        .about-text-content {
            flex: 1;
            min-width: 300px;
            padding: 0 30px;
        }
        
        .about-image-container {
            flex: 1;
            min-width: 300px;
            padding: 0 30px;
            text-align: center;
        }
        
        .bg-green {
            background-color: #28a745;
            color: white;
        }
        
        .bg-dark-blue {
            background-color: #343a40;
            color: white;
        }
        
        .ht-video-bg {
            position: relative;
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .ht-video-bg .fa-play {
            color: white;
            font-size: 50px;
            background: rgba(0,0,0,0.5);
            padding: 20px 30px;
            border-radius: 50%;
        }
        
        /* NiT Tall Image Section - New Style */
        .nit-tall-section {
            padding: 80px 0;
        }
        
        .nit-tall-image {
            width: 90%;
            margin: 40px auto;
            display: block;
            max-height: 800px;
            object-fit: cover;
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            margin: 40px 0;
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        /* Team Area - Your Original Style */
        .team-area {
            padding: 100px 0;
        }
        
        .ht-single-team {
            margin-bottom: 30px;
        }
        
        .ht-team-img img {
            border-radius: 50%;
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 5px solid #f8f9fa;
        }
        
        .ht-team-text {
            padding: 20px;
        }
        
        .section-title {
            margin-bottom: 50px;
            text-align: center;
        }
        </style>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        	
        <!-- Banner Title Area Start -->
        <div class="banner-title-area bg-dark-blue ptb-180">
            <div class="container text-center">
                <h1>About Us</h1>
            </div>
        </div>
        <!-- Banner Title Area End -->
        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area">
            <div class="container">
                <ul class="breadcrumb style-two">
                    <li><a href="index.php">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb Area End -->        

        <!-- About NiT Section - New Tall Image Style -->
    <div class="nit-tall-section">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $nit_section['title'] ?? 'About NiT'; ?></h2>
            </div>
            
            <div class="about-text-content">
                <p><?php echo nl2br($nit_section['content'] ?? ''); ?></p>
            </div>
            
            <?php if (!empty($nit_section['video_url'])): ?>
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/<?php echo getYouTubeId($nit_section['video_url']); ?>" 
                            frameborder="0" allowfullscreen></iframe>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($nit_section['image_path'])): ?>
                <img src="<?php echo $nit_section['image_path']; ?>" class="nit-tall-image" alt="About NiT">
            <?php endif; ?>
        </div>
    </div>
    
    <!-- About NCC Section - Your Original Style -->
    <div class="about-video-image-area">
        <div class="about-top-area bg-green fix">
            <div class="about-text-content">
                <h3 class="sub-title"><?php echo $ncc_section['title'] ?? 'What We do'; ?></h3>
                <p><?php echo nl2br($ncc_section['content'] ?? ''); ?></p>
            </div>
            <div class="about-image-container">
                <?php if (!empty($ncc_section['video_url'])): ?>
                    <div class="ht-video-bg">
                        <a class="video-popup" href="<?php echo $ncc_section['video_url']; ?>">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="about-bottom-area bg-dark-blue fix">
            <div class="about-image-container">
                <?php if (!empty($ncc_section['mission_image_path'])): ?>
                    <img src="<?php echo $ncc_section['mission_image_path']; ?>" alt="Our Mission">
                <?php endif; ?>
            </div>
            <div class="about-text-content">
                <h3 class="sub-title"><?php echo $ncc_section['mission_title'] ?? 'Our Mission'; ?></h3>
                <p><?php echo nl2br($ncc_section['mission_content'] ?? ''); ?></p>
            </div>
        </div>
    </div>
    
    <!-- Team Area Start - Your Original Style -->
    <div class="team-area pt-150 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-8 col-sm-10">
                    <div class="section-wrapper">
                        <div class="section-title text-dark">
                            <h3 style="text-align:left;">Our Instructors</h3>
                            <p style="text-align:left;">Meet our team of professional instructors dedicated to helping you achieve your goals.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <?php 
                // Fetch instructors with limit of 4
                $team_members = $conn->query("SELECT * FROM instructors ORDER BY name LIMIT 4");
                
                if ($team_members->num_rows > 0): ?>
                    <?php while ($member = $team_members->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
                            <div class="single-team text-center h-100 d-flex flex-column">
                                <div class="team-img mx-auto">
                                    <?php if (!empty($member['image_path'])): ?>
                                        <img src="<?php echo $member['image_path']; ?>" 
                                            alt="<?php echo htmlspecialchars($member['name']); ?>" 
                                            class="img-fluid rounded-circle"
                                            style="width: 200px; height: 200px; object-fit: cover;">
                                    <?php else: ?>
                                        <img src="../assets/img/team/default-instructor.jpg" 
                                            alt="Default Instructor" 
                                            class="img-fluid rounded-circle"
                                            style="width: 200px; height: 200px; object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                                <div class="team-content mt-20 flex-grow-1 d-flex flex-column">
                                    <h4><?php echo htmlspecialchars($member['name']); ?></h4>
                                    <span class="text-muted"><?php echo htmlspecialchars($member['position']); ?></span>
                                    <div class="instructor-bio mt-10 mb-3 flex-grow-1">
                                        <?php 
                                        $shortBio = strlen($member['bio']) > 100 ? substr($member['bio'], 0, 100) . '...' : $member['bio'];
                                        echo htmlspecialchars($shortBio); 
                                        ?>
                                    </div>
                                    <?php if (strlen($member['bio']) > 100): ?>
                                        <button class="btn btn-link read-more-btn align-self-end" 
                                                data-fullbio="<?php echo htmlspecialchars($member['bio']); ?>">
                                            Read More
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <div class="alert alert-info">No instructors found. Please check back later.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal for full bio -->
    <div class="modal fade" id="bioModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="instructorName"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="instructorBio"></div>               
            </div>
        </div>
    </div>
    <!-- Team Area End -->
        
        <!-- Footer Area Start -->
        <footer class="footer-area">
            <div class="footer-top bg-dark-blue">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="single-footer-widget">
                                <div class="footer-logo">
                                    <a href="index.php"><img src="./about_files/footer-logo.png" alt="Jones"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="single-footer-widget">
                                <h4>Contact Us</h4>
                                <div class="footer-c-info">
                                    <span class="f-c-icon"><i class="fa fa-home"></i></span>
                                    <span class="f-c-text">Your address goes here.</span>
                                </div>
                                <div class="footer-c-info">
                                    <span class="f-c-icon"><i class="fa fa-envelope-open"></i></span>
                                    <span class="f-c-text">demo@example.com<br>www.example.com</span>
                                </div>
                                <div class="footer-c-info">
                                    <span class="f-c-icon"><i class="fa fa-headphones"></i></span>
                                    <span class="f-c-text">(+0123456789)<br>(+987654321)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
                            <div class="single-footer-widget">
                                <h4>links</h4>
                                <ul class="footer-widget-list">
                                    <li><a href="about.php">About us</a></li>
                                    <li><a href="signup.php">register</a></li>
                                    <li><a href="course.php">Courses</a></li>
                                    <li><a href="event.php">Event</a></li>
                                    <li><a href="blog.php">Blog</a></li>
                                    <li><a href="about.php">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="single-footer-widget">
                                <h4>Recent Course</h4>
                                <div class="footer-post-item">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">
                                        <img src="./about_files/1(1).jpg" alt="">
                                    </a>
                                    <div class="footer-post-text">
                                        <h3><a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Duis non elit risus Etiams.</a></h3>
                                        <span><i class="fa fa-clock-o"></i>10.30 AM - 15.30 PM</span>
                                    </div>
                                </div>
                                <div class="footer-post-item">
                                    <a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">
                                        <img src="./about_files/2(1).jpg" alt="">
                                    </a>
                                    <div class="footer-post-text">
                                        <h3><a href="https://demo.hasthemes.com/jones-preview/jones/blog-details.html">Lorem ipsum idisus miats</a></h3>
                                        <span><i class="fa fa-clock-o"></i>12.30 AM - 19.30 PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom bg-dark-blue-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="footer-text">
                                ©  2021 Jones Mede with ❤️ by  <a href="https://hasthemes.com/" target="_blank">HasThemes</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End -->
       
        <!--Start of Search Form-->
        <div class="modal fade" id="search_box" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <form class="search-pop-up" action="https://demo.hasthemes.com/jones-preview/jones/about.html#" method="post">
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
                            <form action="https://demo.hasthemes.com/jones-preview/jones/about.html#" method="post" class="signup-form">
                                <input type="text" placeholder="User Name Or Email" name="f_name">
                                <input type="password" placeholder="Password" name="password">
                                <div class="from-wrap">
                                    <div class="form-left"><input type="checkbox"> Remember Me</div>
                                    <div class="form-right"><a href="https://demo.hasthemes.com/jones-preview/jones/about.html#">Lost Your Password?</a></div>
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

        <?php
            function getYouTubeId($url) {
                parse_str(parse_url($url, PHP_URL_QUERY), $vars);
                return $vars['v'] ?? '';
            }
        ?>
        
        <script src="./about_files/jquery-1.12.4.min.js"></script>
        <script src="./about_files/bootstrap.min.js"></script>
        <script src="./about_files/jquery.meanmenu.js"></script>
        <script src="./about_files/jquery.magnific-popup.js"></script>
        <script src="./about_files/jquery.countdown.min.js"></script>
        <script src="./about_files/ajax-mail.js"></script>
        <script src="./about_files/owl.carousel.min.js"></script>
        <script src="./about_files/plugins.js"></script>
        <script src="./about_files/main.js"></script><a id="scrollUp" href="https://demo.hasthemes.com/jones-preview/jones/about.html#top" style="position: fixed; z-index: 2147483647;"><i class="fa fa-long-arrow-up"></i></a>
        <script>
            jQuery(document).ready(function($) {
                $(document).on('click', '.read-more-btn', function() {
                    var $button = $(this);
                    var $card = $button.closest('.single-team');
                    var name = $card.find('h4').text();
                    var fullBio = $button.data('fullbio');
                    
                    $('#instructorName').text(name);
                    $('#instructorBio').text(fullBio);
                    
                    $('#bioModal').modal('show');
                });
            });
        </script>
<veepn-lock-screen><template shadowrootmode="open"><style>html{box-sizing:border-box;text-size-adjust:100%;word-break:normal;-moz-tab-size:4;tab-size:4}*,:before,:after{background-repeat:no-repeat;box-sizing:border-box}:before,:after{text-decoration:inherit;vertical-align:inherit}*{padding:0;margin:0}hr{overflow:visible;height:0;color:inherit;border:0;border-top:1px solid}details,main{display:block}summary{display:list-item}small{font-size:80%}[hidden]{display:none!important}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}a{background-color:transparent}a:active,a:hover{outline-width:0}code,kbd,pre,samp{font-family:monospace}pre{font-size:1em}b,strong{font-weight:bolder}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{border-color:inherit;text-indent:0}iframe{border-style:none}input{border-radius:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;-moz-appearance:textfield;appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-decoration{-webkit-appearance:none;-moz-appearance:none;appearance:none}textarea{overflow:auto;resize:vertical}button,input,optgroup,select,textarea{font:inherit;color:inherit}optgroup{font-weight:700}button{overflow:visible}button,select{text-transform:none}button,[type=button],[type=reset],[type=submit],[role=button]{cursor:pointer}button::-moz-focus-inner,[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{border-style:none;padding:0}button,html [type=button],[type=reset],[type=submit]{-webkit-appearance:button;-moz-appearance:button;appearance:button}button,input,select,textarea{background-color:transparent;border-style:none}button:-moz-focusring,[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{outline:1px dotted ButtonText}select{-webkit-appearance:none;-moz-appearance:none;appearance:none}a:focus,button:focus,input:focus,select:focus,textarea:focus{outline-width:0}select::-ms-expand{display:none}select::-ms-value{color:currentcolor}legend{border:0;color:inherit;display:table;white-space:normal;max-width:100%}::-webkit-file-upload-button{-webkit-appearance:button;-moz-appearance:button;appearance:button;color:inherit;font:inherit}[disabled]{cursor:default}img{border-style:none}progress{vertical-align:baseline}[aria-busy=true]{cursor:progress}[aria-controls]{cursor:pointer}[aria-disabled=true]{cursor:default}ul,ol{list-style-type:none}figure{margin:0}.lock-screen{font-family:FigtreeVF,sans-serif;letter-spacing:normal;position:fixed;z-index:2147483638;top:0;right:0;bottom:0;left:0;padding:32px 40px;color:#222e3a;background-color:#fdfdfd;display:flex;flex-direction:column;row-gap:12px;overflow:auto;background-image:radial-gradient(circle at 0% 0%,#e6fffdcc,#e6fffd00 50%),radial-gradient(circle at 100% 0%,#ebfffecc,#ebfffe00 50%),radial-gradient(circle at 100% 100%,#f0f5ffcc,#f0f5ff00 50%),radial-gradient(circle at 0% 100%,#f2f2ffcc,#f2f2ff00 50%),radial-gradient(circle at 50% 50%,#fff,#fffc,#f5f5ff66,#f0f0ff33,#f0f0ff00),linear-gradient(to bottom right,#e6fffd,#f2f2ff);background-size:100% 100%;background-repeat:no-repeat}.lock-screen__header{display:flex;align-items:center;justify-content:space-between}.lock-screen__logo{display:inline-flex;align-items:center;column-gap:12px;font-size:18px;font-weight:600}.lock-screen__close{display:flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background-color:#222e3a1a}.lock-screen__main{flex-grow:1;align-content:center}.lock-screen__container{max-width:1120px;margin-inline:auto;display:flex;align-items:center;gap:24px}@media (width < 972px){.lock-screen__container{flex-direction:column}}.lock-screen__timer{display:flex;align-items:center;justify-content:center;width:100%}.lock-screen__content{width:100%}.lock-screen__title{font-size:48px;font-weight:700;line-height:56px;margin-bottom:16px}.lock-screen__description{font-size:18px;line-height:32px;margin-bottom:24px}.lock-screen__actions{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px}.lock-screen__action{height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:700;text-align:center;padding:8px 24px}.upgrade-btn{color:#fff;background:linear-gradient(180deg,#20df9e,#13cf8f)}.skip-btn{color:#3066ff;border-width:1px;border-style:solid;border-color:#3066ff;position:relative}.skip-btn__tooltip{font-size:14px;line-height:24px;font-weight:400;position:absolute;z-index:1;left:50%;top:calc(100% + 18px);padding:8px 12px;color:#fff;border:1px solid #4a5764;background-color:#222e3a;border-radius:8px;width:max-content;pointer-events:none;animation:slide-in .6s ease-in-out forwards}@keyframes slide-in{0%{opacity:0;transform:translate(-50%,-100%)}to{opacity:1;transform:translate(-50%)}}.skip-btn__tooltip:after{content:"";display:block;position:absolute;z-index:1;top:-8px;left:50%;width:0;height:0;border-style:solid;border-width:0 8px 8px;border-color:transparent transparent #222e3a;transform:translate(-6px)}.skip-btn__icon{display:none}.skip-btn:disabled{cursor:not-allowed}.skip-btn:disabled .skip-btn__tooltip,.skip-btn:disabled .skip-btn__text{display:none}.skip-btn:disabled .skip-btn__icon{display:initial;animation:tick-tock .8s steps(8,end) infinite}@keyframes tick-tock{to{transform:rotate(360deg)}}.timer{position:relative;max-width:422px;width:100%;aspect-ratio:1/1;border-radius:50%;background-color:#fff;box-shadow:0 0 40px #2b374114;display:flex;align-items:center;justify-content:center;pointer-events:none;-webkit-user-select:none;user-select:none}.timer__circle-backward{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:0;max-width:100%;height:auto;opacity:.4}.timer__circle-forward{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%) rotate(45deg);z-index:1;max-width:100%;height:auto;animation:sector 5s linear forwards}.timer__fire-icon{position:absolute;top:22%;left:50%;transform:translate(-50%);z-index:2}.timer__text{font-size:clamp(18px,10vw,88px);letter-spacing:-1px;text-align:center;font-variant-numeric:tabular-nums;position:relative;z-index:3}.timer--finished .timer__text{color:#98a0a9}.timer--finished .timer__circle-forward{display:none}@keyframes sector{0%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%,0% 100%,0% 2%)}25%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%,0% 100%,0% 100%)}25.000001%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%,0% 100%)}50%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%,100% 100%)}50.000001%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 100%)}75%{clip-path:polygon(50% 50%,0% 2%,100% 0%,100% 0%)}75.000001%{clip-path:polygon(50% 50%,0% 2%,100% 0%)}to{clip-path:polygon(50% 50%,0% 2%,0% 0%)}}@media (prefers-color-scheme: dark){.lock-screen{color:#fff;background-image:radial-gradient(circle at 0% 0%,#2f4f4fcc,#2f4f4f00 50%),radial-gradient(circle at 100% 0%,#193042cc,#19304200 50%),radial-gradient(circle at 100% 100%,#1c3041cc,#1c304100 50%),radial-gradient(circle at 0% 100%,#1b263bcc,#1b263b00 50%),radial-gradient(circle at 50% 50%,#141e28,#141e28cc,#1b263b66,#1c304133,#1c304100),linear-gradient(to bottom right,#2f4f4f,#1b263b)}.lock-screen__close{background-color:#ffffff1a}.skip-btn{color:#fff;border-color:#fff}.skip-btn__tooltip{color:#222e3a;border:1px solid #f5f6f7;background-color:#fff}.skip-btn__tooltip:after{border-color:transparent transparent #fff}.timer{background-color:#191b25}.timer__circle-backward{opacity:1}.timer--finished .timer__text{color:#5c6977}}</style></template><style>@font-face{font-family:FigtreeVF;src:url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"),url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");font-weight:100 1000;font-display:swap}</style></veepn-lock-screen><veepn-guard-alert><template shadowrootmode="open"><style>html{box-sizing:border-box;text-size-adjust:100%;word-break:normal;-moz-tab-size:4;tab-size:4}*,:before,:after{background-repeat:no-repeat;box-sizing:border-box}:before,:after{text-decoration:inherit;vertical-align:inherit}*{padding:0;margin:0}hr{overflow:visible;height:0;color:inherit;border:0;border-top:1px solid}details,main{display:block}summary{display:list-item}small{font-size:80%}[hidden]{display:none}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}a{background-color:transparent}a:active,a:hover{outline-width:0}code,kbd,pre,samp{font-family:monospace}pre{font-size:1em}b,strong{font-weight:bolder}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{border-color:inherit;text-indent:0}iframe{border-style:none}input{border-radius:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;-moz-appearance:textfield;appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-decoration{-webkit-appearance:none;-moz-appearance:none;appearance:none}textarea{overflow:auto;resize:vertical}button,input,optgroup,select,textarea{font:inherit;color:inherit}optgroup{font-weight:700}button{overflow:visible}button,select{text-transform:none}button,[type=button],[type=reset],[type=submit],[role=button]{cursor:pointer}button::-moz-focus-inner,[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{border-style:none;padding:0}button,html [type=button],[type=reset],[type=submit]{-webkit-appearance:button;-moz-appearance:button;appearance:button}button,input,select,textarea{background-color:transparent;border-style:none}button:-moz-focusring,[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner{outline:1px dotted ButtonText}select{-webkit-appearance:none;-moz-appearance:none;appearance:none}a:focus,button:focus,input:focus,select:focus,textarea:focus{outline-width:0}select::-ms-expand{display:none}select::-ms-value{color:currentcolor}legend{border:0;color:inherit;display:table;white-space:normal;max-width:100%}::-webkit-file-upload-button{-webkit-appearance:button;-moz-appearance:button;appearance:button;color:inherit;font:inherit}[disabled]{cursor:default}img{border-style:none}progress{vertical-align:baseline}[aria-busy=true]{cursor:progress}[aria-controls]{cursor:pointer}[aria-disabled=true]{cursor:default}ul,ol{list-style-type:none}figure{margin:0}.guard-popup{font-family:FigtreeVF,sans-serif;position:fixed;z-index:2147483638;top:8px;left:24px;overflow:visible;color:#222e3a;background-color:#fff;max-width:416px;width:calc(100% - 48px);border-radius:16px;box-shadow:0 4px 20px #00000040;padding:24px}.guard-popup__header{display:flex;justify-content:space-between;align-items:center;column-gap:16px;margin-bottom:24px}.guard-popup__close{display:flex;align-items:center;justify-content:center;width:24px;height:24px;opacity:.7}.guard-popup__img{line-height:0;margin-bottom:24px}.guard-popup__img img{width:100%;aspect-ratio:368/142;object-fit:cover;border-radius:12px;overflow:hidden}.guard-popup__title{font-size:24px;line-height:32px;margin-bottom:8px}.guard-popup__description{font-size:20px;line-height:28px;font-weight:500;color:#4a5764;margin-bottom:28px}.guard-popup__actions{display:flex;justify-content:flex-end;column-gap:16px}.guard-popup__btn{display:flex;align-items:center;justify-content:center;padding:8px 16px;border-radius:5px;font-size:16px;line-height:24px;font-weight:700;cursor:pointer;color:#fff;background:linear-gradient(180deg,#5695fd,#1554ff)}</style></template><style>@font-face{font-family:FigtreeVF;src:url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"),url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");font-weight:100 1000;font-display:swap}</style></veepn-guard-alert></body></html>