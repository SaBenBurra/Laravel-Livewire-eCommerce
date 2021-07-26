@include('front.partials.head', ['title' => $title])

@include('front.partials.header')

@yield('custom-css')

@yield('content')

@include('front.partials.footer')

@include('front.partials.bottom-js')

@yield('custom-js')

@include('front.partials.end')

