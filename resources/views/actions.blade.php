<div class="btn-group">
    <a href="{{ route($route.'.show', $object->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
<a href="{{ route($route.'.edit', $object->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
<form action="{{ route($route.'.destroy', $object->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this business?');"><i class="fas fa-trash"></i></button>
</form>
</div>