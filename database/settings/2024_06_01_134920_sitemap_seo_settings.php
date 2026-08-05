<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class SitemapSeoSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('seo.sitemap_update', '');
    }
}
