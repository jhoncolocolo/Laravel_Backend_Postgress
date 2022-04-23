<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject; 

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
   * @return  mixed
  */
  public function role_user(): HasMany
  {
      return $this->hasMany(RoleUser::class);
  }

  /**
   * @return  mixed
  */
  public function permission_user(): HasMany
  {
      return $this->hasMany(PermissionUser::class);
  }

  /**
   * @return  mixed
  */
  public function auto_data_step(): HasMany
  {
      return $this->hasMany(AutoDataStep::class);
  }

    /**
     * The attributes that should be cast to native types.
     * @var $route Route App
     * @var $user_id User Id
     * @return Boolean
    */
    public static function is_allow($route,$user_id)
    {
        $select = static::select(
                    array(
                    'users.id',  'users.name', 'permissions.name', 'route'
                  ))
                  ->join('role_users', 'role_users.user_id', '=', 'users.id')
                  ->leftJoin('permission_roles', 'permission_roles.role_id', '=', 'role_users.role_id')
                  ->leftJoin('permissions', 'permissions.id', '=', 'permission_roles.permission_id')
                  ->where('users.id', '=', $user_id)
                  ->where('permissions.route', '=', $route)
                  ->orwhereRaw("(role_users.role_id = 1 and users.id =".$user_id.")")
                  ;
        /*$resultado['Parametros'] = $select->getBindings();
        $query = str_replace(array('%', '?'), array('%%', '%s'), $select->toSql());
        $query = vsprintf($query, $select->getBindings());
        $resultado['Consulta'] = $query;
            dd(  $resultado);*/
        return $select->first();
    }

    /**
     * @return mixed
     */
    public function permission_by_users()
    {
        return
            //$this->hasMany(RoleUser::class)
            $this->hasMany('\App\Models\RoleUser', 'user_id', 'id')
                ->join('users', 'users.id', '=', 'role_users.user_id')
                ->join('roles', 'roles.id', '=', 'role_users.role_id')
                ->leftJoin('permission_roles', 'permission_roles.role_id', '=', 'role_users.role_id')
                ->leftJoin('permissions', 'permissions.id', '=', 'permission_roles.permission_id')
                ;
    }
}