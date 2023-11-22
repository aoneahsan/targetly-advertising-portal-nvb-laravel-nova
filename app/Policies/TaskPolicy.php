<?php

namespace App\Policies;

use App\Models\Default\User;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::viewAny_task->name);
    }

    public function view(User $user, $task)
    {
        if ($user->hasPermissionTo(PermissionsEnum::view_task->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $task->user->id) {
                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_task->name);
    }

    public function update(User $user, $task)
    {
        if ($user->hasPermissionTo(PermissionsEnum::update_task->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $task->user->id) {
                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function replicate(User $user, $task)
    {
        if ($user->hasPermissionTo(PermissionsEnum::replicate_task->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $task->user->id) {
                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function delete(User $user, $task)
    {
        if($user->hasPermissionTo(PermissionsEnum::delete_task->name)){

            if ($user->hasRole(RolesEnum::superAdmin->name)) {
                return true;
            }

            if ($user->id === $task->user->id) {
                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::admin->name)) {
                if ($task->user->hasRole([RolesEnum::admin->name, RolesEnum::superAdmin->name])) {
                    return false;
                } else {
                    return true;
                }
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }

            return false;
        }
        return false;
    }

    public function restore(User $user, $task)
    {
        if ($user->hasPermissionTo(PermissionsEnum::restore_task->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $task->user->id) {
                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $task->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($task->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function forceDelete(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::forceDelete_task->name);
    }

    public function runAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_task->name) && $user->hasPermissionTo(PermissionsEnum::update_task->name);
    }

    public function runDestructiveAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::update_task->name) && $user->hasPermissionTo(PermissionsEnum::delete_task->name);
    }
}
