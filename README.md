# Laravel Installer

A **smart, production-friendly Laravel installation wizard** for apps deployed on shared hosting, cPanel, VPS, or traditional servers.

`kejubayer/laravel-installer` adds a modern multi-step installer UI that guides users through:

- server requirement checks,
- file permission checks,
- database credential setup and validation,
- migration + optional seeding,
- installation lock to prevent re-running the installer.

## Package Description

This package is designed for Laravel products that are distributed to end users and need a browser-based setup flow instead of manual CLI-only installation.

### What it does

- Registers installation routes automatically via a service provider.
- Provides an install flow under a configurable route prefix (default: `/install`).
- Verifies PHP and required extensions before installation.
- Validates writable paths (`storage`, `bootstrap/cache`).
- Tests MySQL database credentials before saving.
- Updates `.env` database keys safely.
- Runs `php artisan migrate --force` and optional seeding.
- Creates a `storage/installed` lock file to block re-installation.

### Compatibility

- **PHP:** `^8.1`
- **Laravel:** `^10.0 | ^11.0 | ^12.0`

## Installation

### 1) Install via Composer

```bash
composer require kejubayer/laravel-installer
```

The package supports Laravel auto-discovery, so the service provider is registered automatically.

### 2) (Optional) Publish configuration

Publish config only if you want to override defaults:

```bash
php artisan vendor:publish --tag=installer-config
```

Published file:

- `config/installer.php`

### 3) (Optional) Publish views

Publish views if you want to customize the installer UI:

```bash
php artisan vendor:publish --tag=installer-views
```

Published path:

- `resources/views/vendor/installer`

## Usage

### 1) Configure installer options (optional)

Edit `config/installer.php`:

```php
return [
    'route_prefix' => 'install',
    'seed' => true,
    'required' => [
        'php' => '8.1.0',
    ],
];
```

- `route_prefix`: URL path for installer routes.
- `seed`: runs seeders automatically after migration.
- `required.php`: minimum PHP version requirement.

### 2) Open the installer in browser

Visit:

```text
https://your-domain.com/install
```

(Or your custom route prefix from config.)

### 3) Complete the installer steps

The wizard will guide you through:

1. **Requirements**: checks PHP version and required extensions.
2. **Permissions**: verifies `storage/` and `bootstrap/cache/` are writable.
3. **Database**: validates connection details and writes DB values to `.env`.
4. **Migration/Seed**: runs migration (and seed if enabled).
5. **Finish**: creates lock file at `storage/installed`.

Once `storage/installed` exists, installer routes return `404` to prevent re-installation.

## Reset / Re-run Installer

If you intentionally need to run installer again (for development/testing), remove the lock file:

```bash
rm storage/installed
```

> Do this only when you fully understand the impact on an existing installation.

## Security Notes

- Keep the installer enabled only until setup is complete.
- The lock file prevents public re-entry after installation.
- Use strong database credentials and secure server file permissions.

## License

MIT
