<?php

use Illuminate\Support\Arr;

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
function checkIfFieldIsFirstOfItsType(array $field, array $fieldsArray):bool
{
    if ($field['name'] == getFirstOfItsTypeInArray($field['type'], $fieldsArray)['name']) {
        return true;
    }

    return false;
}
function getFirstOfItsTypeInArray($type, $array)
{
    return Arr::first($array, function ($item) use ($type) {
        return $item['type'] == $type;
    });
}
