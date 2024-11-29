@extends('frontend.master')
@section('title')
<title>Contact Us | News Daily</title>
@endsection
@section('content')
	<div class="wrapper">
		<div class="row" style="margin-top:30px;">
			<div class="col-md-8">
				<div class="col-md-12" style="padding:15px 15px 30px 0px;">				
					<div class="col-md-12">
						<h1>Contact Us</h1><br>
						
						<p><b style="color:  #2b99ca;font-size: 20px">We would love to hear from you! If you have any questions, feedback, or inquiries, please fill out the form below or use the provided contact information. Our team will get back to you as soon as possible.</b></p><br>
					</div>	
					@if(Session::has('message'))
					<div class="col-sm-12">
						<div class="alert alert-success alert-dismissable fade in">
							<a href="#" class="close" style="text-decoration: none;" data-dismiss="alert">&times;</a>
						{{
							Session('message')
						}}
						</div>
					</div>
					@endif	

					<div class="col-sm-6">
						<form method="post" action="{{url('sendmessage')}}">
							@csrf
							<input type="hidden" name="tbl" value="{{encrypt('messages')}}">
							<div class="form-group">
								<label>Your Name</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control">
							</div>
							<div class="form-group">
								<label>Phone</label>
								<input type="tel" name="phone" class="form-control">
							</div>
							<div class="form-group">
								<label>Please write your concern.</label>
								<textarea name="message" class="form-control" rows="5"></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-success">Send</button>
							</div>
						</form>
					</div>				
			</div>
		</div>

<!-- right section -->
			<div class="col-md-4">
				<div class="col-md-12" style="padding:15px;">
					<h3 style="border-bottom:3px solid #2b99ca; padding-bottom:5px;"><span style="padding:6px 12px; background:#2b99ca;">LATEST NEWS</span></h3>
					@foreach($latest->take(10) as $l)
					<div class="col-md-12" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
						<div class="col-md-4">
							<div class="row">
								<a href="{{url('article')}}/{{$l->slug}}"><img src="{{url('posts')}}/{{$l->image}}" width="100%" style="margin-left:-15px;" /></a>
							</div>
						</div>
						<div class="col-md-8">
							<div class="row" style="padding-left:10px;">
								<h4><a href="{{url('article')}}/{{$l->slug}}">{{$l->title}}</a></h4>
							</div>
						</div>
					</div>
					@endforeach
				</div> 
				@if($sidebarTop)
		          <div class="sidebar-adv"><a href="{{$sidebarTop->url}}"><img src="{{url('advertisements')}}/{{$sidebarTop->image}}" width="100%" alt="{{$sidebarTop->title}}" /></a></div>
		          @endif
				 @if($sidebarBottom)
		          <div class="col-sm-12 sidebar-adv"><a href="{{$sidebarBottom->url}}"><img src="{{url('advertisements')}}/{{$sidebarBottom->image}}" width="100%" alt="{{$sidebarBottom->title}}" /></a></div>
		          @endif
			</div>
		</div> 
	</div>

	@endsection