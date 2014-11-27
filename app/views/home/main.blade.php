<div class="col-md-6 col-md-offset-2" role="tabpanel">
	<ul id="main-tabs" class="nav nav-tabs col-md-offset-4 col-xs-offset-3" role="tablist">
	    <li role="presentation" class="active" data-toggle="tooltip" data-placement="top" title="Catalog"><a id="catalog-tab" href="#catalog" aria-controls="catalog" role="tab" data-toggle="tab"><img src="/images/sprites/battery.png"></a></li>
	    @if (Auth::check() && Auth::user()->hasRole('customer'))
	    	<li id="shopping-cart-tab" role="presentation" data-toggle="tooltip" data-placement="top" title="Shopping cart"><a href="#shopping-cart"><img src="/images/sprites/shopping-cart-empty.png"></a></li>
	    @endif
	    @if (Auth::check() && (Auth::user()->hasRole('account_manager') || Auth::user()->hasRole('customer')))
	    	<li id="negotiations-tab" role="presentation" data-toggle="tooltip" data-placement="top" title="Current negotiations"><a href="#negotiations" aria-controls="negotiations" role="tab" data-toggle="tab"><img src="/images/sprites/negotiation.png"></a></li>
	    @endif
	    @if (Auth::check() && (Auth::user()->hasRole('administrator') || Auth::user()->hasRole('account_manager')))
	    	<li id="history-tab" role="presentation" data-toggle="tooltip" data-placement="top" title="History of negotiations"><a href="#history" aria-controls="history" role="tab" data-toggle="tab"><img src="/images/sprites/history.png"></a></li>
	    @endif
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="catalog">
			<div class="panel panel-default">
				<div class="panel-heading text-center"><h4>Batteries catalog</h4></div>
				<div class="panel-body text-center">
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
								<div class="row">
									<div class="col-md-11 col-sm-11 col-xs-10 top-void">
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
									</div>
								</div>
							</li>
						@endforeach
					</ul>
					<div class="panel-footer text-center" id="catalog-links">
						{{ $batteries->links() }}
					</div>
				@endif
			</div>
		</div>
		@if (Auth::check() && Auth::user()->hasRole('customer'))
			<div role="tabpanel" class="tab-pane" id="shopping-cart"></div>
		@endif
		@if (Auth::check() && (Auth::user()->hasRole('account_manager') || Auth::user()->hasRole('customer')))
			<div role="tabpanel" class="tab-pane" id="negotiations"></div>
		@endif
		@if (Auth::check() && (Auth::user()->hasRole('administrator') || Auth::user()->hasRole('account_manager')))
			<div role="tabpanel" class="tab-pane" id="history"></div>
		@endif
	</div>
</div>