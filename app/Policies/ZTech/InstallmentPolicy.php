<?php

namespace App\Policies\ZTech;

use App\Models\Default\User;
use App\Models\Installment;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Auth\Access\Response;

class InstallmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::viewAny_installment->name);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, $installment): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::view_installment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $installment->user->id) {
                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
        return $user->hasPermissionTo(PermissionsEnum::create_installment->name);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $installment): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::update_installment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $installment->user->id) {
                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
    public function delete(User $user, $installment): Response
    {
        if ($user->hasPermissionTo(PermissionsEnum::delete_installment->name)) {

            if ($user->hasRole(RolesEnum::superAdmin->name)) {
                return Response::allow();
            }

            if ($user->id === $installment->user->id) {
                return Response::allow();
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::admin->name)) {
                if ($installment->user->hasRole([RolesEnum::admin->name, RolesEnum::superAdmin->name])) {
                    return Response::deny('You do not own this installment.');
                } else {
                    return Response::allow();
                }
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }

            return Response::deny('You do not own this installment.');
        }
        return Response::deny('You do not own this installment.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, $installment): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::restore_installment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $installment->user->id) {
                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $installment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($installment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
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
        return $user->hasPermissionTo(PermissionsEnum::forceDelete_installment->name);
    }
}
