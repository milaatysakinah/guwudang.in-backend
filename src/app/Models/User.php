<?php 

//namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;

//class User extends Authenticatable/
//{
//    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name',
 //       'email',
 //       'password',
 //   ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   // protected $hidden = [
   //     'password',
   //     'remember_token',
    //];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = [
    //    'email_verified_at' => 'datetime',
    //];*/
//}

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'email',
        'username',
        'address',
        'phone_number',
        'company_name',
        'profile_picture',
        'password',
    ];

    protected $hidden = [
        'password'
    ];
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
