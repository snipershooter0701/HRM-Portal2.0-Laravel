<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'ssn',       
        'work_auth',        
        'state',            
        'passport',            
        'i94',        
        'visa',  
        'other_document',    
        'requested_on',           
        'requested_by_id',  
        'responded_on',         
        'approver_id',    
        'approved_on',           
        'status', 
        'comment'         
    ];

    /**
     * Get employee info with employee_id
     */
    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function requested_by() {
        return $this->belongsTo(Employee::class, 'requested_by_id');
    }
}
