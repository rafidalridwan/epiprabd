<div class="admin-btn-group">
    @if(!empty($viewUrl))
    <a href="{{ $viewUrl }}" class="admin-btn admin-btn-sm admin-btn-icon admin-btn-secondary" title="{{ $viewTitle ?? 'View on site' }}" @if(!empty($viewTarget)) target="{{ $viewTarget }}" @endif>
        <i class="fa fa-eye"></i>
    </a>
    @endif

    @if(!empty($editUrl))
    <a href="{{ $editUrl }}" class="admin-btn admin-btn-sm admin-btn-icon admin-btn-primary" title="{{ $editTitle ?? 'Edit' }}">
        <i class="fa fa-pencil"></i>
    </a>
    @endif

    @if(!empty($deleteUrl))
    <form method="POST" action="{{ $deleteUrl }}" onsubmit="return confirm('{{ $deleteConfirm ?? 'Delete this item?' }}')">
        @csrf
        @method('DELETE')
        <button type="submit" class="admin-btn admin-btn-sm admin-btn-icon admin-btn-danger" title="{{ $deleteTitle ?? 'Delete' }}">
            <i class="fa fa-trash"></i>
        </button>
    </form>
    @endif
</div>
