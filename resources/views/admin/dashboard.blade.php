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

@include('admin.partial.dropdown-nav')

@section('content')
<div class="row" id="app">
	<div class="col-md-8">
		<h4>Areas</h4>
		<div class="row">
			<div class="col-md-6 mb-4 space-card" v-for="space in spaces" :key="space.id">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">@{{ space.name }}</h5>
						<h6 class="card-subtitle mb-2 text-muted">@{{space.type}} <span class="label pull-right">@{{space.status}}</span></h6>
						<p class="card-text">@{{space.description}}</p>
						<a :href="space.url" class="card-link">Check Reservations</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<h4>Requests</h4>
		<div class="mb-4 space-card" v-for="transaction in transactions" :key="transaction.id">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title text-info mx-0 my-2">@{{ transaction.reserved_at }}</h4>
					<hr class="m-0" />
					<h4 class="card-title">@{{ transaction.space ? transaction.space.name : 'UNDECIDED' }}</h4>
					<h5 class="card-subtitle mb-2 text-muted">Reservation for @{{ transaction.persons ?? 1 }} <span class="label label-info pull-right">@{{ transaction.status }}</span></h5>

					<p class="card-text">@{{ transaction.request}}</p>
					<a href="#" v-if="transaction.space != null" class="card-link ml-0">Approve</a>
					<a href="#" class="card-link">Change</a>
					<a href="#" class="card-link pull-right">Cancel</a>
				</div>
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
			transactions: [],
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
			loadAllSubmissions:function(){
				axios.get("{{ route('api.reserve_transact.index')}}")
				.then(({data})=>{
					this.transactions = data.data;
					console.log('results', data.data);
				})
			}
		},
		mounted: function() {
			this.loadAllSubmissions()
			this.loadSpaces()
		}
	});
	console.log('open')
</script>
@endpush