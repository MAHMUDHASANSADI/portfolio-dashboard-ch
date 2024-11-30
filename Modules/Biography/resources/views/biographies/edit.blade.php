

    <form action="{{ route('biography.update', $biography->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')
       
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ $biography->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('biography.index') }}" class="btn btn-secondary crud-button">Back to List</a>
    </form>
@include('crud-js')
