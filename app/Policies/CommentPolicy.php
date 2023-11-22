<?php

namespace App\Policies;

use App\Models\Default\User;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::viewAny_comment->name);
    }

    public function view(User $user, $comment)
    {
        if ($user->hasPermissionTo(PermissionsEnum::view_comment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $comment->user->id) {
                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_comment->name);
    }

    public function update(User $user, $comment)
    {
        if ($user->hasPermissionTo(PermissionsEnum::update_comment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $comment->user->id) {
                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function replicate(User $user, $comment)
    {
        if ($user->hasPermissionTo(PermissionsEnum::replicate_comment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $comment->user->id) {
                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function delete(User $user, $comment)
    {
        if($user->hasPermissionTo(PermissionsEnum::delete_comment->name)){

            if ($user->hasRole(RolesEnum::superAdmin->name)) {
                return true;
            }

            if ($user->id === $comment->user->id) {
                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::admin->name)) {
                if ($comment->user->hasRole([RolesEnum::admin->name, RolesEnum::superAdmin->name])) {
                    return false;
                } else {
                    return true;
                }
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }

            return false;
        }
        return false;
    }

    public function restore(User $user, $comment)
    {
        if ($user->hasPermissionTo(PermissionsEnum::restore_comment->name)) {
            if ($user->hasRole(RolesEnum::superAdmin->value)) {
                return true;
            }

            if ($user->id === $comment->user->id) {
                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::admin->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::manager->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value])) {
                    return false;
                }

                return true;
            } else if ($user->id !== $comment->user->id && $user->hasRole(RolesEnum::employee->value)) {
                if ($comment->user->hasRole([RolesEnum::superAdmin->value, RolesEnum::admin->value, RolesEnum::manager->value, RolesEnum::employee->value])) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

    public function forceDelete(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::forceDelete_comment->name);
    }

    public function runAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::create_comment->name) && $user->hasPermissionTo(PermissionsEnum::update_comment->name);
    }

    public function runDestructiveAction(User  $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::update_comment->name) && $user->hasPermissionTo(PermissionsEnum::delete_comment->name);
    }
}
