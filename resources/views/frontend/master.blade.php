<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

@yield('title')
<title>News Daily | NEWS SITE</title>
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"  />
<link href="{{asset('css/bootstrap-theme.min.css')}}" rel="stylesheet"  />
<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet"  />
<link href="{{asset('style.css')}}" rel="stylesheet" />
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</head>

<body>
<div class="col-md-12 top" id="top">
	<div class="col-md-9 top-left">
    	<div class="col-md-3">
    		<b><span class="day">{{date('l, M d, Y')}}</span></b>
        </div>
        <div class="col-md-9">
            <div class="breaking-news">
        	<span class="latest" style="color:red;">JUST IN : </span> <a href="{{url('article')}}/{{$lastnews->slug}}">{{$lastnews->title}}</a></div>
        </div>
    </div>
    <div class="col-md-3 top-social">
        @foreach($setting->social as $key=>$social)
    	<a href="{{$social}}" class="social-icon"><i class="fa fa-{{$icons[$key]}}"></i></a>
    	@endforeach
    </div>
</div>

<div class="col-md-12 brand">
	<div class="col-md-4 name">
        @if($setting->image)
    	<img src="{{url('settings')}}/{{$setting->image}}" width="100%" alt="newspaper logo">
        @endif
    </div>
    <div class="col-md-8">
        @if($leaderboard)
    	<a href="{{$leaderboard->url}}"><img src="{{url('advertisements')}}/{{$leaderboard->image}}" width="100%" alt="{{$leaderboard->title}}" /></a>
        @endif
    </div>
</div>

<div class="col-md-12 main-menu">
	<div class="col-md-10 menu">
		<nav class="navbar">
			<div class="navbar-header">
    			
    		</div>
    		<div class="collapse navbar-collapse" id="mynavbar">
    			<ul class="nav nav-justified">
    				<li><a href="{{url('/')}}" class="active"><span class="glyphicon glyphicon-home"></span></a></li>
                    @foreach($categories as $cat)

    				<li><a href="{{url('category')}}/{{$cat->slug}}" class="text-uppercase">{{$cat->title}}</a></li>
    				
                    @endforeach
        		</ul> 
			</div>
		</nav>
	</div>
	<div class="col-md-2 ">
        <div class="search">
    	<input type="search" id="search_content"class="form-control" />
        <span class="glyphicon glyphicon-search search-btn"></span>
        <div id="search-output"></div>
    </div>
    </div>
</div> 

<!--header-->
@yield('content')
<!--footer-->
<div class="col-md-12 bottom">
    	<div class="col-md-4">
        	<br>
             @if($setting->image)
        <img src="{{url('settings')}}/{{$setting->image}}" width="100%"  alt="newspaper logo">
        @endif
            <p align="justify"><h4 style="color:forestgreen;">{{$setting->about}}</h4></p>
        </div>
        <div class="col-md-4">
        	<div class="col-md-12">
            	<h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">Quick Links</span></h3>

                <ul class="nav">
                     @foreach($pages as $page)                    
                    <li><a href="{{url('page')}}\{{$page->slug}}" class="text-uppercase">{{$page->title}}</a></li>
                   @endforeach 
                                          
                    <li><a href="{{url('contact-us')}}" class="text-uppercase">Newsletter </a></li>
                </ul>
            </div>     
        </div>
        <div class="col-md-4">
        	<h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">Stay Connected for More !! </span></h3>
            @if($setting->image)
        <img src="{{url('settings')}}/{{$setting->image}}" width="100%" alt="newspaper logo">
        @endif
            <p>Follow us at:</p>
              @foreach($setting->social as $key=>$social)
        <a href="{{$social}}" class="social-icon"><i class="fa fa-{{$icons[$key]}}"></i></a>
        @endforeach
            <a href="#top" class="goto"><span class="glyphicon glyphicon-chevron-up"></span></a>
        </div>
</div>

<div class="col-md-12 text-center copyright">
	Copyright &copy; {{date('Y')}} | News Daily | Irhamul Islam
</div>
<script>     
$(document).ready(function(){
	var duration = 500;
	$(window).scroll(function() {
	if ($(this).scrollTop() > 500) {
    $('.goto').fadeIn(duration);
	} else {
    $('.goto').fadeOut(duration);
	}
});
	$('.goto').click(function(event) {
	event.preventDefault();
	$('html').animate({scrollTop: 0}, duration);
	return false;
})
    $('#search_content').keyup(function(){
        var text= $('#search_content').val();
        if(text.length <1){
            $('#search-output').hide();
            return false;
        }
        else{
            $.ajax({
                type: "get",
                url : "{{url('search-content')}}",
                data:{text:text},
                success:function(res){
                    $('#search-output').show();
                    $('#search-output').html(res);
                }
            })
        }
    })
});       
</script>	

</body>
</html>