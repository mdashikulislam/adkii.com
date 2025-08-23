<div class="row">
    @foreach ($fields as $field)
        @include('admin.fields.' . $field['type'], ['field' => $field])
        @if (array_key_exists('newline', $field))
            @if (is_bool($field['newline']) && $field['newline'])
                <div style="clear: both; margin: 0; padding: 0;"></div>
            @endif
            @if (isset($form))
                @if (is_string($field['newline']) && $field['newline'] == $form)
                    <div style="clear: both; margin: 0; padding: 0;"></div>
                @endif
            @endif
        @endif
    @endforeach
</div>
