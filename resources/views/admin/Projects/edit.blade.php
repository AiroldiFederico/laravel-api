@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" class="mt-5 d-flex flex-column justify-content-space-between gap-3 col-6 m-auto">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title" class="mb-1">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $project->title }}" required>
        </div>
        <div class="form-group">
            <label for="github" class="mb-1">GitHub</label>
            <input type="text" name="github" id="github" class="form-control" value="{{ $project->github }}" required>
        </div>
        <div class="form-group">
            <label for="link" class="mb-1">Link</label>
            <input type="text" name="link" id="link" class="form-control" value="{{ $project->link }}">
        </div>
        {{-- <div class="form-group">
            <label for="languages" class="mb-1">Linguaggi</label>
            <input type="text" name="languages" id="languages" class="form-control" value="{{ $project->languages }}" required>
        </div> --}}

        <div class="d-flex gap-3">

            {{-- Ciclo type --}}
            <div class="col-6 w-25">
                <label for="project-types" class="form-label">Type</label>
                <div class="input-group mb-3 w-100">
                    {{-- <label class="input-group-text" for="project-types">Types</label> --}}
                    <select class="form-select @error('type_id') is-invalid @enderror"" id="project-types" name="type_id">
    
                        <option value="" selected> Scegli un tipo</option>
    
                        @foreach ($types as $elem)    
                            <option value="{{ $elem->id }}" {{ old( 'type_id', $project->type_id ) == $elem->id ? 'selected' : '' }}> {{ $elem->name }} </option>
                        @endforeach
    
                    </select>
                </div>
                {{-- @error('type_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}
            </div>

            <div class="col-6">
                {{-- Ciclo technology --}}
                <label for="technologies" class="mb-1">Programming languages</label>
                <div class="form-group mt-1">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        @foreach ($technologies as $technology)
                            <input type="checkbox" class="btn-check" id="technology-{{ $technology->id }}" name="technologies[]" value="{{ $technology->id }}" autocomplete="off"
                                {{ in_array($technology->id, $project->technologies->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <button type="submit" class="btn btn-primary col-2">Aggiorna</button>
    </form>
</div>
@endsection
