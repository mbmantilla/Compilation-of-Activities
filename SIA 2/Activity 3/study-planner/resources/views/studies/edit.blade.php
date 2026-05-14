@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-slate-900/40 rounded-3xl border border-slate-800 shadow-2xl overflow-hidden">
        {{-- Header --}}
        <div class="px-8 py-6 bg-slate-800/50 border-b border-slate-800">
            <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                <span class="p-2 bg-amber-500/10 text-amber-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </span>
                Edit Study Task
            </h1>
            <p class="text-slate-400 mt-1 ml-11">Update your task and keep your study plan on track!</p>
        </div>

        <div class="p-8">
            {{-- Error Display --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 rounded-2xl">
                    <div class="flex items-center gap-2 text-rose-500 font-bold mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Please fix the following:
                    </div>
                    <ul class="list-disc list-inside text-rose-400 text-sm space-y-1 ml-7">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('studies.update', $study->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Title --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-300 ml-1">Title <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $study->title) }}"
                            class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-slate-200 placeholder-slate-600">
                    </div>

                    {{-- Subject --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-300 ml-1">Subject <span class="text-rose-500">*</span></label>
                        <input type="text" name="subject" value="{{ old('subject', $study->subject) }}"
                            class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-slate-200 placeholder-slate-600">
                    </div>

                    {{-- Priority --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-300 ml-1">Priority <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <select name="priority" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-slate-200 appearance-none">
                                <option value="">-- Select Priority --</option>
                                <option value="Low" {{ old('priority', $study->priority) == 'Low' ? 'selected' : '' }}>Low Priority</option>
                                <option value="Medium" {{ old('priority', $study->priority) == 'Medium' ? 'selected' : '' }}>Medium Priority</option>
                                <option value="High" {{ old('priority', $study->priority) == 'High' ? 'selected' : '' }}>High Priority</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Deadline --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-300 ml-1">Deadline <span class="text-rose-500">*</span></label>
                        <input type="date" name="deadline" value="{{ old('deadline', $study->deadline) }}"
                            class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-slate-200 [color-scheme:dark]">
                    </div>
                </div>

                {{-- Image Upload --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-300 ml-1">Cover Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-800 border-dashed rounded-2xl cursor-pointer bg-slate-950/50 hover:bg-slate-900 transition-all hover:border-indigo-500/50 group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-slate-500 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                <p class="mb-2 text-sm text-slate-500"><span class="font-semibold">Click to update image</span> or drag and drop</p>
                                <p class="text-xs text-slate-600">PNG, JPG or WEBP (MAX. 2MB)</p>
                            </div>
                            <input type="file" name="image" class="hidden" onchange="previewImage(event)" />
                        </label>
                    </div>
                </div>

                {{-- Preview Area --}}
                <div id="preview-container" class="{{ $study->image ? '' : 'hidden' }} animate-in zoom-in-95 duration-300">
                    <label class="block text-sm font-semibold text-slate-300 mb-2 ml-1">Image Preview</label>
                    <div class="relative inline-block">
                        <img id="preview" src="{{ $study->image ? asset('storage/'.$study->image) : '#' }}" class="max-w-[200px] rounded-xl ring-4 ring-slate-800 shadow-2xl">
                        <button type="button" onclick="removeImage()" class="absolute -top-2 -right-2 p-1 bg-rose-500 text-white rounded-full shadow-lg hover:bg-rose-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-300 ml-1">Notes</label>
                    <textarea name="notes" rows="4"
                        class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-slate-200 placeholder-slate-600"
                        placeholder="Any additional details or links...">{{ old('notes', $study->notes) }}</textarea>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-4 pt-4 border-t border-slate-800">
                    <button type="submit" class="flex-1 px-8 py-4 bg-amber-600 hover:bg-amber-500 text-white font-bold rounded-2xl shadow-xl shadow-amber-500/20 transition-all hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Update Task
                    </button>
                    <a href="{{ route('studies.index') }}" class="px-8 py-4 bg-slate-800 hover:bg-slate-700 text-white font-bold rounded-2xl transition-all flex items-center justify-center gap-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    const container = document.getElementById('preview-container');
    const output = document.getElementById('preview');
    
    reader.onload = function() {
        output.src = reader.result;
        container.classList.remove('hidden');
    };
    
    if(event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}

function removeImage() {
    const input = document.querySelector('input[type="file"]');
    const container = document.getElementById('preview-container');
    const output = document.getElementById('preview');
    
    input.value = '';
    output.src = '#';
    container.classList.add('hidden');
}
</script>

@endsection