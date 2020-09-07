@extends('layout.core')

@push('css')
<style type="text/css">
	.card-body .card-link:first-child{
		margin-left: 10px;
	}
	.card-body .card-link{
		margin: 0px;
	}
</style>
@endpush

@include('admin.partial.dropdown-nav')

@section('content')
<div class="row" id="app">
	<div class="col-md-8">
		<h4>Reservations</h4>
		<div class="row">
			<div class="col-md-6 mb-4 space-card" v-for="transaction in transactions" :key="transaction.id">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title text-info mx-0 my-2"><a :href="transaction.url">@{{ transaction.reserved_at }}</a></h4>
						<hr class="m-3" />
						<h5 class="card-subtitle mb-2 text-muted">Reservation for @{{ transaction.persons || 1 }} <span class="label label-info pull-right">@{{ transaction.status }}</span></h5>
						<p class="card-text">@{{ transaction.request}}</p>
						<hr class="m-3" />
						<a href="#" v-if="transaction.status == 'pending'" @click.prevent="clickTo(transaction, 'approve')" class="card-link">Approve</a>
						<a href="#" class="card-link">Change</a>
						<a href="#" class="card-link pull-right" @click.prevent="clickTo(transaction, 'cancel')">Cancel</a>
					</div>
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
		computed: {
			labelColor: (model)=>{
				switch(model.status){
					case 'approved':
						return 'label-primary';
					case 'confirmed':
						return 'label-success';
					case 'pending':
						return 'label-info';
					case 'cancelled':
						return 'label-error';
					default:
						return 'label-secondary';
				}
			}
		},
		methods: {
			clickTo:function(reserve, to = 'approve'){
				if(!reserve)
					alert('Missing Space');

				axios.post(`/api/v0.1/reserve_transact/${reserve.id}/${to}`)
				.then(({data})=>{
					console.log('results', data);
				}).catch(()=>{
					alert('something happened');
				})
			},
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