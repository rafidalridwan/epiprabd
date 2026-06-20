@php
    $inputName = $name ?? 'image';
    $inputLabel = $label ?? 'Image';
    $inputId = $id ?? ('image-upload-' . $inputName . '-' . uniqid());
    $currentPath = $current ?? null;
    $sizeTip = $sizeTip ?? 'Recommended: JPG or PNG, max 2MB.';
    $required = $required ?? false;
    $optionalHint = $optionalHint ?? null;
    $fallback = $fallback ?? 'images/logo-dark.png';
    $previewUrl = $currentPath ? media_url($currentPath, $fallback) : null;
@endphp

<div class="admin-form-group admin-image-upload" data-image-upload>
    <div class="admin-image-upload-label">
        {{ $inputLabel }}
        @if($optionalHint)
        <span class="admin-form-hint admin-form-hint--inline">{{ $optionalHint }}</span>
        @endif
    </div>

    <div class="admin-image-preview-grid">
        @if($previewUrl)
        <div class="admin-image-preview-box" data-image-preview-current>
            <span class="admin-image-preview-label">Current</span>
            <div class="admin-image-preview-frame">
                <img src="{{ $previewUrl }}" alt="Current {{ $inputLabel }}">
            </div>
        </div>
        @endif

        <div class="admin-image-preview-box admin-image-preview-box--new" data-image-preview-new hidden>
            <span class="admin-image-preview-label">New preview</span>
            <div class="admin-image-preview-frame">
                <img src="" alt="New {{ $inputLabel }} preview">
            </div>
            <button type="button" class="admin-image-clear" data-image-clear title="Remove selected file">
                <i class="fa fa-times"></i> Remove
            </button>
        </div>
    </div>

    <div class="admin-file-input">
        <input
            type="file"
            id="{{ $inputId }}"
            class="admin-file-input-native"
            name="{{ $inputName }}"
            accept="image/*"
            data-image-input
            {{ $required ? 'required' : '' }}
        >
        <label for="{{ $inputId }}" class="admin-file-input-trigger">
            <i class="fa fa-cloud-upload"></i>
            <span>Choose image</span>
        </label>
        <span class="admin-file-input-name" data-image-filename>No file chosen</span>
    </div>

    <p class="admin-form-hint"><i class="fa fa-info-circle"></i> {{ $sizeTip }}</p>
    @if($currentPath)
    <p class="admin-form-hint admin-form-hint--path">{{ $currentPath }}</p>
    @endif
</div>
