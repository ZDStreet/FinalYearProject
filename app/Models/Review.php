<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'upload_abstract_id',
        'reviewer_id',
        'review_section_id',
        'text',
        'marks',
        'status',
    ];

    public function abstract()
    {
        return $this->belongsTo(UploadAbstract::class, 'upload_abstract_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function section()
    {
        return $this->belongsTo(ReviewSection::class, 'review_section_id');
    }
}
