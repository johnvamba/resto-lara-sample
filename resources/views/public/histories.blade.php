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

@include('public.partial.dropdown-nav')

@section('content')
<div class="row" id="app">
	<div class="col-md-8">
		<h4>Reservations</h4>
		<div class="row">
			<div class="col-md-6 mb-4 space-card" v-for="space in spaces" :key="space.id">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">@{{ space.name }}</h5>
						<h5 class="card-subtitle mb-2 text-muted">@{{space.type}} <span class="label label-info pull-right">@{{space.status}}</span></h6>
						<p class="card-text">@{{space.description}}</p>
						<a href="#" @click.prevent="reserve = space" class="card-link">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>
@endsection

@push('script')
<script type="text/javascript">
	Vue.config.devtools = true
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
				// axios.get("{{ route('api.space.index') }}")
				// .then(({data})=>{
				// 	this.spaces = data.data;
				// 	console.log('results', data.data);
				// })
			},
			submit: function(){
				this.submitting = true;
				axios.post("{{ route('public.post')}}", {
					reserve: this.reserve ? this.reserve.id : null,
					date: this.date,
					persons: this.persons,
					request: this.request
				}).then(({data}) =>{
					console.log('data res', data);
				}).catch(()=>{

				}).finally(()=>{
					this.submitting = false;
				})
			},
			cancellation: function(){

			},
			confirmation: function(){

			}
		},
		mounted: function() {
			this.loadSpaces()
			$('#datetimepicker1').datetimepicker()
				.on('dp.change', (e) => this.date = e.date.toString());
		}
	});
	console.log('open')
</script>
@endpush