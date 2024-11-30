

    <form action="{{ route('business.store') }}" method="POST" class="crud-form">
        @csrf
        <div class="mb-3">
            <label for="business_category_id" class="form-label">Category</label>
            <select name="business_category_id" class="form-control select2" id="business_category_id" required>
                @if(isset($categories[0]))
                @foreach($categories as $key => $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
                @endif
            </select>
        </div>


        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('business.index') }}" class="btn btn-secondary crud-button">Back to List</a>
    </form>
@include('crud-js')

