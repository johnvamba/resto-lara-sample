@extends('layout.core')

@push('css')
<style type="text/css">
	
</style>
@endpush

@include('admin.partial.dropdown-nav')

@section('content')
<div class="row" id="app">
	<div class="col-md-8">
		<h4>Reservations</h4>
		<div class="col-md-6 mb-4 space-card" v-for="transaction in transactions" :key="transaction.id">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title text-info mx-0 my-2">@{{ transaction.reserved_at }}</h4>
					<hr class="m-0" />
					<h4 class="card-title">@{{ transaction.space.name }}</h4>
					<h5 class="card-subtitle mb-2 text-muted">Reservation for @{{ transaction.persons ?? 1 }} <span class="label label-info pull-right">@{{ transaction.status }}</span></h5>

					<p class="card-text">@{{ transaction.request}}</p>
					<a href="#" class="card-link">Cancel</a>
					<a href="#" class="card-link">Approve</a>
					<a href="#" class="card-link">Change</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		@if(isset($space))
		<h4>Settings</h4>
		<div class="mb-4 space-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $space->name }}</h5>
					<h5 class="card-subtitle mb-2 text-muted">{{$space->type}} <span class="label label-info pull-right">{{$space->status}}</span></h6>
					<p class="card-text">{{$space->description}}</p>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
@endsection

@push('script')
<script type="text/javascript">
	var app = new Vue({
		el: '#app',
		data: {
			transactions: [],
			links: {
				//for pagination
			}
		},
		methods: {
			loadSpaces:function(){
				axios.get("{{ route('api.space.show', compact('space')) }}")
				.then(({data})=>{
					this.transactions = data.data;
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