<?php

namespace App\Http\Controllers;

use App\Models\UploadAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\AbstractEmail;

class AuthorController extends Controller
{
    public function upload(Request $request)
    {
        try {

            $request->validate([
                'document' => 'required|mimes:pdf|max:2048',
            ]);
    
            $user = Auth::user();

            $document = $request->file('document');
            $uniqueFileName = uniqid() . '_' . $document->getClientOriginalName();
            $path = $document->storeAs('public/abstracts', $uniqueFileName);
            
            $linkPath = str_replace('public/', 'storage/', $path);

            $uploadAbstract = $user->uploadAbstracts()->create([
                'file_path' => $linkPath,
                'original_name' => $document->getClientOriginalName(),
            ]);

            Mail::to($user->email)->send(new AbstractEmail(
                "Abstract Upload Confirmation",
                "Your abstract \"{$document->getClientOriginalName()}\" has been successfully uploaded.",
                $uploadAbstract->id,
            ));

            return redirect()->route('author.index')->banner('Abstract Uploaded Successfully');
        } catch (\Exception $e) {
            return redirect()->route('author.index')->dangerBanner('Error Uploading Abstract');
        }
    }

    public function index()
    {
        $user = Auth::user();
        $papers = $user->uploadAbstracts;

        return view('author.index', ['papers' => $papers]);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $abstract = $user->uploadAbstracts()->findOrFail($id);
        $abstractName = $abstract->original_name;

        Storage::delete('public/abstracts/' . basename($abstract->file_path));

        $abstract->delete();

        Mail::to($user->email)->send(new AbstractEmail(
            "Abstract Deletion Confirmation",
            "Your abstract \"{$abstractName}\" has been successfully deleted.",
        ));

        return redirect()->route('author.index')->banner('Abstract Deleted Successfully');
    }

    public function reupload(Request $request, $id)
    {
        $request->validate([
            'document' => 'required|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();
        $abstract = $user->uploadAbstracts()->findOrFail($id);

        Storage::delete('public/abstracts/' . basename($abstract->file_path));

        $document = $request->file('document');
        $path = $document->storeAs('public/abstracts', uniqid() . '_' . $document->getClientOriginalName());
        $linkPath = str_replace('public/', 'storage/', $path);

        $abstract->update([
            'file_path' => $linkPath,
            'original_name' => $document->getClientOriginalName(),
        ]);

        Mail::to($user->email)->send(new AbstractEmail(
            "Abstract Reupload Confirmation",
            "Your abstract \"{$document->getClientOriginalName()}\" has been successfully reuploaded.",
            $abstract->id,
        ));

        return redirect()->route('author.index')->banner('Abstract Reuploaded Successfully');
    }
}
