@if(session('success') || session('error') || session('warning') || session('info') || ($errors ?? null)?->any())
<div class="admin-alerts">
    @if(session('success'))
    <div class="admin-alert admin-alert-success" data-auto-dismiss>
        <span class="admin-alert-icon"><i class="fa fa-check"></i></span>
        <div class="admin-alert-content">
            <div class="admin-alert-title">Success</div>
            <div class="admin-alert-message">{{ session('success') }}</div>
        </div>
        <button type="button" class="admin-alert-close" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif

    @if(session('error'))
    <div class="admin-alert admin-alert-error">
        <span class="admin-alert-icon"><i class="fa fa-times"></i></span>
        <div class="admin-alert-content">
            <div class="admin-alert-title">Error</div>
            <div class="admin-alert-message">{{ session('error') }}</div>
        </div>
        <button type="button" class="admin-alert-close" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif

    @if(session('warning'))
    <div class="admin-alert admin-alert-warning">
        <span class="admin-alert-icon"><i class="fa fa-exclamation"></i></span>
        <div class="admin-alert-content">
            <div class="admin-alert-title">Warning</div>
            <div class="admin-alert-message">{{ session('warning') }}</div>
        </div>
        <button type="button" class="admin-alert-close" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif

    @if(session('info'))
    <div class="admin-alert admin-alert-info">
        <span class="admin-alert-icon"><i class="fa fa-info"></i></span>
        <div class="admin-alert-content">
            <div class="admin-alert-title">Info</div>
            <div class="admin-alert-message">{{ session('info') }}</div>
        </div>
        <button type="button" class="admin-alert-close" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif

    @if(($errors ?? null)?->any())
    <div class="admin-alert admin-alert-error">
        <span class="admin-alert-icon"><i class="fa fa-exclamation-triangle"></i></span>
        <div class="admin-alert-content">
            <div class="admin-alert-title">Please fix the following errors</div>
            <div class="admin-alert-message">
                <ul style="margin:0.35rem 0 0 1rem;padding:0;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button type="button" class="admin-alert-close" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif
</div>
@endif
