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

	        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            @csrf
	        </form>
	    </div>
	</li>
@endsection

@section('content')
<div class="row" id="app" style="padding: 5px 25px">
	<div class="col-md-8">
		<h4>Reservations</h4>
		<div class="row">
			<div class="col-md-4 mb-3 space-card" v-for="space in spaces" :key="space.id">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">@{{ space.name }}</h5>
						<h6 class="card-subtitle mb-2 text-muted">@{{space.type}} <span class="label pull-right">@{{space.status}}</span></h6>
						<p class="card-text">@{{space.description}}</p>
						<a href="#" @click.prevent="reserve = space" class="card-link">Reserve</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<h4 v-if="reserve == null">Pick Reservation</h4>
		<div v-else class="card">
			<div class="card-body">
				<h5 class="card-title">@{{ reserve.name }}</h5>
				<h6 class="card-subtitle mb-2 text-muted">@{{reserve.type}} <span class="label pull-right">@{{reserve.status}}</span></h6>
				<p class="card-text">@{{reserve.description}}</p>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script type="text/javascript">
	var app = new Vue({
		el: '#app',
		data: {
			spaces: [],
			reserve: null,
			links: {
				//for pagination
			}
		},
		methods: {
			pickedReserve: (reserve)=>{
				console.log('clickeed', reserve);
				this.reserve = reserve;
			},
			loadSpaces:function(){
				axios.get("{{ route('api.space.index') }}")
				.then(({data})=>{
					this.spaces = data.data;
					console.log('results', data.data);
				})
			}
		},
		mounted: function() {
			this.loadSpaces()
		}
	});
	console.log('open')
</script>
@endpush