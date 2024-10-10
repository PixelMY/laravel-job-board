<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function create(JobListing $jobListing)
    {
        return view('job_application.create', ['jobListing' => $jobListing]);
    }

    public function store(JobListing $jobListing, Request $request)
    {
        $jobListing->jobApplications()->create([
            'user_id' => $request->user()->id,
            ...$request->validate([
                'expected_salary' => 'required|min:1|max:1000000',
            ]),
        ]);

        return redirect()->route('job-listing.show', $jobListing)
            ->with('success', 'Job application submitted.');
    }

    public function destroy(string $id)
    {
        //
    }
}
