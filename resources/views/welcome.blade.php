<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem Monitoring Puskesmas Sukabumi</title>
        <link rel="shortcut icon" href="{{ asset('home')}}/img/logo-puskesmas.png" />


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        {{-- bootstrap --}}
        
            <link rel="stylesheet" type="text/css" href="{{ asset('home') }}/https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
            <link rel="stylesheet" type="text/css" href="{{ asset('home') }}/css/font-awesome.min.css">
            
            <link rel="stylesheet" type="text/css" href="{{ asset('home') }}/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('home') }}/css/style.css">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased" id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        <div class="relative  justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
          @if (session('status'))
          <script>
            alert("Berhasil Membuat Antrian")
          </script>
          @endif
          @if (session('register'))
          <script>
            alert("Berhasil Membuat Akun")
          </script>
          @endif
                <!--banner-->
                <section id="banner" class="banner">
                  <div class="bg-color">
                    <nav class="navbar navbar-default navbar-fixed-top">
                      <div class="container">
                        <div class="col-md-12">
                          <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                    </button>
                            <a class="navbar-brand" href="#"><img src="{{ asset('home') }}/img/banner-logo-puskesmas2.png" class="img-responsive" style="width: 140px; margin-top: -16px;"></a>
                          </div>
                          <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                            <ul class="nav navbar-nav">
                              <li class="active"><a href="#banner">Home</a></li>
                              <li class=""><a href="#service">Services</a></li>
                              <li class=""><a href="#about">About</a></li>
                              <li class=""><a href="#testimonial">Testimonial</a></li>
                              <li class=""><a href="#contact">Contact</a></li>
                              @if (Route::has('login'))
                              <li class="">
                                  @auth
                                      
                                      @if ( Auth::user()->roles == '["ADMIN"]' || Auth::user()->roles == '["STAFF"]')
                                      <li>
                                      <a href="{{ url('/dashboard') }}" class="">Dashboard</a>
                                    </li>
                                          @else
                                          <li>
                                            <a href="{{ url('/dashboard') }}" class="">Dashboard</a>
                                          </li>
                                          <li>
                                          <a href="{{ route('antrian.show',Auth::user()->id) }}" class="">Antrian</a>
                                        </li>
                                      @endif
                                      <li class=" text-primary">
                                          <a>
                                      <form action="{{route('logout')}}" method="post">
                                          @csrf
                                          <button class="btn" style="background-color:transparent" type="submit">
                                            
                                            Logout
                                          </button>
                                        </form>
                                    </a>
                                    </li>
                                  @else
                                      <a href="{{ route('login') }}" class="">Login</a>
              
                                      {{-- @if (Route::has('register'))
                                      <li>
                                          <a href="{{ route('register') }}" class="ml-4 ">Register</a>
                                        </li>
                                      @endif --}}
                                  @endauth
                              </li>
                          @endif
                            </ul>
                          </div>
                        </div>
                      </div>
                    </nav>
                    <div class="container">
                      <div class="row">
                        <div class="banner-info">
                          <div class="banner-logo text-center">
                            <img src="{{ asset('home') }}/img/banner-logo-puskesmas2.png" class="img-responsive">
                          </div>
                          <div class="banner-text text-center">
                            <h1 class="white">Sistem Monitoring Kunjungan Pasien</h1>
                            <h1 class="white">Puskesmas Sukabumi</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <br>tempor incididunt ut labore et dolore magna aliqua.</p>
                            <a href="#contact" class="btn btn-appoint">Buat Antrian</a>
                          </div>
                          <div class="overlay-detail text-center">
                            <a href="#service"><i class="fa fa-angle-down"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--/ banner-->
                <!--service-->
                <section id="service" class="section-padding">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-4 col-sm-4">
                        <h2 class="ser-title">Our Service</h2>
                        <hr class="botm-line">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris cillum.</p>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="service-info">
                          <div class="icon">
                            <i class="fa fa-stethoscope"></i>
                          </div>
                          <div class="icon-info">
                            <h4>24 Hour Support</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                          </div>
                        </div>
                        <div class="service-info">
                          <div class="icon">
                            <i class="fa fa-ambulance"></i>
                          </div>
                          <div class="icon-info">
                            <h4>Emergency Services</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="service-info">
                          <div class="icon">
                            <i class="fa fa-user-md"></i>
                          </div>
                          <div class="icon-info">
                            <h4>Medical Counseling</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                          </div>
                        </div>
                        <div class="service-info">
                          <div class="icon">
                            <i class="fa fa-medkit"></i>
                          </div>
                          <div class="icon-info">
                            <h4>Premium Healthcare</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--/ service-->
                <!--cta-->
                <section id="cta-1" class="section-padding">
                  <div class="container">
                    <div class="row">
                      <div class="schedule-tab">
                        <div class="col-md-4 col-sm-4 bor-left">
                          <div class="mt-boxy-color"></div>
                          <div class="medi-info">
                            <h3>Emergency Case</h3>
                            <p>I am text block. Edit this text from Appearance / Customize / Homepage header columns. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                            <a href="#" class="medi-info-btn">READ MORE</a>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="medi-info">
                            <h3>Emergency Case</h3>
                            <p>I am text block. Edit this text from Appearance / Customize / Homepage header columns. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                            <a href="#" class="medi-info-btn">READ MORE</a>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 mt-boxy-3">
                          <div class="mt-boxy-color"></div>
                          <div class="time-info">
                            <h3>Opening Hours</h3>
                            <table style="margin: 8px 0px 0px;" border="1">
                              <tbody>
                                <tr>
                                  <td>Monday - Friday</td>
                                  <td>8.00 - 17.00</td>
                                </tr>
                                <tr>
                                  <td>Saturday</td>
                                  <td>9.30 - 17.30</td>
                                </tr>
                                <tr>
                                  <td>Sunday</td>
                                  <td>9.30 - 15.00</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--cta-->
                <!--about-->
                <section id="about" class="section-padding">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="section-title">
                          <h2 class="head-title lg-line">The Medilap <br>Ultimate Dream</h2>
                          <hr class="botm-line">
                          <p class="sec-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua..</p>
                          <a href="" style="color: #0cb8b6; padding-top:10px;">Know more..</a>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-8 col-xs-12">
                        <div style="visibility: visible;" class="col-sm-9 more-features-box">
                          <div class="more-features-box-text">
                            <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i> </div>
                            <div class="more-features-box-text-description">
                              <h3>It's something important you want to know.</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Ut wisi enim ad minim veniam, quis nostrud.</p>
                            </div>
                          </div>
                          <div class="more-features-box-text">
                            <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i> </div>
                            <div class="more-features-box-text-description">
                              <h3>It's something important you want to know.</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Ut wisi enim ad minim veniam, quis nostrud.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--/ about-->
                <!--doctor team-->
                <section id="doctor-team" class="section-padding">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <h2 class="ser-title">Meet Our Doctors!</h2>
                        <hr class="botm-line">
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="thumbnail">
                          <img src="{{ asset('home') }}/img/doctor1.jpg" alt="..." class="team-img">
                          <div class="caption">
                            <h3>Jessica Wally</h3>
                            <p>Doctor</p>
                            <ul class="list-inline">
                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="thumbnail">
                          <img src="{{ asset('home') }}/img/doctor2.jpg" alt="..." class="team-img">
                          <div class="caption">
                            <h3>Iai Donas</h3>
                            <p>Doctor</p>
                            <ul class="list-inline">
                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="thumbnail">
                          <img src="{{ asset('home') }}/img/doctor3.jpg" alt="..." class="team-img">
                          <div class="caption">
                            <h3>Amanda Denyl</h3>
                            <p>Doctor</p>
                            <ul class="list-inline">
                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="thumbnail">
                          <img src="{{ asset('home') }}/img/doctor4.jpg" alt="..." class="team-img">
                          <div class="caption">
                            <h3>Jason Davis</h3>
                            <p>Doctor</p>
                            <ul class="list-inline">
                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--/ doctor team-->
                <!--testimonial-->
                <section id="testimonial" class="section-padding">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <h2 class="ser-title">see what patients are saying?</h2>
                        <hr class="botm-line">
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="testi-details">
                          <!-- Paragraph -->
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="testi-info">
                          <!-- User Image -->
                          <a href="#"><img src="{{ asset('home') }}/img/thumb.png" alt="" class="img-responsive"></a>
                          <!-- User Name -->
                          <h3>Alex<span>Texas</span></h3>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="testi-details">
                          <!-- Paragraph -->
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="testi-info">
                          <!-- User Image -->
                          <a href="#"><img src="{{ asset('home') }}/img/thumb.png" alt="" class="img-responsive"></a>
                          <!-- User Name -->
                          <h3>Alex<span>Texas</span></h3>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="testi-details">
                          <!-- Paragraph -->
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="testi-info">
                          <!-- User Image -->
                          <a href="#"><img src="{{ asset('home') }}/img/thumb.png" alt="" class="img-responsive"></a>
                          <!-- User Name -->
                          <h3>Alex<span>Texas</span></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--/ testimonial-->
                <!--cta 2-->
                <section id="cta-2" class="section-padding">
                  <div class="container">
                    <div class=" row">
                      <div class="col-md-2"></div>
                      <div class="text-right-md col-md-4 col-sm-4">
                        <h2 class="section-title white lg-line">« A few words<br> about us »</h2>
                      </div>
                      <div class="col-md-4 col-sm-5">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a typek
                        <p class="text-right text-primary"><i>— Medilap Healthcare</i></p>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                </section>
                <!--cta-->
                <!--contact-->
                <section id="contact" class="section-padding">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <h2 class="ser-title">Contact us</h2>
                        <hr class="botm-line">
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <h3>Contact Info</h3>
                        <div class="space"></div>
                        <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>321 Awesome Street<br> New York, NY 17022</p>
                        <div class="space"></div>
                        <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>info@companyname.com</p>
                        <div class="space"></div>
                        <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+1 800 123 1234</p>
                      </div>
                      <div class="col-md-8 col-sm-8 marb20">
                        <div class="contact-info">
                          <h3 class="cnt-ttl">Daftar Antrian Sekarang !!!</h3>
                          <div class="space"></div>
                          {{-- <div id="sendmessage">Your message has been sent. Thank you!</div>
                          <div id="errormessage"></div> --}}
                            {{-- <form action="" method="post" role="form" class="contactForm">
                                <div class="form-group">
                                <input type="text" name="name" class="form-control br-radius-zero" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                <input type="email" class="form-control br-radius-zero" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                <input type="text" class="form-control br-radius-zero" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                <textarea class="form-control br-radius-zero" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                <div class="validation"></div>
                                </div>
                
                                <div class="form-action">
                                <button type="submit" class="btn btn-form">Send Message</button>
                                </div>
                            </form> --}}
                          <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('antrian.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">         
                                     <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" name="nama" value="{{ old('nama')}}" class="form-control {{ $errors->first('nama') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name">
                                  </div>
                
                                  {{-- tampil error opsi 2 --}}
                                  @error('nama')
                                  <div class="alert alert-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                
                                <div class="col-md-6">         
                                  <div class="form-group">
                                 <label for="exampleInputName1">NIK</label>
                                 <input type="text" name="nik" value="{{ old('nik')}}" class="form-control {{ $errors->first('nik') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="NIK">
                               </div>
                
                               {{-- tampil error opsi 2 --}}
                               @error('nik')
                               <div class="alert alert-danger">
                                 {{ $message }}
                               </div>
                               @enderror
                             </div>
                
                                <div class="col-md-6">         
                                  <div class="form-group">
                                 <label for="exampleInputName1">Jenis Kelamin</label><br>
                                 <select name="gender" id="gender" class="{{ $errors->first('nama') ? "is-invalid" :""}} custom-select">
                                <option hidden>Pilih</option>
                                   <option value="L">Laki-laki</option>
                                   <option value="P">Perempuan</option>
                                 </select>
                                 {{-- <input type="text" name="nama" value="{{ old('nama')}}" class="form-control {{ $errors->first('nama') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name"> --}}
                               </div>
                
                               {{-- tampil error opsi 2 --}}
                               @error('gender')
                               <div class="alert alert-danger">
                                 {{ $message }}
                               </div>
                               @enderror
                             </div>
                
                             <div class="col-md-6">         
                              <div class="form-group">
                             <label for="exampleInputName1">Alamat</label>
                             <input type="text" name="alamat" value="{{ old('alamat')}}" class="form-control {{ $errors->first('alamat') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Alamat">
                           </div>
                
                           {{-- tampil error opsi 2 --}}
                           @error('alamat')
                           <div class="alert alert-danger">
                             {{ $message }}
                           </div>
                           @enderror
                         </div>
                
                              <div class="col-md-6">         
                                <div class="form-group">
                              <label for="exampleInputName1">Tanggal Kunjungan</label>
                              <input type="date" name="tgl_kunjungan" value="{{ old('tgl_kunjungan')}}" class="form-control {{ $errors->first('tgl_kunjungan') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="tanggal Kunjungan">
                            </div>
                
                            {{-- tampil error opsi 2 --}}
                            @error('tgl_kunjungan')
                            <div class="alert alert-danger">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                
                              <div class="col-md-6">         
                                <div class="form-group">
                              <label for="exampleInputName1">Puskesmas & Poli</label><br>
                              <select name="puskesmas_id" id="puskesmas_id" class="custom-select" onclick="puskesmas()">Nama Poli
                                <option hidden>-Pilih Puskesmas-</option>
                                @foreach ($puskesmas as $data)
                       
                                {{-- @foreach ($puskesmas as $item) --}}
                       
                                <option value="{{ $data->id }}">
                                 {{-- <input type="text" value="{{ $data->nama }}" id="puskesmas"> --}}
                                 {{ $data->nama }}  - 
                                 {{ $data->nama_poli }}
                                 {{-- @endforeach --}}
                           
                       
                               </option>
                                 @endforeach 
                             </select>
                            </div>
                
                            {{-- tampil error opsi 2 --}}
                            @error('poli_id')
                            <div class="alert alert-danger">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                
                            <div class="col-md-6">         
                              <div class="form-group">
                            <label for="status_bayar">Status Bayar</label>
                            <br>
                            <select name="status_bayar" id="status_bayar" class="custom-select">
                              <option hidden>Pilih</option>
                              <option value="Bayar">Bayar</option>
                              <option value="BPJS">BPJS</option>
                            </select>
                            </div>
                
                              {{-- tampil error opsi 2 --}}
                              @error('status_bayar')
                              <div class="alert alert-danger">
                              {{ $message }}
                              </div>
                              @enderror
                              </div>
                
                              <div class="col-md-6">         
                                <div class="form-group">
                               <label for="exampleInputName1">No BPJS</label>
                               <input type="number" name="no_bpjs" value="{{ old('no_bpjs')}}" class="form-control {{ $errors->first('no_bpjs') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="No BPJS">
                             </div>
                
                             {{-- tampil error opsi 2 --}}
                             @error('no_bpjs')
                             <div class="alert alert-danger">
                               {{ $message }}
                             </div>
                             @enderror
                           </div>
                           <input type="hidden" name="status_antrian" value="Antri" class="form-control">
                           <input type="hidden" name="no_antrian" value="" class="form-control">

                           {{-- tambah ini --}}
                           @if (Route::has('login'))
                               @auth
                           <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control">
                                   
                               
                           @else
                           <input type="hidden" name="user_id" value="" class="form-control">

                           @endauth
                           @endif
                           
                
                
                
                                <div class="col-md-6">         
                                     <div class="form-group">
                                    <label>Upload Gambar</label>
                                   <input type="file" name="image" class="form-control {{ $errors->first('image') ? "is-invalid" :""}}">
                                   {{-- tampil error opsi 1--}}
                                   {{-- <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                  </div> --}}
                
                                  {{-- tampil error opsi 2 --}}
                                  @error('image')
                                  <script>
                                    alert("Gagal membuat antrian")
                                  </script>
                                  <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                  </div>
                                  <small class="text-muted">*Gambar tidak boleh dikosongkan</small>

                             </div>
                          </div>
                           <center>
                            {{-- <a style="text-decoration: none" href="{{route('antrian.show',$item->id)}}"> --}}
                            <button type="submit" class="btn btn-sm btn-primary mr-2 mt-4">
                               <i class="mdi mdi-checkbox-marked"></i> Daftar
                            </button>
                            {{-- </a> --}}
                           </center>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--/ contact-->
                <!--footer-->
                <footer id="footer">
                  <div class="top-footer">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4 col-sm-4 marb20">
                          <div class="ftr-tle">
                            <h4 class="white no-padding">About Us</h4>
                          </div>
                          <div class="info-sec">
                            <p>Praesent convallis tortor et enim laoreet, vel consectetur purus latoque penatibus et dis parturient.</p>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 marb20">
                          <div class="ftr-tle">
                            <h4 class="white no-padding">Quick Links</h4>
                          </div>
                          <div class="info-sec">
                            <ul class="quick-info">
                              <li><a href="{{ url('/') }}"><i class="fa fa-circle"></i>Home</a></li>
                              <li><a href="#service"><i class="fa fa-circle"></i>Service</a></li>
                              <li><a href="#contact"><i class="fa fa-circle"></i>Appointment</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 marb20">
                          <div class="ftr-tle">
                            <h4 class="white no-padding">Follow us</h4>
                          </div>
                          <div class="info-sec">
                            <ul class="social-icon">
                              <li class="bglight-blue"><i class="fa fa-facebook"></i></li>
                              <li class="bgred"><i class="fa fa-google-plus"></i></li>
                              <li class="bgdark-blue"><i class="fa fa-linkedin"></i></li>
                              <li class="bglight-blue"><i class="fa fa-twitter"></i></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="footer-line">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-12 text-center">
                          © Copyright Medilab Theme. All Rights Reserved
                          <div class="credits">
                            <!--
                              All the links in the footer should remain intact.
                              You can delete the links only if you purchased the pro version.
                              Licensing information: https://bootstrapmade.com/license/
                              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Medilab
                            -->
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade.com</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </footer>
                <!--/ footer-->
              
                <script src="{{ asset('home') }}/js/jquery.min.js"></script>
                <script src="{{ asset('home') }}/js/jquery.easing.min.js"></script>
                <script src="{{ asset('home') }}/js/bootstrap.min.js"></script>
                <script src="{{ asset('home') }}/js/custom.js"></script>
                <script src="{{ asset('home') }}/contactform/contactform.js"></script>
              
              </body>
</html>
