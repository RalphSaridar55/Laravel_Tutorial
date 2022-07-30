<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
// use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;
    public $table = 'employee';

    protected $fillable = [
        'email',
        'password',
        'employee_type_id',
        'warehouse_id',
    ];

    // protected $hidden = [
    //     'password'
    // ];

    public function employeeType()
    {
        return $this->belongsTo('App\Models\EmployeeType');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }    
}
