<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ReviewCriteria;
use App\Models\ReviewSection;
use Illuminate\Support\Facades\DB;

class ReviewCriteriaForm extends Component
{
    public $sections = [];
    public $removedSections = [];
    public $status = 'draft';

    public function mount()
    {
        $criteria = ReviewCriteria::firstOrCreate([]);
        $this->sections = $criteria->sections->map(function ($section) {
            return [
                'id' => $section->id,
                'title' => $section->title,
                'max_grade' => $section->max_grade,
                'explanation' => $section->explanation ?? '',
                'order' => $section->order,
            ];
        })->toArray();
        $this->status = $criteria->status;
    }

    public function addSection()
    {
        $this->sections[] = ['title' => '', 'max_grade' => '', 'explanation' => '', 'order' => count($this->sections) + 1];
    }

    public function removeSection($index)
    {
        if (isset($this->sections[$index]['id'])) {
            $this->removedSections[] = $this->sections[$index]['id'];
        }
        unset($this->sections[$index]);
        $this->sections = array_values($this->sections);
    }

    public function save()
    {
        $validatedData = $this->validate([
            'sections.*.title' => 'required|string|max:255',
            'sections.*.max_grade' => 'required|integer|min:1',
            'sections.*.explanation' => 'nullable|string',
            'sections.*.order' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $criteria = ReviewCriteria::firstOrCreate([], ['status' => $this->status]);

            $existingSectionIds = $criteria->sections->pluck('id')->toArray();

            foreach ($this->sections as $section) {
                $sectionData = array_merge($section, ['review_criteria_id' => $criteria->id]);
                $model = ReviewSection::updateOrCreate(
                    ['id' => $section['id'] ?? null],
                    $sectionData
                );
                if (($key = array_search($model->id, $existingSectionIds)) !== false) {
                    unset($existingSectionIds[$key]);
                }
            }

            if (!empty($existingSectionIds)) {
                ReviewSection::whereIn('id', $existingSectionIds)->delete();
            }

            DB::commit();
            session()->flash('flash.banner', 'Review Criteria saved successfully.');
            session()->flash('flash.bannerStyle', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            logger('Error saving data: ' . $e->getMessage());
            session()->flash('flash.banner', 'Failed to save data.');
            session()->flash('flash.bannerStyle', 'danger');
        }

        $this->reset(['removedSections']);
        
        return redirect()->route('chair.reviewCriteria');
    }

    public function render()
    {
        return view('livewire.review-criteria-form');
    }
}