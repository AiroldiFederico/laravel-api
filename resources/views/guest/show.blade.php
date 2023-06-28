

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-5 col-5 m-auto">
        <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" alt="Project Image">
        <div class="card-body">

            <h2 class="card-title fw-bold">{{ $project->title }}</h2>

            <p class="card-text">GitHub: <a href="{{ $project->github }}">{{ $project->github }}</a></p>

            @if($project->link)
                <p class="card-text">Link: <a href="{{ $project->link }}">{{ $project->link }}</a></p>
            @endif

            {{-- <p class="card-text">Languages: {{ $project->languages }}</p> --}}
            {{-- Mostra i linguaggi selezionati --}}
            <div class="">
                <p>Programming languages:</p>
                <div class="card-text d-flex gap-2 fw-normal">
                    @foreach ($project->technologies as $technology)
                        <p>{{ $technology->name }}</p>
                    @endforeach
                </div>
            </div>

            <div class="d-flex gap-3">
                <p class="">Project type:</p>

                @isset($project->type)
                <p class="fw-normal">{{ $project->type->name }}</p>
                @endisset
            </div>

            <div class="mt-2 d-flex justify-content-start gap-2">
                {{-- Edit button --}}
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning col-3">Modifica</a>
                {{-- Delete button --}}
                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="col-3">
                    @csrf
                    @method('DELETE')
                    
                    <button class="btn btn-danger col-12" role="button" onclick="return deleteConfirm()">Delete</button>
                </form>
            </div>
            
            
            
            
        </div>
    </div>
</div>
@endsection
