<div class="col-md-6 col-md-offset-2" role="tabpanel">
	<ul id="main-tabs" class="nav nav-tabs col-md-offset-4 col-xs-offset-4" role="tablist">
	    <li role="presentation" class="active"><a id="catalog-tab" href="#catalog" aria-controls="catalog" role="tab" data-toggle="tab"><img src="/images/sprites/catalog.png"></a></li>
	    @if (Auth::check() && Auth::user()->hasRole('customer'))
	    	<li id="shopping-cart-tab" role="presentation"><a href="#shopping-cart"><img src="/images/sprites/shopping-cart-empty.png"></a></li>
	    @endif
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="catalog">
			<div class="panel panel-default">
				<div class="panel-heading">Batteries catalog</div>
				<div class="panel-body">
					<p>This is the catalog of <strong>Batteries App</strong>. We have everything you need!</p>
					@if (count($batteries) == 0)
						<hr>
						<p>There are no items yet.</p>
					@endif
				</div>
				@if (count($batteries))
					<ul class="list-group">
						@foreach ($batteries as $battery)
							<li class="list-group-item">
								{{ Form::open() }}
									{{ Form::hidden('battery-id', $battery->id) }}
								{{ Form::close() }}
								<a name="show-battery" href="/battery/{{ $battery->id }}">
									{{ $battery->name }} ({{ $battery->category }}), {{ $battery->voltage }} volts
									@if ($battery->technology != "")
										&#8212; {{ $battery->technology }}
									@endif
								</a>
								@if (Auth::check() && Auth::user()->hasRole('customer'))
									<span class="pull-right" data-toggle="tooltip" data-placement="right" title="Add to cart"><a href="#" name="add-to-cart">+</a></span>
								@endif
							</li>
						@endforeach
					</ul>
				@endif
			</div>
		</div>
		@if (Auth::check() && Auth::user()->hasRole('customer'))
			<div role="tabpanel" class="tab-pane" id="shopping-cart"></div>
		@endif
	</div>
</div>