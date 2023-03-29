<div class="btn-group" role="group">
    <a href="{{ route('users.show', $row->id) }}" class="btn btn-primary">
        <i class="fa fa-eye"></i>
        View
    </a>
    <a href="{{ route('users.edit', $row->id) }}" class="btn btn-warning">
        <i class="fa fa-pencil"></i>
        Edit
    </a>
    <button type="button" class="btn btn-danger"
            onclick="confirm('Are you sure you want to delete this user?') && $('#delete-form-{{ $row->id }}').submit()">
        <i class="fa fa-trash"></i>
        Delete
    </button>
    <form id="delete-form-{{ $row->id }}" action="{{ route('users.destroy', $row->id) }}"
          method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
