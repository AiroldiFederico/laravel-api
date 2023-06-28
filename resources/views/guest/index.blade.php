
@extends('layouts.app')
@section('content')


<div class="content">

    <div class="container mt-5">
        <div class="row">
            @forelse ($projects as $project)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" alt="{{ $project->title }}">
                    <div class="card-body">

                        <h2 class="card-title fw-bold">{{ $project->title }}</h2>

                        {{-- <p class="card-text">{{ $project->languages }}</p> --}}

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

                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">View Details</a>

                    </div>
                </div>
            </div>
            @empty 
            <h1>Non ci sono ancora progetti :(</h1>
            @endforelse
        </div>
    </div>
    


</div>


@endsection