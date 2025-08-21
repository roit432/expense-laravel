<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'user_id',
        'category_name',
        'date',
        
    ];// Define the table name if it differs from the pluralized model name

    public function user()
    {
        return $this->belongsTo(User::class);
    }// Define any additional relationships or methods as needed
}
