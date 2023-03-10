@extends('layouts.app')

@section('content')
  <section id="projects-list" class="container">
    {{-- page title --}}
    <header>
      <h3 class="text-center my-4">Projects List</h3>
    </header>

    {{-- filter --}}
    <form action="{{ route('admin.projects.index') }}" method="get">
      <div class="input-group mb-3">
        <select class="form-select" name="filter">
          <option value="" selected>All</option>
          <option @if ($filter === 'online') selected @endif value="online">Online</option>
          <option @if ($filter === 'draft') selected @endif value="draft">Draft</option>
        </select>
        <button class="btn btn-outline-secondary" type="submit">Filter</button>
      </div>
    </form>

    {{-- pagination --}}
    <div>{{ $projects->links() }}</div>


    {{-- projects table --}}
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Type</th>
          <th scope="col">Status</th>
          <th scope="col" class="text-end">Commands</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($projects as $project)
          <tr>
            {{-- project id --}}
            <th scope="row">{{ $project->id }}</th>

            {{-- project title --}}
            <td>{{ $project->title }}</td>

            {{-- project title --}}
            {{-- ? null safe operator <td>{{ $project->type?->label }}</td>  --}}
            <td>
              <span class="badge text-black" style="background-color:{{ $project->type?->color }}">
                @if ($project->type)
                  {{ $project->type->label }}
                @else
                  -
                @endif
              </span>
            </td>

            {{-- project status --}}
            <td><span
                class="text-{{ $project->is_published ? 'success' : 'danger' }}">{{ $project->is_published ? 'Online' : 'Draft' }}</span>
            </td>

            {{-- project buttons --}}
            <td class="text-end">
              <a class="btn btn-sm btn-primary" href="{{ route('admin.projects.show', $project->id) }}">Open</a>
              <a class="btn btn-sm btn-warning" href="{{ route('admin.projects.edit', $project->id) }}">Edit</a>
              <form class="d-inline delete-form" action="{{ route('admin.projects.destroy', $project->id) }}"
                method="post" data-form="{{ $project->title }}">
                @csrf @method('delete')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          {{-- if no projects --}}
          <h1 class="text-center">Projects list is empty</h1>
        @endforelse
      </tbody>
    </table>
    <hr>
    {{-- add new project button --}}
    <div class="text-end">
      <a class="btn btn-sm btn-success me-2" href="{{ route('admin.projects.create') }}">Add</a>
    </div>
  </section>
@endsection
