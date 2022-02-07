<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            "config_email_from" => "mail.tweb.com.vn@gmail.com",
            "config_email_from_name" => "TWEB",
            "config_email_smtp_host" => "smtp.gmail.com",
            "config_email_smtp_secure" => "ssl",
            "config_email_smtp_port" => "465",
            "config_email_smtp_authentication" => "on",
            "config_email_username" => "mail.tweb.com.vn@gmail.com",
            "config_email_password" => "ippzjraqqtawtevf",
            "config_email_test_to" => "mail.tweb.com.vn@gmail.com",
            "config_email_test_subject" => "TWEB",
            "config_email_test_message" => "Test Email",
            "theme_active" => "classified",
            "editor_content" => "tinymce",
            "config_maintenance_website_note" => NULL,
            "seo_title" => "TWEB - Chia sẽ những gì điều hay của một PHP developer",
            "seo_description" => "Thiết kế website,  Thiết kế CRM,  Dịch vụ Facebook,  Dịch vụ Youtube, Tư vấn/triển khai dịch vụ Haravan, Loyalty",
            "seo_keyword" => "Thiết kế website,  Thiết kế CRM,  Dịch vụ Facebook,  Dịch vụ Youtube, Tư vấn/triển khai dịch vụ Haravan",
            "company_name" => "TWEB",
            "company_address" => "Long An",
            "company_phone" => "0909123456",
            "company_hotline" => "0909123456",
            "company_email" => "mail.tweb.com.vn@gmail.com",
            "company_fax" => NULL,
            "company_map" => NULL,
            "company_website" => "https://tweb.com.vn",
            "company_facebook" => NULL,
            "company_google" => NULL,
            "company_youtube" => NULL,
            "company_pinterest" => NULL,
            "company_twitter" => NULL,
            "logo" => NULL,
            "favicon" => NULL,
            "code_header" => NULL,
            "code_footer" => NULL,
            "copyright" => NULL,
            "facebook_app_id" => NULL,
            "facebook_app_secret" => NULL,
            "facebook_app_callback_url" => base_url("member/callback/facebook"),
            "google_app_id" => "733257359163-952bmuk8278ncv8ehbal8r0tfnt4uatm",
            "google_app_secret" => "OeQCrcBgYogM83J0d70yKq3n",
            "google_app_callback_url" => base_url("member/callback/google"),
            "zalo_app_id" => NULL,
            "zalo_app_secret" => NULL,
            "zalo_app_callback_url" => base_url("member/callback/zalo"),
            "config_maintenance_website" => "off",
            "config_basic_auth" => "off",
            "login_basic_app_status" => "on",
            "login_facebook_app_status" => "on",
            "login_google_app_status" => "on",
            "login_zalo_app_status" => "on",
        ];

        foreach ($items as $key => $value) {
            \App\Models\Config::query()->updateOrInsert([
                'name' => $key,
                'value' => $value
            ]);
        }
    }
}
