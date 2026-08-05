<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateThemeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('themes.theme_active', 'unimax');
    }
}
