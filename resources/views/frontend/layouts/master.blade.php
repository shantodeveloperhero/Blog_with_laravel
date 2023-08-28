<!DOCTYPE html>
<html lang="en">

  <head>

    @include('frontend.layouts.includes.header')

  </head>

  <body>

    <!-- Header -->
    @include('frontend.layouts.includes.nav')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    @yield('banner')
    <!-- Banner Ends Here -->

    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                @yield('content')
              </div>
            </div>
          </div>
          @include('frontend.layouts.includes.sidebar')
        </div>
      </div>
    </section>

    @include('frontend.layouts.includes.footer')
    

    @include('frontend.layouts.includes.scripts')
  </body>
</html>