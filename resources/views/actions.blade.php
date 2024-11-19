<div class="btn-group">
    <a style="cursor: pointer;" onclick="Show('View', '{{ route($route.'.show', $object->id) }}')" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
    <a style="cursor: pointer;" onclick="Show('Edit', '{{ route($route.'.edit', $object->id) }}')" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
    <a class="btn btn-sm btn-danger" id="crud-delete-button-{{ $object->id }}" style="cursor: pointer;" onclick="Delete('{{ route($route.'.destroy', $object->id) }}')"><i class="fa fa-trash text-white"></i></a>
</div>