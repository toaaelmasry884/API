<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="users";
    protected $fillable = [
        'name', 
        'email', 
        'email_verified_at',
        'password', 
        'phone', 
        'image', 
        'address',
        'active', 
        'lat', 
        'lng',
        'number_posts',
        'number_groups',
        'number_following_groups', 
        'is_admin',
        'accepted_notifications', 
        'city_id',
        'uid',
        'token'
    ];
    
        public function likes(){
            return $this->hasMany('App\Models\Like');
        }

        public function post(){
             return $this->hasMany('App\Models\Post');
        }

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
   ///     jwt
   public function getJWTIdentifier()
   {
       return $this->getKey();
   }

   public function getJWTCustomClaims()
   {
       return [];
   }

//    public function setPasswordAttribute($password)
//    {
//        if ( $password !== null & $password !== "" ) {
//            $this->attributes['password'] = bcrypt($password);
//        }
//    }


}
