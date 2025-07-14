<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\Society;
use App\Models\JobApplySociety;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JobVacancyController extends Controller
{
    public function index()
    {
        // Ambil society dari Auth atau Session
        $society = $this->getSociety();

        if (!$society) {
            return redirect()->route('login');
        }

        if (!$society->validation || $society->validation->status !== 'accepted') {
            return redirect()->route('validation.index')
                ->with('error', 'Your data validation must be accepted before applying for jobs');
        }

        $jobVacancies = JobVacancy::with(['jobCategory', 'availablePositions'])
            ->where('job_category_id', $society->validation->job_category_id)
            ->get();

        $appliedVacancies = JobApplySociety::where('society_id', $society->id)
            ->pluck('job_vacancy_id')
            ->toArray();

        return view('job-vacancies.index', compact('jobVacancies', 'appliedVacancies'));
    }

    public function show($id)
    {
        $society = $this->getSociety();

        if (!$society) {
            return redirect()->route('login');
        }

        $jobVacancy = JobVacancy::with(['jobCategory', 'availablePositions.jobApplyPositions'])
            ->findOrFail($id);

        $hasApplied = JobApplySociety::where('society_id', $society->id)
            ->where('job_vacancy_id', $id)
            ->exists();

        return view('job-vacancies.show', compact('jobVacancy', 'hasApplied'));
    }

    private function getSociety()
    {
        // Coba dari Laravel Auth dulu
        if (Auth::guard('society')->check()) {
            return Auth::guard('society')->user()->load('validation');
        }

        // Fallback ke session manual
        $societyId = Session::get('society_id');
        if ($societyId) {
            return Society::with('validation')->find($societyId);
        }

        return null;
    }
}
