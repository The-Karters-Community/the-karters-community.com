<?php

namespace App\Models\Api;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $identifier
 * @property string $key
 */
class ApiUser extends Authenticatable implements JWTSubject {
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'key',
        'remember_token'
    ];

    /**
     * Get the property that will identify the user at authentication.
     *
     * @return string
     */
    public function getAuthIdentifierName(): string {
        return 'id';
    }

    /**
     * Get the password for authentication.
     *
     * @return string
     */
    public function getAuthPassword(): string {
        return $this->key;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): string {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array {
        return [];
    }
}
