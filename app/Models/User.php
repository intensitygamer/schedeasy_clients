<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\UserDetails;
use Illuminate\Database\Eloquent\Model;


use App\Models\Client;
use App\Models\Staff;
use App\Models\Admin;



use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, LogsActivity;
    
    protected static $logName = 'users';

    protected static $logAttributes = [
        'email',
        'password',
        'first_name',
        'last_name',
        'user_type_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'user_type_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_details(){

            return $this->hasOne(UserDetails::class, 'user_id');
            //return $this->belongsTo(UserDetails::class, 'user_id');\

    }
  
    public function get_client_details($user_id){
 
        return Client::where('user_id', $user_id)->first();

    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");

        // Chain fluent methods for configuration options
    }

}
