<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laravel Installer' }}</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f4f7fb;
            --card: #ffffff;
            --primary: #4f46e5;
            --primary-soft: #eef2ff;
            --success: #047857;
            --danger: #b91c1c;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(180deg, #eef2ff 0%, var(--bg) 100%);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .card {
            width: min(760px, 100%);
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.75rem;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        }

        .eyebrow {
            color: var(--primary);
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-size: .75rem;
            margin: 0 0 .5rem;
        }

        h1 { margin: 0; font-size: 1.7rem; }
        .subtitle { margin: .65rem 0 1.25rem; color: var(--muted); }

        .steps { display: flex; gap: .5rem; flex-wrap: wrap; margin: 1rem 0 1.5rem; }
        .step {
            padding: .45rem .75rem;
            border-radius: 999px;
            border: 1px solid var(--border);
            font-size: .85rem;
            color: var(--muted);
        }
        .step.active {
            background: var(--primary-soft);
            color: var(--primary);
            border-color: #c7d2fe;
            font-weight: 600;
        }

        .panel { border: 1px solid var(--border); border-radius: 14px; overflow: hidden; }
        .row { display: flex; justify-content: space-between; gap: .75rem; padding: .8rem 1rem; border-top: 1px solid var(--border); }
        .row:first-child { border-top: none; }
        .badge { font-size: .8rem; font-weight: 700; padding: .15rem .6rem; border-radius: 999px; }
        .badge.ok { background: #dcfce7; color: var(--success); }
        .badge.error { background: #fee2e2; color: var(--danger); }

        .fields { display: grid; gap: .9rem; }
        .field label { display: block; font-size: .83rem; color: var(--muted); margin-bottom: .35rem; }
        .field input {
            width: 100%; padding: .7rem .85rem; border: 1px solid var(--border); border-radius: 10px; font-size: .95rem;
        }

        .btn {
            margin-top: 1rem;
            border: 0;
            background: var(--primary);
            color: #fff;
            padding: .75rem 1rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        .muted { color: var(--muted); }
    </style>
</head>
<body>
<div class="card">
    <p class="eyebrow">Package Installer</p>
    <h1>{{ $heading ?? 'Laravel Installer' }}</h1>
    <p class="subtitle">Smart setup wizard for this package with clear checks and guided configuration.</p>

    <div class="steps">
        <span class="step {{ ($activeStep ?? 1) === 1 ? 'active' : '' }}">1. Requirements</span>
        <span class="step {{ ($activeStep ?? 1) === 2 ? 'active' : '' }}">2. Permissions</span>
        <span class="step {{ ($activeStep ?? 1) === 3 ? 'active' : '' }}">3. Database</span>
        <span class="step {{ ($activeStep ?? 1) === 4 ? 'active' : '' }}">4. Finish</span>
    </div>

    @yield('content')
</div>
</body>
</html>
