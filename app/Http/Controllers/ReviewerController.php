<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\UploadAbstract;

class ReviewerController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Fetch all abstracts assigned to the user
        $assignedAbstracts = UploadAbstract::where('reviewer_id', $userId)->get();

        $abstractsStatus = [];

        foreach ($assignedAbstracts as $abstract) {
            // Initialize default status
            $status = 'todo'; 

            // Fetch reviews for the current abstract
            $reviews = Review::where('upload_abstract_id', $abstract->id)->get();

            if (!$reviews->isEmpty()) {
                if ($reviews->contains('status', 'draft')) {
                    $status = 'draft';
                } elseif ($reviews->every('status', 'published')) {
                    $status = 'published';
                }
            }

            $abstractsStatus[] = [
                'abstract' => $abstract,
                'status' => $status,
            ];
        }

        $todoReviews = collect($abstractsStatus)->where('status', 'todo');
        $inProgressReviews = collect($abstractsStatus)->where('status', 'draft');
        $publishedReviews = collect($abstractsStatus)->where('status', 'published');

        return view('reviewer.index', compact('todoReviews', 'inProgressReviews', 'publishedReviews'));
    }

}
