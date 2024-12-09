<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'age','gen','city', 'pin',

        'university', 'college', 'dept', 'batch', 'role', 'start', 'end', 'subject', 'file', // File path or name

        'fname', 'mname', 'updateKey', 
    ];
}
