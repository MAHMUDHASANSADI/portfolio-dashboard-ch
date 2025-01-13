<form action="{{ route('permissions.store') }}" method="POST" class="crud-form">
    @csrf
    <div class="form-group mb-3">
        <label for="module"><strong>Module :</strong></label>
            <select name="module" id="module" class="form-control select2bs4-tags">
            @if(isset($modules[0]))
                @foreach($modules as $key => $module)
                    <option>{{ $module }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Permission Name</label>
        <input type="text" name="name" class="form-control" id="url" value="{{ old('name') }}">
    </div>
    <button type="submit" class="btn btn-primary crud-button">Save</button>
</form>
<script type="text/javascript">
  $(".select2bs4-tags").each(function() {
    $(this).select2({
      tags: true,
      theme: "bootstrap-5",
      dropdownParent: $('#modal').parent()
    });
  });
</script>
@include('crud-js')