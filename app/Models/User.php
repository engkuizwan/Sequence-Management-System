<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
    protected $table = 'user';
    protected $primaryKey = 'userID';

    protected $fillable = [
        'name',
        'user_email',
        'user_password',
        'user_name',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }

    public function role()
    {
        return $this->hasOne('App\Models\role','role_id', 'role_id');
    }

    public function role1($userid)
    {
        $data = $this::where('userID',$userid)->leftJoin('role','user.role_id','=','role.role_id')->first();
        return $data->role;
    }

    public function list_navbar($userid)
    {
        $data = $this::where('userID',$userid)->leftJoin('role','user.role_id','=','role.role_id')->first();
        return json_decode($data->sidenavbar_id);
    }

    
    public function project($userid)
    {
        $data = $this::select('project.projectID','project.project_name','project.project_framework','project.project_description','project.status','project_user.created_at')->where('user.userID',$userid)->join('project_user','user.userID','=','project_user.userID')->join('project','project_user.projectID','=','project.projectID')->whereNull('project.deleted_at')->get();
        return $data;
    }

    public function user_role()
    {
        $data = $this::select('user.userID','user.name','user.user_name','user.created_at','role.role')->leftJoin('role','user.role_id','=','role.role_id')->get();
        return $data;
    }
    
}
