<?php

namespace Siravel\Models;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use App\Models\Model;
// use Illuminate\Contracts\Auth\Access\Authorizable;
// use Illuminate\Contracts\Auth\CanResetPassword;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as UserAuthenticatable;


use Laravel\Passport\HasApiTokens;
use SiObjects\Manipule\Builders\UserBuilder;
use Siravel\Support\Traits\Models\HasRoutine;
use Siravel\Support\Traits\Models\HasTask;


class User extends \TCG\Voyager\Models\User
{
    use Notifiable, HasRoles, HasApiTokens;
    use AsHuman;

    // use HasRoutine, HasTask;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password',
        'remember_token',
        'name',
        'cpf',
        'username',
        'email',
        'role_id',
        'token',
        'token_public',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @inheritdoc
     */
    protected $with = [
        'role',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        // 'cpf' => [
        //     'type' => 'string',
        //     "analyzer" => "standard",
        // ],
        'email' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'role_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
    );

    /**
     * @inheritdoc
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $user) {
            optional($user->photos)->each(function (Photo $photo) {
                $photo->delete();
            });
        });
    }

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): UserBuilder
    {
        return parent::newQuery();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class, 'created_by_user_id');
    }

    /**
     * @return UserEntity
     */
    public function toEntity(): UserEntity
    {
        return new UserEntity([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password_hash' => $this->password,
            'role' => optional($this->role)->name,
            'created_at' => $this->created_at->toAtomString(),
            'updated_at' => $this->updated_at->toAtomString(),
        ]);
    }

    /**
     * Get all of the skills for the post.
     */
    public function skills()
    {
        return $this->morphToMany('Siravel\Models\Identity\Hability\Skill', 'skillable');
    }

    public function money()
    {
        return $this->belongsTo('App\Models\Money', 'money_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('Siravel\Models\System\Language', 'language_id', 'id');
    }
    

    /**
     * Referentes a Business
     * 
     * Retorna 3 Caso seja Deus
     * Retorna 2 Caso seja Admin
     * Retorna 1 Caso seja Inscrito
     * Retorna 0 Caso não seja Inscrito no Business
     */
    public function getLevelForAcessInBusiness()
    {
        if ($this->admin == 2) {
            return 2;
        }

        if ($this->admin == 1) {
            return 1;
        }

        return 0;
    }

    /**
     * Mostra o tipo de usuário para o cliente
     */
    public function getUserType()
    {
        if ($this->isAdmin()){
            return 'Admin';
        }
        return 'Business';
    }

    public function fullName()
    {
        return $this->name;
    }

    public function firstName()
    {
        $name = explode(' ', $this->name);
        return $name[0];
    }

    public function lastName()
    {
        $name = explode(' ', $this->name);
        return $name[strlen($name)-1];
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }

        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * Verifica se é admin para exibir informações dos outros usuários ou não
     */
    public function isAdmin()
    {
        return $this->role_id === Role::$GOOD || $this->role_id === Role::$ADMIN;
    }
    /**
     * Get all of the points for the post.
     */
    public function points()
    {
        return $this->morphToMany('App\Models\Gamification\Point', 'pointable');
    }

    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }

    public function homeUrl()
    {
        if ($this->hasRole('user')) {
            $url = route('user.home');
        } else {
            $url = route('admin.home');
        }

        return $url;
    }

    /**
     * Get all of the post's accounts.
     */
    public function accounts()
    {
        return $this->morphMany('Siravel\Models\Identity\Account', 'accountable');
    }

    /**
     * Financeiro
     */
    public function banks()
    {
        return $this->morphToMany('Siravel\Models\Identity\Financeiro\Bank', 'bankable');
    }
    public function rendas()
    {
        return $this->morphMany('Siravel\Models\Identity\Financeiro\Renda', 'rendable');
    }
    public function gastos()
    {
        return $this->morphMany('Siravel\Models\Identity\Financeiro\Gasto', 'gastoable');
    }

    /**
     * Worker e Tarefas
     */
    public function workers()
    {
        return $this->morphMany('Siravel\Models\Identity\Rotina\Worker', 'workerable');
    }
}
