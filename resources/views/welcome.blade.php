<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        {{-- <link href="/css/index.css" rel="stylesheet"> --}}
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

 
    </head>
    <body class="antialiased">
        <div class="container">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">KM</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    @if (Route::has('login'))
                        @auth
                        <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
                        </li>
                        @endif
                    @endif
                        {{-- @else --}}
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About ACB
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Products
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            </li>
                        {{-- <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a> --}}
  
 
             
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About ACB</a>
                      </li>

                  </ul>
                  @if (Route::has('login'))
                  <div class="hidden fixed   right-0 px-4  py-4 sm:block">
                      @auth
                      <ul class="navbar-nav mr-auto">
                         
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Welcome, {{ Auth::user()->name }}!
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            </li>
                        </ul>
                      @else
                          {{-- <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                          
                          @if (Route::has('register'))
                              <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                          @endif --}}
                      @endif
                  </div>
                    @endif
                </div>
              </nav>
            
        </div>
              
            <div  id="app"class="flex-center position-ref full-height">
                <div  class="content">
                    <img class="img-fluid" src="{{ url('images/ACBLogo.png') }}" width="350" height="100"><img class="img-fluid" src="{{ url('images/ASEAN.png') }}" width="100" height="100">
                    <div class="title m-b-md">
                        Knowledge Management Platform
                    </div>
                    
                    @if (Route::has('login'))
                  
                      @auth
                      
                          Welcome, {{ Auth::user()->name }}!

                          @else
                          <a href="{{ route('login') }}"><button type="button" class="btn btn-block btn-success btn-lg">Login</button></a>
                          @endif
                    @endif
                    <!-- {{-- <img class="img-fluid" src="{{ url('images/starter.png') }}"> --}} -->
                    
                
                    <!-- {{-- <welcomehome></welcomehome> --}} -->
                
                </div>
  
            </div>

        <div class="container half-height">    
            <h3>Featured</h3>
            <div class="card-deck">
                <div class="card text-white mb-1 bg-brown" style="max-width: 18rem;">
                    <div class="card-header">Type of Product</div>
                    <div class="card-body">
                      <h5 class="card-title">Secondary card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <div class="card text-white   mb-1 bg-brown" style="max-width: 18rem;">
                    <div class="card-header">Newsletter</div>
                    <div class="card-body">
                      <h5 class="card-title">Secondary card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <div class="card text-white  mb-1 bg-brown" style="max-width: 18rem;">
                    <div class="card-header">Publication</div>
                    <div class="card-body">
                      <h5 class="card-title">Secondary card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <div class="card text-white   mb-1 bg-brown" style="max-width: 18rem;">
                    <div class="card-header">Webinar</div>
                    <div class="card-body">
                      <h5 class="card-title">Secondary card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div> 
            {{-- end card --}}
        </div>

            <div class="flex-center position-ref half-height bg-acbblue">
                <div class="container">
                  <div class="blockquote text-center">
                    <h2 class="display-4 "><span class="font-acbgreen">Title</span></h2>
                    <p class="mb-0 text-white">Lorem ipsum dolor sit amet
                        Consectetur adipiscing elit
                        Integer molestie lorem at massa
                        Facilisis in pretium nisl aliquet
                        Nulla volutpat aliquam velit
                        Phasellus iaculis neque
                        Purus sodales ultricies
                        Vestibulum laoreet porttitor sem
                        Ac tristique libero volutpat at
                        Faucibus porta lacus fringilla vel
                        Aenean sit amet erat nunc
                        Eget porttitor lorem</p>
                    
                  </div>
                  
                  <div class="card-deck">
                    <div class="card text-dark mb-5 bg-beige" style="max-width: 18rem;">
                        <div class="card-header">Type of Product</div>
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card text-dark  mb-5 bg-beige" style="max-width: 18rem;">
                        <div class="card-header">Newsletter</div>
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card text-dark mb-5 bg-beige" style="max-width: 18rem;">
                        <div class="card-header">Publication</div>
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card text-dark mb-5 bg-beige" style="max-width: 18rem;">
                        <div class="card-header">Webinar</div>
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div> 
                </div>
            </div>


            <div class="flex-center position-ref full-height ">
                <div class="container">
                    <h3>More from the ACB</h3>
                  
                  <div class="card-deck">
                    <div class="card text-dark mb-5 bg-darkblue" style="max-width: 18rem;">
                       
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-footer text-white">
                             ASEAN Biodiversity Heroes 
                        </div>
                    </div>
                    <div class="card text-dark  mb-5 bg-acbblue" style="max-width: 18rem;">
                       
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-footer text-white">
                            ASEAN Flyway Network 
                       </div>
                    </div>
                    <div class="card text-dark mb-5 bg-darkblue" style="max-width: 18rem;">
                        
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-footer text-white">
                            ASEAN Green Iniative 
                       </div>
                    </div>
                    <div class="card text-dark mb-5 bg-darkblue" style="max-width: 18rem;">
                         
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-footer text-white">
                            ASEAN Youth Biodiversity Programme 
                       </div>
                    </div>
                </div> 
                <div class="card-deck">
                    <div class="card text-dark mb-5 bg-acbblue" style="max-width: 18rem;">
                         
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-footer text-white">
                            ASEAN Heritage Parks
                       </div>
                    </div>
                    <div class="card text-dark  mb-5 bg-darkblue" style="max-width: 18rem;">
                        
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-footer text-white">
                            #WeAreASEANBiodiversity 
                       </div>
                    </div>
                    <div class="card text-dark mb-5 bg-acbblue" style="max-width: 18rem;">
                         
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-footer text-white">
                            Zooming in Biodiversity   
                       </div>
                    </div>
                    <div class="card text-dark mb-5 bg-darkblue" style="max-width: 18rem;">
                       
                        <div class="card-body">
                          <h5 class="card-title">Secondary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-footer text-white">
                            ASEAN News
                       </div>
                    </div>
                </div>
                </div>
            </div>

            <footer class="bg-acbgreen">
                <footer class="container py-5">
                    <div class="row">
 
                      <div class="col-6 col-md">
                        <h5>Features</h5>
                        <ul class="list-unstyled text-small">
                          <li><a class="text-white" href="#">Cool stuff</a></li>
                          <li><a class="text-white" href="#">Random feature</a></li>
                          <li><a class="text-white" href="#">Team feature</a></li>
                          <li><a class="text-white" href="#">Stuff for developers</a></li>
                          <li><a class="text-white" href="#">Another one</a></li>
                          <li><a class="text-white" href="#">Last time</a></li>
                        </ul>
                      </div>
                      <div class="col-6 col-md">
                        <h5>Resources</h5>
                        <ul class="list-unstyled text-small">
                          <li><a class="text-white" href="#">Resource</a></li>
                          <li><a class="text-white" href="#">Resource name</a></li>
                          <li><a class="text-white" href="#">Another resource</a></li>
                          <li><a class="text-white" href="#">Final resource</a></li>
                        </ul>
                      </div>
                      <div class="col-6 col-md">
                        <h5>Resources</h5>
                        <ul class="list-unstyled text-small">
                          <li><a class="text-white" href="#">Business</a></li>
                          <li><a class="text-white" href="#">Education</a></li>
                          <li><a class="text-white" href="#">Government</a></li>
                          <li><a class="text-white" href="#">Gaming</a></li>
                        </ul>
                      </div>
                      <div class="col-6 col-md">
                        <h5>About</h5>
                        <ul class="list-unstyled text-small">
                          <li><a class="text-white" href="#">Login</a></li>
                          <li><a class="text-white" href="#">About the ACB</a></li>
                          <li><a class="text-white" href="#">Contact</a></li>
                          <li><a class="text-white" href="#">Contribute</a></li>
                          <li><a class="text-white" href="#">Community</a></li>
                        </ul>
                      </div>
                    </div>
                  </footer>
 
                <div class="card-footer text-white">
                    Copyright | Terms and Conditions
               </div>
            </footer>


        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        <script>
            document.documentElement.style.setProperty('--beige', '#c3b59b');
        </script>
    </body>
</html>
