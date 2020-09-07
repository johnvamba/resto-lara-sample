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
		<h4>History</h4>
		<table class="table">
			<thead>
				<tr>
					<th width="25%">Date</th>
					<th width="60%">Comment</th>
					<th width="15%">Status</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="history in histories" :key="history.id">
					<td>@{{ history.created_at }}</td>
					<td>@{{ history.comments }}</td>
					<td>
						<span class="label label-info">@{{ history.status }}</span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-4">
		<h4>Transaction</h4>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title text-info mx-0 my-2">{{ $reserve_transact->reserved_at->toDayDateTimeString() }}</h4>
				<hr class="m-3" />
				<h4 class="card-title">{{ optional($reserve_transact->space)->name ?? 'Unassigned' }}</h4>
				<h5 class="card-subtitle mb-2 text-muted">Reservation for {{ $reserve_transact->persons ?? 1 }} 
					@if($reserve_transact->status == 'expired')
					<span class="label label-danger pull-right">{{ $reserve_transact->status }}</span>
					@else
					<span class="label label-info pull-right">{{ $reserve_transact->status }}</span>
					@endif
				</h5>
				<p class="card-text">{{ $reserve_transact->request}}</p>
				<hr class="m-3" />
				@if($reserve_transact->status != 'expired')
					<a href="#" class="card-link pull-right">Cancel</a>
				@endif
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
			histories: [],
			links: {
				//for pagination
			}
		},
		methods: {
			loadHistory:function(){
				axios.get("{{ route('api.reserve_transact.show', compact('reserve_transact')) }}")
				.then(({data})=>{
					this.histories = data.data;
					console.log('results', data.data);
				})
			},
		},
		mounted: function() {
			this.loadHistory()
		}
	});
	console.log('open')
</script>
@endpush