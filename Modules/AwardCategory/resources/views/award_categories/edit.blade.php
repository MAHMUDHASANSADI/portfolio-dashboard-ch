

    <form action="{{ route('award_category.update', $award_categories->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="category_name" class="form-label">Name</label>
            <input type="text" name="category_name" class="form-control" id="category_name" value="{{ $award_categories->category_name }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('award_category.index') }}" class="btn btn-secondary crud-button">Back to List</a>
    </form>
@include('crud-js')
