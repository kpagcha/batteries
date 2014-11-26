<div id="counter-offer-form-container" class="col-md-12 text-center bottom-void">
	<hr>
	<form>
		<div class="col-md-10 col-xs-12">
			<input type='text' class='form-control' name='price' placeholder='Place new price'></input>
			{{ Form::hidden('negotiation-id', $negotiation_id) }}
		</div>
		<div class="col-md-2 col-xs-12">
			<button type='submit' class='btn btn-default no-borders-button succeed'>
				<span class='glyphicon glyphicon-ok'></span>
			</button>
		</div>
	</form>
</div>