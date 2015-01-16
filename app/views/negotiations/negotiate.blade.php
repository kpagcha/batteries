<div id="show-negotiation" class="default-box text-center col-md-11 col-sm-11 col-xs-10">
	<p>
		<strong>Proposed price</strong>
		<span>{{ $negotiation->price }} €</span><br>
		<strong>Total</strong>
		<span>{{ $negotiation->price * $negotiation->amount }} €</span>
	</p>
	<div id="negotiation-buttons" class="btn-group">
		<?php $disabled = ($negotiation->turn != Auth::user()->id) ? "disabled" : ""; ?>
		<div class="col-md-8 col-xs-6">
			<button id="accept-offer" type="button" class="btn btn-default no-borders-button succeed {{ $disabled }}">
				{{ Form::open() }}
					{{ Form::hidden('negotiation-id', $negotiation->id) }}
				{{ Form::close() }}
				<span class="glyphicon glyphicon-ok-circle"></span>
			</button>
			<button id="reject-offer" type="button" class="btn btn-default no-borders-button delete {{ $disabled }}">
				{{ Form::open() }}
					{{ Form::hidden('negotiation-id', $negotiation->id) }}
				{{ Form::close() }}
				<span class="glyphicon glyphicon-remove-circle"></span>
			</button>
		</div>
		<div class="col-md-4 col-xs-4">
			<button id="counter-offer" type="button" class="btn btn-default no-borders-button proceed {{ $disabled }}">
				{{ Form::open() }}
					{{ Form::hidden('negotiation-id', $negotiation->id) }}
				{{ Form::close() }}
				<span class="glyphicon glyphicon-refresh"></span>
			</button>
		</div>
	</div>
</div>