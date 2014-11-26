<div id="show" class="default-box text-center col-md-12">
	<p>
		<strong>Proposed price</strong>
		<span>{{ $negotiation->price }} €</span>
	</p>
	{{ Form::open(['id' => 'negotiation-form']) }}
	{{ Form::close() }}
</div>