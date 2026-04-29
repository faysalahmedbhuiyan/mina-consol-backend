<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json(Course::latest()->get());
    }

    public function store(Request $request)
    {
        $mediaPaths = [];
        $pdfPath = null;

        // ✅ MEDIA (image/video)
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('courses', 'public');
                $mediaPaths[] = $path;
            }
        }

        // ✅ PDF
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('courses/pdf', 'public');
        }

        $course = Course::create([
            'course_name' => $request->course_name,
            'details' => $request->details,
            'instructor_name' => $request->instructor_name,
            'section' => $request->section,
            'media' => $mediaPaths,
            'pdf' => $pdfPath, // ✅ ADD
        ]);

        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $course->course_name = $request->course_name ?? $course->course_name;
        $course->details = $request->details ?? $course->details;
        $course->instructor_name = $request->instructor_name ?? $course->instructor_name;
        $course->section = $request->section ?? $course->section;

        // ✅ MEDIA UPDATE
        if ($request->hasFile('media')) {
            $files = [];
            foreach ($request->file('media') as $file) {
                $path = $file->store('courses', 'public');
                $files[] = $path;
            }
            $course->media = $files;
        }

        // ✅ PDF UPDATE
        if ($request->hasFile('pdf')) {
            $course->pdf = $request->file('pdf')->store('courses/pdf', 'public');
        }

        $course->save();

        return response()->json($course);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json(['message' => 'Course deleted']);
    }
}