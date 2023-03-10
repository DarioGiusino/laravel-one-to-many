@if ($project->exists)
  <form class="mb-5" action="{{ route('admin.projects.update', $project->id) }}" method="post"
    enctype="multipart/form-data">
    {{-- * method helper --}}
    @method('PUT')
  @else
    <form class="mb-5" action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
@endif
{{-- ! cross-site request forgery --}}
@csrf

<div class="row">
  {{-- title --}}
  <div class="col-4">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
        value="{{ old('title', $project->title) }}" required maxlength="40">
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <div class="form-text">Add a project title</div>
      @enderror
    </div>
  </div>

  {{-- repo_link --}}
  <div class="col-4">
    <div class="mb-3">
      <label for="repo_link" class="form-label">Repository link</label>
      <input type="url" class="form-control @error('repo_link') is-invalid @enderror" id="repo_link"
        name="repo_link" value="{{ old('repo_link', $project->repo_link) }}">
      @error('repo_link')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <div class="form-text">Link to the project repository</div>
      @enderror
    </div>
  </div>

  {{-- image --}}
  <div class="col-3">
    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
      @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <div class="form-text">Upload a project image</div>
      @enderror
    </div>
  </div>

  {{-- image preview --}}
  <div class="col-1">
    <div class="mb-3">
      <label for="preview" class="form-label">Preview</label>
      <img id="preview" class="img-fluid"
        src="{{ $project->image ? asset("storage/$project->image") : 'https://marcolanci.it/utils/placeholder.jpg' }}"
        alt="{{ $project->title }}">
    </div>
  </div>

  {{-- description --}}
  <div class="col-12">
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
        rows="10" required>{{ old('description', $project->description) }}</textarea>
    </div>
  </div>
</div>

<hr>

{{-- form buttons --}}
<div class="d-flex justify-content-between align-items-center">
  {{-- publish toggle --}}
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
      @if (old('is_published', $project->is_published)) checked @endif>
    <label id="toggle-label" class="form-check-label">
      <span
        class="text-{{ $project->is_published ? 'success' : 'danger' }}">{{ $project->is_published ? 'Online' : 'Draft' }}</span>
    </label>
  </div>
  {{-- buttons --}}
  <div>
    <button class="btn btn-sm btn-success">Save</button>
    <a class="btn btn-sm btn-secondary" href="{{ route('admin.projects.index') }}">Go back</a>
  </div>
</div>
</form>

@section('scripts')
  {{-- # image preview --}}
  <script>
    // get elements from dom
    const imageInput = document.getElementById("image");
    const previewField = document.getElementById("preview");

    // fallback image
    const placeholder = "https://marcolanci.it/utils/placeholder.jpg";

    // on imageInput(value) change
    imageInput.addEventListener("change", () => {
      // if a file is given
      if (imageInput.files && imageInput.files[0]) {
        // define a new file reader
        const reader = new FileReader();

        // transform the file in a correct url
        reader.readAsDataURL(imageInput.files[0]);

        // when ready
        reader.onload = (e) => {
          previewField.src = e.target.result;
        };
      }
      // else return the fallback image
      else previewField.src = placeholder;
    });
  </script>
  {{-- #checkbox toggle --}}
  <script>
    //get elements from dom
    const checkbox = document.getElementById("is_published");
    const checkboxLabel = document.getElementById("toggle-label");

    // listen checkbox click
    checkbox.addEventListener("click", () => {
      if (checkbox.checked) {
        checkboxLabel.innerText = "Will be published";
        checkboxLabel.classList.remove("text-danger");
        checkboxLabel.classList.add("text-success");
      } else {
        checkboxLabel.innerText = "Will be drafted";
        checkboxLabel.classList.remove("text-success");
        checkboxLabel.classList.add("text-danger");
      }
    });
  </script>
@endsection
