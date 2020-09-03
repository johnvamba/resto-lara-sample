@section('home-redirect')
<a class="navbar-brand" href="{{ url('/admin/dashboard') }}">
    {{ config('app.name', 'Laravel') }}
</a>
@endsection

@section('dropdown-nav')
	<li class="nav-item dropdown">
	    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
	        {{ Auth::user()->username }}
	    </a>

	    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
	        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Spaces</a>
 	        <a class="dropdown-item" href="#">Calendar</a>

	        <a class="dropdown-item" href="#">Users</a>
	        <a class="dropdown-item" href="#">Settings</a>
	        <a class="dropdown-item" href="{{ route('logout') }}"
	           onclick="event.preventDefault();
	                         document.getElementById('logout-form').submit();">
	            {{ __('Logout') }}
	        </a>

	        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            @csrf
	        </form>
	    </div>
	</li>
@endsection