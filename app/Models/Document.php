<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'doc_title_id',
        'comment',       
        'exp_date',        
        'modified_by',            
        'modified_on',            
        'attachment',        
        'no',      
        'work_auth_id',    
        'start_date',           
        'expire_date',  
        'i94_type',         
        'other_type',    
        'employee_id',           
        'status'       
    ];
}
