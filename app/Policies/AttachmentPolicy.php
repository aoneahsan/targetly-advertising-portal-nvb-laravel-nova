<?php

namespace App\Policies;

use App\Models\Default\User;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttachmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::viewAny_attachment->name);
    }

    public function view(User $user, $attachment)
    {
        if ($user->hasPermissionTo(PermissionsEnum::view_attachment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $attachment->user->id) {
                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_attachment->name);
    }

    public function update(User $user, $attachment)
    {
        if ($user->hasPermissionTo(PermissionsEnum::update_attachment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $attachment->user->id) {
                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function replicate(User $user, $attachment)
    {
        if ($user->hasPermissionTo(PermissionsEnum::replicate_attachment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $attachment->user->id) {
                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function delete(User $user, $attachment)
    {
        if ($user->hasPermissionTo(PermissionsEnum::delete_attachment->name)) {

            if ($user->hasRole(RolesEnum::superAdmin->name)) {
                return true;
            }

            if ($user->id === $attachment->user->id) {
                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::admin->name)) {
                if ($attachment->user->hasRole([RolesEnum::admin->name, RolesEnum::superAdmin->name])) {
                    return false;
                } else {
                    return true;
                }
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }

            return false;
        }
        return false;
    }

    public function restore(User $user, $attachment)
    {
        if ($user->hasPermissionTo(PermissionsEnum::restore_attachment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $attachment->user->id) {
                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $attachment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($attachment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function forceDelete(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::forceDelete_attachment->name);
    }

    public function runAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_attachment->name) && $user->hasPermissionTo(PermissionsEnum::update_attachment->name);
    }

    public function runDestructiveAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::update_attachment->name) && $user->hasPermissionTo(PermissionsEnum::delete_attachment->name);
    }
}
