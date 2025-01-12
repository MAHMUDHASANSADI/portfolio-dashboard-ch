

    <form action="{{ route('biography.store') }}" method="POST" class="crud-form">
        @csrf
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('biography.index') }}" class="btn btn-secondary curd-button">Back to List</a>
    </form>
@include('crud-js')
