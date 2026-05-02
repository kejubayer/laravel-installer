<?php

namespace Kejubayer\Installer\Helpers;

class EnvEditor
{
    public static function set(array $data): void
    {
        $envPath = base_path('.env');

        if (! file_exists($envPath) && file_exists(base_path('.env.example'))) {
            copy(base_path('.env.example'), $envPath);
        }

        if (! file_exists($envPath)) {
            throw new \RuntimeException('Unable to create .env file.');
        }

        $env = file_get_contents($envPath) ?: '';

        foreach ($data as $key => $value) {
            $escapedKey = preg_quote($key, '/');
            $line = sprintf('%s="%s"', $key, addcslashes((string) $value, '"'));

            if (preg_match('/^' . $escapedKey . '=.*/m', $env)) {
                $env = preg_replace('/^' . $escapedKey . '=.*/m', $line, $env) ?? $env;
            } else {
                $env .= PHP_EOL . $line;
            }
        }

        file_put_contents($envPath, trim($env) . PHP_EOL);
    }
}
