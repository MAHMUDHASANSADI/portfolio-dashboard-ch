<form action="{{ route('award_category.store') }}" method="POST" class="crud-form">
    @csrf
    
    <div class="mb-3">
        <label for="category_name" class="form-label">Category Name</label>
        <input type="text" name="category_name" class="form-control" id="category_name" value="{{ old('category_name') }}" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('award_category.index') }}" class="btn btn-secondary crud-button">Back to List</a>
</form>
@include('crud-js')
