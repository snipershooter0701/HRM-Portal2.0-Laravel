<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'middle_name',       
        'last_name',        
        'title',            
        'email',            
        'phone_num',        
        'dateofbirth',      
        'dateofjoining',    
        'gender',           
        'employment_type',  
        'category',         
        'employee_type',    
        'status',           
        'role_id',          
        'poc_id',           
        'classification',   
        'pay_percent_value',
        'pay_percent_hrs',  
        'pay_percent_to',   
        'pay_rate_value',   
        'pay_rate_hrs',     
        'pay_rate_to',      
        'street',           
        'suite_aptno',      
        'city_town',        
        'state_id',         
        'country_id',
        'zipcode',
        'pay_scale',
        'pay_standard_time',
        'pay_over_time',
        'pay_double_time',
        'status_end_date',
        'department_id'       
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }   
}