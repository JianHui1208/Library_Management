@extends('layouts.user')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" style="width: 50%">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1">
                <div class="slideshow-container">

                    @foreach($contents as $content)
                        <div class="mySlides fade">
                            <a href="{{ route('users.content.detail', [$content->id]) }}">
                                @if($content->image)
                                    <img class="img-content p-6" src="{{ $content->image->getUrl() }}" style="width:100%">
                                @else
                                    <img class="img-content p-6" src="{{ asset('image/Untitled.png') }}" style="width:100%">
                                @endif
                            </a>
                        </div>
                    @endforeach

                </div>

                <br>

                <div style="text-align:center">
                    @foreach($contents as $content)
                    <span class="dot"></span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@parent
    <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>
@endsection