<div class="col-md-6 col-md-offset-2" role="tabpanel">
	<ul id="main-tabs" class="nav nav-tabs col-md-offset-4" role="tablist">
	    <li role="presentation" class="active"><a id="catalog-tab" href="#catalog" aria-controls="catalog" role="tab" data-toggle="tab"><img src="/images/sprites/catalog.png"></a></li>
	    <li role="presentation"><a id="shopping-cart-tab" href="#shopping-cart" aria-controls="shopping-cart" role="tab" data-toggle="tab"><img src="/images/sprites/shopping-cart-empty.png"></a></li>
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
								{{ $battery->name }} ({{ $battery->category }}), {{ $battery->voltage }} volts
								@if ($battery->technology != "")
									&#8212; {{ $battery->technology }}
								@endif
								<span class="pull-right">+</span>
							</li>
						@endforeach
					</ul>
				@endif
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="shopping-cart">
			<div class="panel panel-default">
				<div class="panel-heading">Your shopping cart</div>
				<div class="panel-body">
					This is your shopping cart.
				</div>
			</div>
		</div>
	</div>
</div>