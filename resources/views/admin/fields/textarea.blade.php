{{-- textarea --}}
@php
    $id = $field['id'] ?? $field['name'];
@endphp
<div @include('admin.fields.inc.field_wrapper_attributes') >
    <label for="{{$id}}" class="form-label fw-bolder">
        {!! $field['label'] !!}
        @if (isset($field['required']) && $field['required'])
            <span class="text-danger">*</span>
        @endif
    </label>
    @include('admin.fields.inc.translatable_icon')
    <textarea
        name="{{ $field['name'] }}" id="{{$id}}"
        @include('admin.fields.inc.field_attributes')>{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}</textarea>
    {{-- HINT --}}
    @if (isset($field['hint']))
        <div class="form-text">{!! $field['hint'] !!}</div>
    @endif
</div>
