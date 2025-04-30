<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Job;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveJobRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class JobController extends Controller
{

    use AuthorizesRequests;

    public function index(): View 
    {
        $jobs = Job::paginate(9);
        return view('jobs.index')->with('jobs', $jobs);
    }

    public function create(): View
    {
        return view('jobs.create');
    }

    public function store(SaveJobRequest $request): RedirectResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validated();

        // Add the user ID of the current user
        $validatedData['user_id'] = auth()->user()->id;

        // Check for image
        if ($request->hasFile('company_logo')) {
            // Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add the path to the validated data
            $validatedData['company_logo'] = $path;
        }


        // Create a new job listing with the validated data
        Job::create($validatedData);

        return redirect()->route('jobs.index')
                            ->with('success', 'Job listing created successfully!');
    }

    //
    public function show(Job $job): View
    {
        return view('jobs.show', compact('job'));
    }

    // shows the form for editing specific job
    public function edit(Job $job): View
    {
        // Check if the user is authorized
        $this->authorize('update', $job);
        
        return view('jobs.edit')->with('job', $job);
    }

    // updates the specific job
    public function update(SaveJobRequest $request, Job $job): RedirectResponse
    {

        // Check if the user is authorized
        $this->authorize('update', $job);


        // Validate the incoming request data
        $validatedData = $request->validated();


        // Check if a file was uploaded
        if ($request->hasFile('company_logo')) {
            // Delete the old company logo from storage
            if ($job->company_logo) {
                Storage::delete('public/logos/' . basename($job->company_logo));
            }
            // Store the file and get the path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add the path to the validated data array
            $validatedData['company_logo'] = $path;
        }

        // Update with the validated data
        $job->update($validatedData);

        return redirect()->route('jobs.index')
                        ->with('success', 'Job listing updated successfully!');
    }

    // deletes the specific job
    public function destroy(Job $job): RedirectResponse
    {
        // Check if the user is authorized
        $this->authorize('delete', $job);

        // Delete the company logo from storage if it exists
        if ($job->company_logo) {
            Storage::delete('public/logos/' . $job->company_logo);
        }

        // Delete the job listing
        $job->delete();

        // Check if the request came from the dashboard page
        if (request()->query('from') === 'dashboard') {
            return redirect()->route('dashboard.index')->with('success', 'Job listing deleted successfully!');
        }

        return redirect()->route('jobs.index')
                        ->with('success', 'Job listing deleted successfully!');
    }

    // @desc   Search for jobs
    // @route  GET /jobs/search
    public function search(Request $request)
    {
        // setting the keywords and location input values to lowercase.
        $keywords = strtolower($request->input('keywords'));
        $location = strtolower($request->input('location'));

        $query = Job::query();

        
        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(title) like ?', ['%' . $keywords . '%'])
                    ->orWhereRaw('LOWER(description) like ?', ['%' . $keywords . '%']);
            });
        }

        if ($location) {
            $query->where(function ($q) use ($location) {
                $q->whereRaw('LOWER(address) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(city) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(state) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(zipcode) like ?', ['%' . $location . '%']);
            });
        }

        $jobs = $query->paginate(9);

        return view('jobs.index')->with('jobs', $jobs);
    }
}
