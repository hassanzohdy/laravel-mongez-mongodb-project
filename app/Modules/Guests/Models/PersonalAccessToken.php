<?php

namespace App\Modules\Guests\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class PersonalAccessToken extends Model
{
    protected $casts = [
        'abilities' => 'json',
        'last_used_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'os',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'token',
    ];

    /**
     * {@inheritDoc}
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // append the os header
            $model->os = request()->header('os');
        });
    }

    /**
     * Get the tokenable model that the access token belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function tokenable()
    {
        return $this->morphTo('tokenable');
    }

    /**
     * Find the token instance matching the given token.
     *
     * @param string $token
     * @return static|null
     */
    public static function findToken($token)
    {
        if (strpos($token, '|') === false) {
            return static::where('token', hash('sha256', $token))->first();
        }

        [$id, $token] = explode('|', $token, 2);

        $instance = static::find($id);

        if ($instance) {
            $instance = hash_equals($instance->token, hash('sha256', $token)) ? $instance : null;
        }

        if ($instance && $instance->os && $instance->os !== request()->header('os')) {
            return null;
        }

        return $instance;
    }

    /**
     * Determine if the token has a given ability.
     *
     * @param string $ability
     * @return bool
     */
    public function can($ability)
    {
        return in_array('*', $this->abilities) ||
            array_key_exists($ability, array_flip($this->abilities));
    }

    /**
     * Determine if the token is missing a given ability.
     *
     * @param string $ability
     * @return bool
     */
    public function cant($ability)
    {
        return !$this->can($ability);
    }
}
