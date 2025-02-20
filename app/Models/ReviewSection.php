<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewSection extends Model
{
    protected $fillable = ['title', 'max_grade', 'explanation', 'order', 'review_criteria_id'];

    public function criteria()
    {
        return $this->belongsTo(ReviewCriteria::class);
    }
}