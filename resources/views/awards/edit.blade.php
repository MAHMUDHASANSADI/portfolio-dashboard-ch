

    <form action="{{ route('award.update', $award->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="award_category_id" class="form-label">Category</label>
            <select name="award_category_id" class="form-control" id="award_category_id" required>
                @if(isset($categories[0]))
                @foreach($categories as $key => $category)
                <option value="{{ $category->id }}" {{ $award->award_category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $award->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ $award->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('award.index') }}" class="btn btn-secondary crud-button">Back to List</a>
    </form>
@include('crud-js')
