<meta charset="UTF-8" />
<meta name="description" content="Top 10 educational websites to learn coding online and possibly get hired by programming companies. Variants of education and certification, skill gaining and etc." />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />

@stack('metas')

<title>@yield('title')</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
<link rel="stylesheet" href="{{ asset('css/aos.css') }}" />
<link rel="stylesheet" href="{{ asset('plugins/summernote-editor/summernote-bs4.css') }}" />
<link rel="stylesheet" href="{{ asset('css/colors.css') }}" />
<link rel="stylesheet" href="{{ asset('css/dradient-anim.css') }}" />
<link rel="stylesheet" href="{{ asset('css/gradients.css') }}" />
<style>
body {

 font-family: 'Montserrat Alternates', sans-serif;
 font-size: 100%;
}

#myBtn {

 display: none;
 position: fixed; bottom: 20px; right: 30px; z-index: 99;
 padding: 15px; border: none; outline: none;
 background-color: red; cursor: pointer; border-radius: 4px;
 color: white; font-size: 18px;
}

#myBtn:hover {

	background-color: #555;
}

.image-bg-1 {

 background-image: url("{{ asset('images/bgimg1.jpg') }}");
}

.image-bg-2 {

 background-image: url("{{ asset('images/bgimg2.jpg') }}");
}

.image-bg-1, .image-bg-2 {

	background-repeat: no-repeat; background-position: center center;
	background-attachment: fixed; background-size: cover;
}
</style>

@stack('csslinks')

<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('plugins/summernote-editor/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/Colors.js') }}"></script>

@stack('style')

@stack('scripts')

<script>
$(document).ready(function() {

 $('#comment_content').summernote({

	 toolbar: [
	 	['style', ['style']],
	  ['font', ['bold', 'underline', 'clear']],
	  ['fontname', ['fontname']],
	  ['color', ['color']],
	  ['para', ['ul', 'ol', 'paragraph']],
	  ['table', ['table']],
	  ['view', ['fullscreen', 'codeview', 'help']],
	 ],
	 placeholder: 'Comment content here ...',
	 tabsize: 2,
		height: 128
 });

 $('[data-colored="yes"]').each(function(key, item) {

  $(item).addClass(randomClass()).css({

   'color': '!important',
   'background-color': '!important'
  });
 });

 // Sets background image for the element
 $('[data-with-bgimage="yes"]').each(function(k, i) {

  $(i).addClass('image-bg-' + (Math.round(Math.random()) + 1));
 });

	// window.history.pushState(data, title, url);

	// Get the button
	var mybutton = document.getElementById("myBtn");

	function scrollFunction() {

		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {

			mybutton.style.display = "block";
		} else {

			mybutton.style.display = "none";
		}
	}

	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function() {

		scrollFunction();
	};

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {

		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
});
</script>