<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ReviewCriteria;
use App\Models\ReviewSection;
use App\Models\UploadAbstract;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReviewEmail;

class ReviewAbstract extends Component
{
    public $abstractId;
    public $criteria;
    public $canReview = false;
    public $reviewTexts = [];
    public $marks = [];
    public $isPublished = false;

    public function mount($abstractId)
    {
        $this->abstractId = $abstractId;
        $this->criteria = ReviewCriteria::with('sections')->first();

        $abstract = UploadAbstract::findOrFail($this->abstractId);
    
        $this->canReview = Auth::check() && Auth::user()->hasRole('reviewer') && $abstract->reviewer_id === Auth::id();;

        $existingReviews = Review::where('upload_abstract_id', $this->abstractId)->get();

        foreach ($existingReviews as $review) {
            $this->reviewTexts[$review->review_section_id] = $review->text;
            $this->marks[$review->review_section_id] = $review->marks;

            if ($review->status === 'published') {
                $this->isPublished = true;
            }
        }
    }

    public function saveReviewAsDraft()
    {
        $this->saveReview('draft');
    }

    public function publishReview()
    {
        $this->saveReview('published');
    }

    public function saveReview($status)
    {
        if (!$this->canReview) {
            session()->flash('flash.banner', 'You are not authorized to submit a review for this abstract.');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->back();
        }

        $sections = $this->criteria->sections ?? [];
        $rules = [];

        foreach ($sections as $section) {
            $rules["reviewTexts.{$section->id}"] = 'required|string';
            $rules["marks.{$section->id}"] = ['required', 'numeric', 'min:0', function ($attribute, $value, $fail) use ($section) {
                if ($value > $section->max_grade) {
                    $fail("The marks for section {$section->title} cannot exceed {$section->max_grade}.");
                }
            }];
        }

        $this->validate($rules);

        foreach ($this->marks as $sectionId => $mark) {
            Review::updateOrCreate([
                'upload_abstract_id' => $this->abstractId,
                'review_section_id' => $sectionId,
                'reviewer_id' => auth()->id(),
            ], [
                'text' => $this->reviewTexts[$sectionId] ?? '',
                'marks' => $mark,
                'status' => $status,
            ]);
        }

        $message = $status === 'draft' ? 'Review saved as draft.' : 'Review published successfully.';
        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', 'success');

        $abstract = UploadAbstract::with('user')->findOrFail($this->abstractId);

        if ($status === 'published') {
            Mail::to($abstract->user->email)->send(new ReviewEmail(
                "Your abstract has been review and marked by " . Auth::user()->name,
                $this->abstractId
            ));
        }

        return redirect()->route('abstracts.show', $this->abstractId);
    }

    public function render()
    {
        return view('livewire.review-abstract');
    }
}

