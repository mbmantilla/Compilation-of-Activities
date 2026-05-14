<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'subject' => 'required|string|max:255',
            'priority' => 'required|in:Low,Medium,High',
            'deadline' => 'required|date',
            'status' => 'nullable|in:Pending,Completed',
            'notes' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    // 🔥 CUSTOM ERROR MESSAGES (PROFESSIONAL TOUCH)
    public function messages(): array
    {
        return [
            'title.required' => 'Task title is required.',
            'title.min' => 'Title must be at least 3 characters.',
            
            'subject.required' => 'Subject is required.',
            
            'priority.required' => 'Please select a priority level.',
            'priority.in' => 'Invalid priority selected.',
            
            'deadline.required' => 'Deadline is required.',
            'deadline.date' => 'Invalid date format.',
            
            'image.image' => 'File must be an image.',
            'image.mimes' => 'Image must be JPG, JPEG, or PNG.',
            'image.max' => 'Image size must not exceed 2MB.',
        ];
    }
}