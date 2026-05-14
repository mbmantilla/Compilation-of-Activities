<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Illuminate\Http\Request;
use App\Http\Requests\StudyRequest;

class StudyController extends Controller
{
    // 🔍 INDEX WITH SEARCH + FILTER + PAGINATION
    public function index(Request $request)
    {
        $query = Study::query();

        // 🔍 SEARCH (title + subject)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        // 🎯 FILTER (priority)
        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        $studies = $query->latest()->paginate(5)->withQueryString();

        return view('studies.index', compact('studies'));
    }

    // ➕ CREATE FORM
    public function create()
    {
        return view('studies.create');
    }

    // 💾 STORE (WITH VALIDATION + IMAGE UPLOAD)
    public function store(StudyRequest $request)
    {
        $data = $request->validated();

        // 📷 HANDLE IMAGE UPLOAD
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('studies', 'public');
        }

        // 🔒 DEFAULT STATUS
        $data['status'] = $data['status'] ?? 'Pending';

        Study::create($data);

        return redirect()->route('studies.index')->with('success', 'Task Added!');
    }

    // 🔍 SHOW SINGLE RECORD
    public function show(Study $study)
    {
        return view('studies.show', compact('study'));
    }

    // ✏️ EDIT FORM
    public function edit(Study $study)
    {
        return view('studies.edit', compact('study'));
    }

    // 🔄 UPDATE (WITH VALIDATION + IMAGE UPDATE)
    public function update(StudyRequest $request, Study $study)
    {
        $data = $request->validated();

        // 📷 UPDATE IMAGE (if new uploaded)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('studies', 'public');
        }

        $study->update($data);

        return redirect()->route('studies.index')->with('success', 'Task Updated!');
    }

    // ❌ DELETE
    public function destroy(Study $study)
    {
        $study->delete();

        return redirect()->route('studies.index')->with('success', 'Task Deleted!');
    }
}