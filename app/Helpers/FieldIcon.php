<?php

namespace App\Helpers;

use App\Models\Category;

class FieldIcon
{
    /**
     * Map category field keys to icon names for the icon component.
     *
     * @var array<string, string>
     */
    protected static array $map = [
        'ip_address' => 'network',
        'admin_password' => 'lock',
        'password' => 'lock',
        'location' => 'map-pin',
        'ssh_details' => 'terminal',
        'teamviewer_id' => 'remote',
        'hostname' => 'laptop',
        'admin_credentials' => 'lock',
    ];

    /**
     * IT-related icons allowed for category/entry icon picker.
     * Keys are icon names for <x-icon name="…">, values are labels for the UI.
     *
     * @return array<string, string>
     */
    public static function categoryIconOptions(): array
    {
        return [
            'folder' => __('Folder'),
            'document-text' => __('Document'),
            'printer' => __('Printer'),
            'server' => __('Server'),
            'laptop' => __('Laptop / PC'),
            'remote' => __('Remote desktop'),
            'network' => __('Network / Wi‑Fi'),
            'terminal' => __('Terminal / SSH'),
            'lock' => __('Lock / Password'),
            'key' => __('Key'),
            'map-pin' => __('Location'),
            'user' => __('User'),
            'category' => __('Tag / Category'),
            'cog' => __('Settings'),
            'clock' => __('Clock'),
            'globe' => __('Website / CMS'),
            'link' => __('Link / URL'),
            'shopping-bag' => __('Shop / Shopify'),
            'shopping-cart' => __('Store / E‑commerce'),
            'credit-card' => __('Payments'),
            'cloud' => __('Cloud'),
            'building' => __('Business / Office'),
            'briefcase' => __('Briefcase'),
            'chart-bar' => __('Analytics'),
            'presentation-chart' => __('Reports'),
            'window' => __('Browser / App'),
        ];
    }

    /**
     * Allowed icon names for category icon (for validation).
     *
     * @return list<string>
     */
    public static function allowedCategoryIconNames(): array
    {
        return array_keys(self::categoryIconOptions());
    }

    public static function forFieldKey(string $key): string
    {
        return self::$map[$key] ?? 'key';
    }

    /**
     * Icon name for a category by slug (fallback when no icon chosen).
     */
    public static function forCategorySlug(?string $slug): string
    {
        return match($slug) {
            'printers' => 'printer',
            'servers' => 'server',
            'pc-laptops' => 'laptop',
            default => 'folder',
        };
    }

    /**
     * Icon name for a category: uses category's chosen icon if set and valid, else slug-based fallback.
     */
    public static function forCategory(?Category $category): string
    {
        if ($category === null) {
            return 'folder';
        }
        if ($category->icon !== null && $category->icon !== '' && in_array($category->icon, self::allowedCategoryIconNames(), true)) {
            return $category->icon;
        }
        return self::forCategorySlug($category->slug);
    }
}
