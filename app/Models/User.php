<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_GLOBAL_ADMIN = 'global_admin';

    public const ROLE_IT_WORKER = 'it_worker';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'preferences' => 'array',
        ];
    }

    public const PREF_ITEMS_PER_PAGE = 'items_per_page';

    public const PREF_RECENT_COUNT = 'recent_count';

    public const PREF_COMPACT_MODE = 'compact_mode';

    public const PREF_SIDEBAR_COUNTS = 'sidebar_counts';

    public function getPreference(string $key, mixed $default = null): mixed
    {
        return data_get($this->preferences ?? [], $key, $default);
    }

    public function setPreference(string $key, mixed $value): void
    {
        $prefs = $this->preferences ?? [];
        data_set($prefs, $key, $value);
        $this->preferences = $prefs;
        $this->save();
    }

    public function isGlobalAdmin(): bool
    {
        return $this->role === self::ROLE_GLOBAL_ADMIN;
    }

    public function isItWorker(): bool
    {
        return $this->role === self::ROLE_IT_WORKER;
    }
}

