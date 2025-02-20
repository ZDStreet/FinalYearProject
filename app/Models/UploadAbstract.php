<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadAbstract extends Model
{
    use HasFactory;

    protected $fillable = ['file_path', 'original_name', 'reviewer_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
