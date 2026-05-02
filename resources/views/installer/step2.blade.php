@extends('installer::installer.layout', ['title' => 'Installer • Permissions', 'heading' => 'Step 2: Permissions', 'activeStep' => 2])

@section('content')
<div class="panel">
    @foreach($permissions as $item => $ok)
        <div class="row">
            <span>{{ $item }}</span>
            <span class="badge {{ $ok ? 'ok' : 'error' }}">{{ $ok ? 'Writable' : 'Not writable' }}</span>
        </div>
    @endforeach
</div>

<div class="actions" style="margin-top:20px">
    <a href="{{ route('installer.database') }}" class="btn">Next</a>
</div>
@endsection
