<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var User $subject */
        $subject = $this->route('user');

        return $this->user()?->can('update', $subject) ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var User $subject */
        $subject = $this->route('user');

        $roleRule = ['required', 'string', 'in:'.implode(',', [User::ROLE_GLOBAL_ADMIN, User::ROLE_IT_WORKER])];

        // Prevent demoting the last remaining global admin
        if ($subject->isGlobalAdmin()) {
            $roleRule[] = function (string $attribute, mixed $value, \Closure $fail) use ($subject): void {
                if ($value !== User::ROLE_GLOBAL_ADMIN) {
                    $otherAdmins = User::query()
                        ->where('id', '!=', $subject->id)
                        ->where('role', User::ROLE_GLOBAL_ADMIN)
                        ->count();

                    if ($otherAdmins === 0) {
                        $fail(__('At least one Global Admin user must remain.'));
                    }
                }
            };
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($subject->id),
            ],
            'role' => $roleRule,
        ];

        if ($this->filled('password')) {
            $rules['password'] = ['confirmed', Password::defaults()];
        }

        return $rules;
    }
}

