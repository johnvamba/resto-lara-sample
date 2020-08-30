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
	<div class="col-md-8">
		<h4>Reservations</h4>
		<div class="row">
			<div class="col-md-4 mb-3 space-card" v-for="space in spaces" :key="space.id">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">@{{ space.name }}</h5>
						<h5 class="card-subtitle mb-2 text-muted">@{{space.type}} <span class="label label-info pull-right">@{{space.status}}</span></h6>
						<p class="card-text">@{{space.description}}</p>
						<a href="#" @click.prevent="reserve = space" class="card-link">Reserve</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4" v-if="confirmation != null">
		<h4>You have reservations ready to confirm.</h4>
	</div>
	<div class="col-md-4" v-else>
		<h4>Set your reservations</h4>
		<div class="card">
			<div class="card-body" v-if="reserve == null">
				<h4 class="card-title">Surprise me!</h5>
				<p class="card-text">Let us pick what's best for you</p>

			</div>
			<div class="card-body" v-else>
				<h4 class="card-title">@{{ reserve.name }}</h5>
				<h5 class="card-subtitle mb-2 text-muted">@{{reserve.type}} 
					<span class="label label-info pull-right">@{{reserve.status}}</span>
				</h6>
				<button class="btn btn-warning" @click.prevent="reserve = null" class="card-link">change</button>
			</div>
			<div class="card-body">
<!-- 				<div class="form-group">
					<label>Date</label>
					<div class="input-group date" data-provide="datepicker">
					    <input type="text" class="form-control">
					    <div class="input-group-addon">
					        <span class="glyphicon glyphicon-th"></span>
					    </div>
					</div>
				</div> -->
			    <div class="form-group">
			    	<label>Date Time</label>
	                <div class='input-group date' id='datetimepicker1' data-provide="datetimepicker">
	                    <input type='text' class="form-control" name="time" />
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
	            </div>
				<div class="form-group">
					<label>Number of persons</label>
					<input class="form-control" type="number" name="persons" v-model="persons">
				</div>
				<div class="form-group">
					<label>Request</label>
					<textarea class="form-control" type="text" name="request" v-model="request"></textarea>
				</div>
				<button class="btn btn-primary" @click.prevent="submit" :disabled="submitting">@{{submitting ? 'Submitting' : 'Submit'}}</button>
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
			confirmation: null,
			reserve: null,
			date: null,
			time: null,
			persons: 1,
			request: '',
			submitting: false,
			links: {
				//for pagination
			}
		},
		methods: {
			loadSpaces:function(){
				axios.get("{{ route('api.space.index') }}")
				.then(({data})=>{
					this.spaces = data.data;
					console.log('results', data.data);
				})
			},
			submit: function(){
				this.submitting = true;
				axios.post("{{ route('public.post')}}", {
					reserve:this.reserve,
					date: this.date,
					time: this.time,
					persons: this.persons,
					request: this.request
				}).then(({data}) =>{
					console.log('data res', data);
				}).catch(()=>{

				}).finally(()=>{
					this.submitting = false;
				})
			}
		},
		mounted: function() {
			this.loadSpaces()
			$('#datetimepicker1').datetimepicker();
		}
	});
	console.log('open')
</script>
@endpush