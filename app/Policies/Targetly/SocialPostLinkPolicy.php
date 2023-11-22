<?php

namespace App\Policies\Targetly;

use App\Models\Default\User;
use App\Models\Targetly\SocialPostLink;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Auth\Access\Response;

class SocialPostLinkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::viewAny_socialPostLink->name);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SocialPostLink $socialPostLink): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::view_socialPostLink->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $socialPostLink->user->id) {
                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
        return $user->hasPermissionTo(PermissionsEnum::create_socialPostLink->name);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SocialPostLink $socialPostLink): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::update_socialPostLink->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $socialPostLink->user->id) {
                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
    public function delete(User $user, SocialPostLink $socialPostLink): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::delete_socialPostLink->name)) {

            if ($user->hasRole(RolesEnum::superAdmin->name)) {
                return true;
            }

            if ($user->id === $socialPostLink->user->id) {
                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::admin->name)) {
                if ($socialPostLink->user->hasRole([RolesEnum::admin->name, RolesEnum::superAdmin->name])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }

            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SocialPostLink $socialPostLink): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::restore_socialPostLink->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $socialPostLink->user->id) {
                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $socialPostLink->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($socialPostLink->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
    public function forceDelete(User $user, SocialPostLink $socialPostLink): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::forceDelete_socialPostLink->name);
    }
}
