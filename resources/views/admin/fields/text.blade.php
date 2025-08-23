<div @include('admin.fields.inc.field_wrapper_attributes') >
    <label class="form-label fw-bolder">
        {!! $field['label'] !!}
        @if (isset($field['required']) && $field['required'])
            <span class="text-danger">*</span>
        @endif
    </label>
    @if (isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if (isset($field['prefix'])) <span class="input-group-text">{!! $field['prefix'] !!}</span> @endif
        <input
            type="text"
            name="{{ $field['name'] }}"
            value="{{ old($field['name'], $field['value'] ?? ($field['default'] ?? '')) }}"
            @include('admin.fields.inc.field_attributes')
        >
        @if (isset($field['suffix'])) <span class="input-group-text">{!! $field['suffix'] !!}</span> @endif
        @if (isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <div class="form-text">{!! $field['hint'] !!}</div>
    @endif
</div>
