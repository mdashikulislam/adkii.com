@php
    $field ??= [];
    $field['options'] ??= [];
	$field['allows_multiple'] ??= false;
	$field['allows_null'] ??= false;
    $name = $field['name'];
	$name = $field['allows_multiple'] ? $name . '[]' : $name;
    $id = $field['id'] ?? $field['name'];
	$multipleAttr = $field['allows_multiple'] ? ' multiple' : '';
	$fieldValue = $field['value'] ?? ($field['default'] ?? null);
	$fieldValue = old($field['name'], $fieldValue);
@endphp
<div @include('admin.fields.inc.field_wrapper_attributes')>
    <label for="{{$id}}" class="form-label fw-bolder">
        {!! $field['label'] !!}
        @if (isset($field['required']) && $field['required'])
            <span class="text-danger">*</span>
        @endif
    </label>
    @include('admin.fields.inc.translatable_icon')
    <select
        name="{{ $name }}" style="width: 100%" id="{{$id}}"
        @include('admin.fields.inc.field_attributes', ['default_class' => 'form-select select2_from_array'])
        {!! $multipleAttr !!}
    >
        @if ($field['allows_null'])
            <option value="">-</option>
        @endif
        @if (!empty($field['options']))
            @foreach ($field['options'] as $key => $value)
                @php
                    $selectedAttr = ($key == $fieldValue || (is_array($fieldValue) && in_array($key, $fieldValue))) ? ' selected' : '';
                @endphp
                <option value="{{ $key }}"{!! $selectedAttr !!}>{!! $value !!}</option>
            @endforeach
        @endif
    </select>
    {{-- HINT --}}
    @if (isset($field['hint']))
        <div class="form-text">{!! $field['hint'] !!}</div>
    @endif
</div>
@push('style-library')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/select2/select2.min.css') }}">
@endpush
@push('script-library')
    <script src="{{ asset('admin/assets/vendors/select2/select2.min.js') }}"></script>
@endpush
@push('script')
    <script>
        $('.select2_from_array').each(function (i, obj) {
            if (!$(obj).hasClass("select2-hidden-accessible"))
            {
                $(obj).select2();
            }
        })
    </script>
@endpush
