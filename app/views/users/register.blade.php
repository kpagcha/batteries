<div class="col-md-6 col-md-offset-2 col-xs-12 container-default">
    <div class="text-center extra-padding">
        <h1>Sign up</h1>
        <p class="lead">Become a new member of our page</p>

        <ul id="registration-errors" class="alert alert-warning list-unstyled hidden"></ul>
    </div>

    <div class="col-md-12 col-xs-12">
    {{ Form::open(['id' => 'register-form']) }}

        <div class="form-group">
            {{ Form::label('email', 'Email', ['class' => 'control-label']) }}<br/>
            {{ Form::text('email', Input::old('email'), ['class' => 'form-control', 'autocomplete' => 'on']) }}
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password', ['class' => 'control-label']) }}<br/>
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('password_confirmation', 'Confirm password', ['class' => 'control-label']) }}<br/>
            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('first_name', 'First name', ['class' => 'control-label']) }}<br/>
            {{ Form::text('first_name', Input::old('first_name'), ['class' => 'form-control', 'autocomplete' => 'on']) }}
        </div>

        <div class="form-group">
            {{ Form::label('last_name', 'Last name', ['class' => 'control-label']) }}<br/>
            {{ Form::text('last_name', Input::old('last_name'), ['class' => 'form-control', 'autocomplete' => 'on']) }}
        </div>

        <div class="form-group">
            {{ Form::label('city', 'City', ['class' => 'control-label']) }}<br/>
            {{ Form::text('city', Input::old('city'), ['class' => 'form-control', 'autocomplete' => 'on']) }}
        </div>

        <div class="form-group">
            {{ Form::label('country', 'Country code', ['class' => 'control-label']) }}<br/>
            {{ Form::text('country', Input::old('country'), ['class' => 'form-control', 'autocomplete' => 'on']) }}
        </div>

        <div class="form-group">
            {{ Form::label('phone', 'Phone number', ['class' => 'control-label']) }}<br/>
            {{ Form::text('phone', Input::old('phone'), ['class' => 'form-control', 'autocomplete' => 'on']) }}
        </div>

        <div class="form-group col-md-6 col-md-offset-3 col-xs-12">
            {{ Form::submit('Sign up', ['id' => 'register-submit', 'class' => 'btn btn-primary form-control']) }}
        </div>

    {{ Form::close() }}
    </div>
</div>