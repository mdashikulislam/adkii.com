<?php
function arrayTranslationsToJson(?array $entry, bool $unescapedUnicode = true): ?array
{
    if (empty($entry)) {
        return $entry;
    }

    $neyEntry = [];
    foreach ($entry as $key => $value) {
        if (is_array($value)) {
            $neyEntry[$key] = ($unescapedUnicode) ? json_encode($value, JSON_UNESCAPED_UNICODE) : json_encode($value);
        } else {
            $neyEntry[$key] = $value;
        }
    }

    return $neyEntry;
}
