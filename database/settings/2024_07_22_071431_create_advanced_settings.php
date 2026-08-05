<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateAdvancedSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('advanced.recaptcha_active', false);
        $this->migrator->add('advanced.facebook_login_active', false);
        $this->migrator->add('advanced.google_login_active', false);
        $this->migrator->add('advanced.adsense_active', false);
        $this->migrator->add('advanced.google_analytics_code', '');
        $this->migrator->add('advanced.custom_head_code', '');
        $this->migrator->add('advanced.custom_footer_code', '');
        $this->migrator->add('advanced.current_file_storage', 'local');
        $this->migrator->add('advanced.current_mail_driver', 'log');
        $this->migrator->add('advanced.adsense_client_id', '');
        $this->migrator->add('advanced.banner_above_header', '');
        $this->migrator->add('advanced.banner_before_content', '');
        $this->migrator->add('advanced.banner_after_content', '');
        $this->migrator->add('advanced.banner_sidebar_widget', '');
    }
}
