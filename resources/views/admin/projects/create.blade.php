@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        <h2>Create new Project</h2>

        @include('partials.alert-error-form')

        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="titleHelper" placeholder="Project name #1" value="{{ old('title') }}" />
                <small id="titleHelper" class="form-text text-muted">Type a title for the project</small>
                @error('title')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" aria-describedby="imageHelper" placeholder="https://" value="{{ old('image') }}" />
                <small id="imageHelper" class="form-text text-muted">Type an image URL</small>
                @error('image')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select" name="type_id" id="type_id">
                    <option selected disabled>Select a Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="technologies" class="form-label">Technologies</label>
                <select multiple class="form-select form-select" name="technologies[]" id="technologies">
                    <option selected disabled>Select a technology</option>
                    @foreach ($technologies as $technology)
                        <option value="{{ $technology->id }}">
                            {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}{{ $technology->name }}
                        </option>
                    @endforeach

                </select>
                @error('technologies')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="url_repo" class="form-label">Repository URL</label>
                <input type="text" class="form-control @error('url_repo') is-invalid @enderror" name="url_repo"
                    id="url_repo" aria-describedby="url_repoHelper" placeholder="https://"
                    value="{{ old('url_repo') }}" />
                <small id="url_repoHelper" class="form-text text-muted">Type the repository URL</small>
                @error('url_repo')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    cols="30" rows="10" aria-describedby="descriptionHelper" placeholder="Project description...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">
                Add new Project
            </button>
        </form>
    </div>
@endsection
