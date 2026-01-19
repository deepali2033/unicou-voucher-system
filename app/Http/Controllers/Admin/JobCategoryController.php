<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = JobCategory::query();

        if ($request->filled('search')) {
            $term = $request->get('search');
            $query->where(function ($q) use ($term) {
                $q->where('name', 'LIKE', '%'.$term.'%')
                    ->orWhere('slug', 'LIKE', '%'.$term.'%');
            });
        }

        $jobCategories = $query->orderBy('created_at', 'desc')->paginate(10);
        $jobCategories->appends($request->query());
       

        return view('admin.job-categories.index', compact('jobCategories'));
    }

    public function create()
    {
        return view('admin.job-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['slug'] = $this->makeUniqueSlug($data['name']);
        $data['status'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('job-categories', 'public');
        }

        JobCategory::create($data);

        return redirect()->route('admin.job-categories.index')->with('success', 'Job category created successfully.');
    }

    public function show(JobCategory $jobCategory)
    {
        return view('admin.job-categories.show', compact('jobCategory'));
    }

    public function edit(JobCategory $jobCategory)
    {
        return view('admin.job-categories.edit', compact('jobCategory'));
    }

    public function update(Request $request, JobCategory $jobCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name,'.$jobCategory->id,
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['status'] = $request->boolean('is_active', true);

        if ($jobCategory->name !== $data['name']) {
            $data['slug'] = $this->makeUniqueSlug($data['name'], $jobCategory->id);
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($jobCategory->image) {
                \Storage::disk('public')->delete($jobCategory->image);
            }
            $data['image'] = $request->file('image')->store('job-categories', 'public');
        }

        $jobCategory->update($data);

        return redirect()->route('admin.job-categories.index')->with('success', 'Job category updated successfully.');
    }

    public function destroy(JobCategory $jobCategory)
    {
        $jobCategory->delete();

        return redirect()->route('admin.job-categories.index')->with('success', 'Job category deleted successfully.');
    }

    protected function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);

        if (! $slug) {
            $slug = Str::random(8);
        }

        $originalSlug = $slug;
        $counter = 1;

        while (
            JobCategory::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug.'-'.$counter++;
        }

        return $slug;
    }
}
