@extends('installer::installer.layout', ['title' => 'Installer • Database Setup', 'heading' => 'Step 3: Database Setup', 'activeStep' => 3])

@section('content')
<form method="POST" action="{{ route('installer.database.save') }}">
    @csrf
    <div class="fields">
        <div class="field">
            <label for="db_host">Database Host</label>
            <input id="db_host" name="db_host" placeholder="localhost" value="{{ old('db_host', 'localhost') }}" required>
        </div>
        <div class="field">
            <label for="db_port">Database Port</label>
            <input id="db_port" name="db_port" placeholder="3306" value="{{ old('db_port', '3306') }}" required>
        </div>
        <div class="field">
            <label for="db_name">Database Name</label>
            <input id="db_name" name="db_name" placeholder="my_app" value="{{ old('db_name') }}" required>
        </div>
        <div class="field">
            <label for="db_user">Database User</label>
            <input id="db_user" name="db_user" placeholder="root" value="{{ old('db_user') }}" required>
        </div>
        <div class="field">
            <label for="db_pass">Database Password</label>
            <input id="db_pass" name="db_pass" placeholder="••••••••" value="{{ old('db_pass') }}" type="password">
        </div>
    </div>

    <button type="submit" class="btn">Complete</button>
</form>
@endsection
