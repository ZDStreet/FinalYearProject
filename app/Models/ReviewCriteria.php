<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewCriteria extends Model
{
    protected $table = 'review_criteria';
    protected $fillable = ['status'];

    public function sections()
    {
        return $this->hasMany(ReviewSection::class)->orderBy('order');
    }
}
