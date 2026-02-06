<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\CategoryField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! User::query()->where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Global Admin',
                'email' => 'admin@example.com',
                'role' => User::ROLE_GLOBAL_ADMIN,
            ]);
        }

        // Core IT documentation categories (can be extended later via UI)
        $printers = Category::firstOrCreate(
            ['slug' => 'printers'],
            [
                'name' => 'Printers',
                'description' => 'Network and local printers used within the organization.',
            ],
        );

        $endpoints = Category::firstOrCreate(
            ['slug' => 'pc-laptops'],
            [
                'name' => 'PC & Laptops',
                'description' => 'Desktops, laptops and similar endpoints.',
            ],
        );

        $servers = Category::firstOrCreate(
            ['slug' => 'servers'],
            [
                'name' => 'Servers',
                'description' => 'On-premise and cloud servers.',
            ],
        );

        // Default structured fields for common categories.
        // Admins will later manage and extend these via the UI.

        // Printers
        CategoryField::firstOrCreate(
            ['category_id' => $printers->id, 'key' => 'ip_address'],
            [
                'label' => 'IP Address',
                'field_type' => 'text',
                'is_sensitive' => false,
                'is_required' => true,
                'sort_order' => 10,
                'help_text' => 'Printer IP address on the internal network.',
            ],
        );

        CategoryField::firstOrCreate(
            ['category_id' => $printers->id, 'key' => 'admin_password'],
            [
                'label' => 'Admin Password',
                'field_type' => 'password',
                'is_sensitive' => true,
                'is_required' => false,
                'sort_order' => 20,
                'help_text' => 'Administrative password for the printer web UI.',
            ],
        );

        CategoryField::firstOrCreate(
            ['category_id' => $printers->id, 'key' => 'location'],
            [
                'label' => 'Location',
                'field_type' => 'text',
                'is_sensitive' => false,
                'is_required' => false,
                'sort_order' => 30,
                'help_text' => 'Physical location (e.g. Floor 2, Office 201).',
            ],
        );

        // PC & Laptops
        CategoryField::firstOrCreate(
            ['category_id' => $endpoints->id, 'key' => 'hostname'],
            [
                'label' => 'Hostname',
                'field_type' => 'text',
                'is_sensitive' => false,
                'is_required' => true,
                'sort_order' => 10,
                'help_text' => 'System hostname / device name.',
            ],
        );

        CategoryField::firstOrCreate(
            ['category_id' => $endpoints->id, 'key' => 'ip_address'],
            [
                'label' => 'IP Address',
                'field_type' => 'text',
                'is_sensitive' => false,
                'is_required' => false,
                'sort_order' => 20,
                'help_text' => 'Primary IP address (if static or reserved).',
            ],
        );

        CategoryField::firstOrCreate(
            ['category_id' => $endpoints->id, 'key' => 'teamviewer_id'],
            [
                'label' => 'TeamViewer ID',
                'field_type' => 'text',
                'is_sensitive' => true,
                'is_required' => false,
                'sort_order' => 30,
                'help_text' => 'Remote support client ID (e.g. TeamViewer, AnyDesk).',
            ],
        );

        CategoryField::firstOrCreate(
            ['category_id' => $endpoints->id, 'key' => 'ssh_details'],
            [
                'label' => 'SSH / Remote Access Details',
                'field_type' => 'textarea',
                'is_sensitive' => true,
                'is_required' => false,
                'sort_order' => 40,
                'help_text' => 'SSH username, port and other remote access details.',
            ],
        );

        // Servers
        CategoryField::firstOrCreate(
            ['category_id' => $servers->id, 'key' => 'ip_address'],
            [
                'label' => 'IP Address',
                'field_type' => 'text',
                'is_sensitive' => false,
                'is_required' => true,
                'sort_order' => 10,
                'help_text' => 'Primary IP address used to access the server.',
            ],
        );

        CategoryField::firstOrCreate(
            ['category_id' => $servers->id, 'key' => 'ssh_details'],
            [
                'label' => 'SSH / Console Access',
                'field_type' => 'textarea',
                'is_sensitive' => true,
                'is_required' => false,
                'sort_order' => 20,
                'help_text' => 'SSH or console login details (user, port, bastion, etc.).',
            ],
        );

        CategoryField::firstOrCreate(
            ['category_id' => $servers->id, 'key' => 'admin_credentials'],
            [
                'label' => 'Admin Credentials',
                'field_type' => 'password',
                'is_sensitive' => true,
                'is_required' => false,
                'sort_order' => 30,
                'help_text' => 'Administrative web UI or control panel credentials.',
            ],
        );
    }
}
