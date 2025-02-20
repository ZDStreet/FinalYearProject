<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UploadAbstract;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AssignEmail;

class AssignAbstract extends Component
{
    public function loadAbstractsAndReviewers()
    {
        $reviewerRole = Role::where('name', 'reviewer')->first();
        $reviewers = User::role('reviewer')->with('assignedAbstracts')->get(); 
        $unassignedAbstracts = UploadAbstract::whereNull('reviewer_id')->get();

        return compact('reviewers', 'unassignedAbstracts');
    }

    public function assignAbstractToReviewer($abstractId, $reviewerId = null)
    {
        $abstract = UploadAbstract::find($abstractId);

        if ($reviewerId === null) {
            $abstract->status = 'pending';
        } else {
            $abstract->status = 'assigned'; 
            $reviewer = User::find($reviewerId);

            Mail::to($reviewer->email)->send(new AssignEmail(
                "you have been assigned to review  \"{$abstract->original_name}\"",
                $abstractId,
            ));
        }

        $abstract->reviewer_id = $reviewerId;
        $abstract->save();

    }

    public function render()
    {
        $data = $this->loadAbstractsAndReviewers();
        return view('livewire.assign-abstract', $data);
    }
}