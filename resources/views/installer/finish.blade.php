@extends('installer::installer.layout', ['title' => 'Installer • Completed', 'heading' => 'Installation Complete', 'activeStep' => 4])

@section('content')
<p class="muted">Great news — your package installation is complete and the installer is now locked.</p>
<p class="muted" style="margin-top: .35rem;">You're all set! Open your project homepage to start exploring your application.</p>

<a href="{{ url('/') }}" class="btn" style="display: inline-block; text-decoration: none; margin-top: 1.1rem; box-shadow: 0 8px 22px rgba(79, 70, 229, .28);">
    🚀 Go to Project Root
</a>
@endsection
