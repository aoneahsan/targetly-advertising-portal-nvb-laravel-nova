<?php

namespace App\Policies\ZTech;

use App\Models\Batch;
use App\Models\Default\User;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Auth\Access\Response;

class BatchPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::viewAny_batch->name);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, $batch): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::view_batch->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $batch->user->id) {
                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
        return $user->hasPermissionTo(PermissionsEnum::create_batch->name);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $batch): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::update_batch->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $batch->user->id) {
                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
    public function delete(User $user, $batch): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::delete_batch->name)) {

            if ($user->hasRole(RolesEnum::superAdmin->name)) {
                return true;
            }

            if ($user->id === $batch->user->id) {
                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::admin->name)) {
                if ($batch->user->hasRole([RolesEnum::admin->name, RolesEnum::superAdmin->name])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
    public function restore(User $user, $batch): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::restore_batch->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $batch->user->id) {
                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $batch->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($batch->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
        return $user->hasPermissionTo(PermissionsEnum::forceDelete_batch->name);
    }
}
