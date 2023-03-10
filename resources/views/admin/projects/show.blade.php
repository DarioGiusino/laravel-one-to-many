@extends('layouts.app')

@section('content')
  <section id="project-detail" class="container">
    {{-- project title --}}
    <header>
      <h2 class="text-center my-4">{{ $project->title }}</h2>
    </header>
    {{-- content row --}}
    <div class="row row-cols-2">
      <div class="col d-flex justify-content-center align-items-center">
        <img class="img-fluid"
          src="{{ $project->image ? asset("storage/$project->image") : 'https://marcolanci.it/utils/placeholder.jpg' }}"
          alt="{{ $project->title }}">
      </div>
      <div class="col p-3">{{ $project->description }}</div>
    </div>
    <hr>
    <div class="d-flex align-items-center justify-content-between mb-5">
      <form class="d-inline delete-form" action="{{ route('admin.projects.destroy', $project->id) }}" method="post"
        data-form="{{ $project->title }}">
        @csrf @method('delete')
        <button class="btn btn-sm btn-danger">Delete</button>
      </form>
      {{-- status --}}
      <div>
        <strong>Status: </strong><span
          class="text-{{ $project->is_published ? 'success' : 'danger' }}">{{ $project->is_published ? 'Online' : 'Draft' }}</span>
      </div>
      <div>
        <a class="btn btn-sm btn-warning" href="{{ route('admin.projects.edit', $project->id) }}">Edit</a>
        <a class="btn btn-sm btn-secondary" href="{{ route('admin.projects.index') }}">Go back</a>
      </div>
    </div>
  </section>
@endsection
