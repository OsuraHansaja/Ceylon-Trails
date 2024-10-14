<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportIssue extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    protected $table = 'report_issues';

    // Define the fillable fields
    protected $fillable = [
        'issue',
        'email',
    ];
}
