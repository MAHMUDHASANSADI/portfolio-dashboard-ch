

    <form action="{{ route('hero.store') }}"  method="POST" class="crud-form" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" ></textarea>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" >
        </div>
        <button type="submit" class="btn btn-success crud-button">Create Hero</button>
    </form>
 @include('crud-js')
