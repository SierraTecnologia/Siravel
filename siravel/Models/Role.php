<?php

namespace Siravel\Models;

// use Illuminate\Database\Eloquent\Model;
// use Facilitador\Facades\Voyager;

class Role extends \Facilitador\Models\Role
{
    /**
     * Acesso Deus para usuários de Infra
     *
     * @var array
     */
    public static $GOOD = 1;

    /**
     * Acesso Deus para usuários de Infra
     *
     * @var array
     */
    public static $ADMIN = 2;

    /**
     * São consumidores dos Clientes dos Usuários do Payment
     *
     * @var array
     */
    public static $CUSTOMER = 3;

    /**
     * Usuários do Organização
     *
     * @var array
     */
    public static $USER = 4;

    /**
     * São clientes dos Usuários do Payment.
     *
     * @var array
     */
    public static $CLIENT = 5;


    // @todo Verificar a necessidade pra nao dar conflito com o outro role


    // protected $fillable = ['display_name', 'description', 'external_auth_id'];

    // /**
    //  * The roles that belong to the role.
    //  */
    // public function users()
    // {
    //     return $this->belongsToMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class));
    // }

    // /**
    //  * Get all related JointPermissions.
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function jointPermissions()
    // {
    //     return $this->hasMany(JointPermission::class);
    // }

    // /**
    //  * The RolePermissions that belong to the role.
    //  */
    // public function permissions()
    // {
    //     return $this->belongsToMany(Permissions\RolePermission::class, 'permission_role', 'role_id', 'permission_id');
    // }

    // /**
    //  * Check if this role has a permission.
    //  * @param $permissionName
    //  * @return bool
    //  */
    // public function hasPermission($permissionName)
    // {
    //     $permissions = $this->getRelationValue('permissions');
    //     foreach ($permissions as $permission) {
    //         if ($permission->getRawAttribute('name') === $permissionName) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // /**
    //  * Add a permission to this role.
    //  * @param \Population\Models\Components\Book\Permissions\RolePermission $permission
    //  */
    // public function attachPermission(Permissions\RolePermission $permission)
    // {
    //     $this->permissions()->attach($permission->id);
    // }

    // /**
    //  * Detach a single permission from this role.
    //  * @param \Population\Models\Components\Book\Permissions\RolePermission $permission
    //  */
    // public function detachPermission(Permissions\RolePermission $permission)
    // {
    //     $this->permissions()->detach($permission->id);
    // }

    // /**
    //  * Get the role object for the specified role.
    //  * @param $roleName
    //  * @return Role
    //  */
    // public static function getRole($roleName)
    // {
    //     return static::where('name', '=', $roleName)->first();
    // }

    // /**
    //  * Get the role object for the specified system role.
    //  * @param $roleName
    //  * @return Role
    //  */
    // public static function getSystemRole($roleName)
    // {
    //     return static::where('system_name', '=', $roleName)->first();
    // }

    // /**
    //  * Get all visible roles
    //  * @return mixed
    //  */
    // public static function visible()
    // {
    //     return static::where('hidden', '=', false)->orderBy('name')->get();
    // }
}
