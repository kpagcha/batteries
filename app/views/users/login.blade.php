<div class="col-md-6 col-md-offset-2 col-xs-12 container-default">
    <div class="text-center extra-padding">
        <h1>Login</h1>
    </div>

    <div id="error" class="col-md-8 col-md-offset-2 col-xs-12 text-center alert alert-danger hidden"></div>

    <div class="col-md-12 col-xs-12">
    {{ Form::open(['id' => 'login-form', 'class' => 'form-horizontal']) }}

        <div class="form-group">
            {{ Form::label('email', 'Email', ['class' => 'control-label col-md-2']) }}
            <div class="col-md-10">
                {{ Form::text('email', Input::old('email'), ['class' => 'form-control', 'autocomplete' => 'on']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password', ['class' => 'control-label col-md-2']) }}
            <div class="col-md-10">
                {{ Form::password('password', ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="col-md-2 col-md-offset-5 col-sm-2 col-xs-3 col-xs-offset-5">
            <div class="form-group">
                {{ Form::submit('Login', ['id' => 'login-submit', 'class' => 'form-control btn btn-success']) }}
            </div>
        </div>

    {{ Form::close() }}
    </div>
</div>