<?php

namespace App\Policies;

use App\Models\Default\User;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::viewAny_reply->name);
    }

    public function view(User $user, $reply)
    {
        if ($user->hasPermissionTo(PermissionsEnum::view_reply->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $reply->user->id) {
                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_reply->name);
    }

    public function update(User $user, $reply)
    {
        if ($user->hasPermissionTo(PermissionsEnum::update_reply->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $reply->user->id) {
                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function replicate(User $user, $reply)
    {
        if ($user->hasPermissionTo(PermissionsEnum::replicate_reply->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $reply->user->id) {
                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function delete(User $user, $reply)
    {
        if($user->hasPermissionTo(PermissionsEnum::delete_reply->name)){

            if ($user->hasRole(RolesEnum::superAdmin->name)) {
                return true;
            }

            if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::admin->name)) {
                if ($reply->user->hasRole([RolesEnum::admin->name, RolesEnum::superAdmin->name])) {
                    return false;
                } else {
                    return true;
                }
            } else if ($user->id === $reply->user->id) {
                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }

            return false;
        }
        return false;
    }

    public function restore(User $user, $reply)
    {
        if ($user->hasPermissionTo(PermissionsEnum::restore_reply->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $reply->user->id) {
                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $reply->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($reply->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function forceDelete(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::forceDelete_reply->name);
    }

    public function runAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_reply->name) && $user->hasPermissionTo(PermissionsEnum::update_reply->name);
    }

    public function runDestructiveAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::update_reply->name) && $user->hasPermissionTo(PermissionsEnum::delete_reply->name);
    }
}
