@if (count($active_orders))
	@foreach ($active_orders as $key => $order)
		<ul class="list-group" id="#negotiations-list">
			@foreach ($order as $item)
				@include('negotiations.active_negotiation')
			@endforeach
		</ul>
	@endforeach
@endif