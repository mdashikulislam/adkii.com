@php
$translatable = false;
if (@$field['translatable']){
    $translatable = true;
}
@endphp
@if ($translatable)
    <i class="fa-solid fa-flag-checkered pull-{{ config('larapen.admin.translatable_field_icon_position') }}" title="{{ trans('admin.field_translatable') }}"></i>
@endif
