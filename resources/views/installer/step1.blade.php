@extends('installer::installer.layout', ['title' => 'Installer • Requirements', 'heading' => 'Step 1: Requirements', 'activeStep' => 1])

@section('content')
<div class="panel">
    @foreach($requirements as $item => $ok)
        <div class="row">
            <span>{{ $item }}</span>
            <span class="badge {{ $ok ? 'ok' : 'error' }}">{{ $ok ? 'OK' : 'Missing' }}</span>
        </div>
    @endforeach
</div>

<div class="actions" style="margin-top:20px">
    <a href="{{ route('installer.permissions') }}" class="btn">Next</a>
</div>
@endsection
