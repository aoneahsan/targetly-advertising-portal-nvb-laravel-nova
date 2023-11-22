<?php

namespace App\Policies;

use App\Models\Default\User;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::viewAny_history->name);
    }

    public function view(User $user, $history)
    {
        if ($user->hasPermissionTo(PermissionsEnum::view_history->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $history->user->id) {
                return true;
            } else if ($user->id !== $history->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($history->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_history->name);
    }

    public function update(User $user, $history)
    {
        if ($user->hasPermissionTo(PermissionsEnum::update_history->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $history->user->id) {
                return true;
            } else if ($user->id !== $history->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($history->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function replicate(User $user, $history)
    {
        if ($user->hasPermissionTo(PermissionsEnum::replicate_history->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $history->user->id) {
                return true;
            } else if ($user->id !== $history->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($history->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function delete(User $user, $history)
    {
        if($user->hasPermissionTo(PermissionsEnum::delete_history->name)){

            if ($user->hasRole(RolesEnum::superAdmin->name)) {
                return true;
            }

            if ($user->id !== $history->user->id && $user->hasRole(RolesEnum::admin->name)) {
                if ($history->user->hasRole([RolesEnum::admin->name, RolesEnum::superAdmin->name])) {
                    return false;
                } else {
                    return true;
                }
            } else if ($user->id === $history->user->id) {
                return true;
            }

            return false;
        }
        return false;
    }

    public function restore(User $user, $history)
    {
        if ($user->hasPermissionTo(PermissionsEnum::restore_history->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $history->user->id) {
                return true;
            } else if ($user->id !== $history->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($history->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function forceDelete(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::forceDelete_history->name);
    }

    public function runAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_history->name) && $user->hasPermissionTo(PermissionsEnum::update_history->name);
    }

    public function runDestructiveAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::update_history->name) && $user->hasPermissionTo(PermissionsEnum::delete_history->name);
    }
}
