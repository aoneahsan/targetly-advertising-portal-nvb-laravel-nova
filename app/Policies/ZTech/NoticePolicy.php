<?php

namespace App\Policies\ZTech;

use App\Models\Default\User;
use App\Models\Notice;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Auth\Access\Response;

class NoticePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::viewAny_notice->name);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, $notice): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::view_notice->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $notice->user->id) {
                return true;
            } else if ($user->id !== $notice->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($notice->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::create_notice->name);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $notice): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::update_notice->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $notice->user->id) {
                return true;
            } else if ($user->id !== $notice->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($notice->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $notice): bool
    {
        if($user->hasPermissionTo(PermissionsEnum::delete_notice->name)){

            if ($user->hasRole(RolesEnum::superAdmin->name)) {
                return true;
            }

            if ($user->id !== $notice->user->id && $user->hasRole(RolesEnum::admin->name)) {
                if ($notice->user->hasRole([RolesEnum::admin->name, RolesEnum::superAdmin->name])) {
                    return false;
                } else {
                    return true;
                }
            } else if ($user->id === $notice->user->id) {
                return true;
            }

            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, $notice): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::restore_notice->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $notice->user->id) {
                return true;
            } else if ($user->id !== $notice->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($notice->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::forceDelete_notice->name);
    }
}
