@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto space-y-8">
    {{-- Top Navigation --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('studies.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
            <span class="p-2 bg-slate-800 rounded-lg group-hover:bg-slate-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </span>
            Back to Dashboard
        </a>
        <div class="flex items-center gap-3">
            <a href="{{ route('studies.edit', $study->id) }}" class="inline-flex items-center px-4 py-2 bg-amber-500/10 text-amber-500 hover:bg-amber-500/20 font-semibold rounded-xl border border-amber-500/20 transition-all">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Task
            </a>
            <form action="{{ route('studies.destroy', $study->id) }}" method="POST" class="inline">
                @csrf 
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this task?')" class="inline-flex items-center px-4 py-2 bg-rose-500/10 text-rose-500 hover:bg-rose-500/20 font-semibold rounded-xl border border-rose-500/20 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Image and Status --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-slate-900/40 rounded-3xl border border-slate-800 p-4 shadow-xl">
                @if($study->image)
                    <img src="{{ asset('storage/'.$study->image) }}" class="w-full h-64 object-cover rounded-2xl ring-4 ring-slate-800 shadow-2xl mb-4">
                @else
                    <div class="w-full h-64 bg-slate-800 flex flex-col items-center justify-center rounded-2xl text-slate-600 mb-4">
                        <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-sm">No image available</p>
                    </div>
                @endif

                <div class="space-y-4 px-2">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 text-sm font-medium">Status</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $study->status == 'Completed' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20' }}">
                            {{ $study->status }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 text-sm font-medium">Priority</span>
                        @php
                            $priorityColors = [
                                'High' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                                'Medium' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                'Low' => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                            ];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $priorityColors[$study->priority] ?? $priorityColors['Low'] }}">
                            {{ $study->priority }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Details and Notes --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-slate-900/40 rounded-3xl border border-slate-800 p-8 shadow-xl space-y-8">
                {{-- Task Title --}}
                <div>
                    <span class="text-indigo-400 text-sm font-bold uppercase tracking-widest">{{ $study->subject }}</span>
                    <h1 class="text-4xl font-extrabold text-white mt-1">{{ $study->title }}</h1>
                    <div class="flex items-center gap-2 text-slate-400 mt-4 bg-slate-800/50 w-fit px-4 py-2 rounded-xl border border-slate-700">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="font-medium">Deadline:</span>
                        <span class="text-white">{{ \Carbon\Carbon::parse($study->deadline)->format('F d, Y') }}</span>
                    </div>
                </div>

                {{-- Notes Section --}}
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Additional Notes
                    </h3>
                    <div class="bg-slate-950/50 rounded-2xl p-6 border border-slate-800 text-slate-300 leading-relaxed whitespace-pre-wrap min-h-[150px]">
                        {{ $study->notes ?? 'No additional notes provided for this task.' }}
                    </div>
                </div>

                {{-- Task Summary Grid --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-800/30 p-4 rounded-2xl border border-slate-800/50">
                        <span class="text-slate-500 text-xs font-bold uppercase tracking-wider block mb-1">Created</span>
                        <span class="text-slate-200 text-sm font-medium">{{ $study->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="bg-slate-800/30 p-4 rounded-2xl border border-slate-800/50">
                        <span class="text-slate-500 text-xs font-bold uppercase tracking-wider block mb-1">Last Updated</span>
                        <span class="text-slate-200 text-sm font-medium">{{ $study->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection