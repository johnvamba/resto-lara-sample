@extends('layout.core')

@push('css')
<style type="text/css">
	.space-card p.card-text {
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 2; /* number of lines to show */
		-webkit-box-orient: vertical;
	}
	.pull-right {
		float:right;
	}
</style>
@endpush

@section('dropdown-nav')
	<li class="nav-item dropdown">
	    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
	        {{ Auth::user()->username }} <span class="caret"></span>
	    </a>

	    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
	        <a class="dropdown-item" href="{{ route('logout') }}"
	           onclick="event.preventDefault();
	                         document.getElementById('logout-form').submit();">
	            {{ __('Logout') }}
	        </a>

	        <a class="dropdown-item" href="#">My Reservations</a>

	        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            @csrf
	        </form>
	    </div>
	</li>
@endsection

@section('content')
<div class="row" id="app" style="padding: 5px 25px">
	<div class="col-md-8"></div>
	<div class="col-md-4"></div>
</div>
@endsection

@push('script')
<script type="text/javascript">
	
</script>
@endpush