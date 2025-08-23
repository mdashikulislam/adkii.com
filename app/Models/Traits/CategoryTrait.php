<?php
namespace App\Models\Traits;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

trait CategoryTrait
{
    public static function selectBoxTree(
        ?int        $skippedId,
        ?Collection $entries = null,
        array       &$tab = [],
        int         $level = 0,
        ?string     $spacerChars = '-----'
    ): array{
        if (is_null($entries)) {
            if (!empty($skippedId)) {
                $tab[0] = 'Root';
            }
            $entries = self::query()->whereNull('parent_id')->with(['children'])->where('id', '!=', $skippedId)->orderBy('_lft')->get();
            if ($entries->count() < 0) {
                return [];
            }
        }
        foreach ($entries as $entry) {
            if (!empty($spacerChars)) {
                $spacer = str_repeat($spacerChars, $level) . '| ';
            } else {
                $spacer = '';
            }
            if ($skippedId != $entry->id) {
                $tab[$entry->id] = $spacer . $entry->name;
                if (isset($entry->children) && $entry->children->count() > 0) {
                    self::selectBoxTree($skippedId, $entry->children, $tab, $level + 1, $spacerChars);
                }
            }
        }
        return $tab;
    }
    public static function getFromFields()
    {
        return [
            [
                'name'        => 'parent_id',
                'id'        => 'parent_id',
                'label'       => 'Parent',
                'type'        => 'select2_from_array',
                'options'     => self::selectBoxTree(-1),
                'allows_null' => false,
                'value'       => '0',
                'wrapper'     => [
                    'class' => 'col-md-12',
                ],
            ],
            [
                'name'       => 'name',
                'label'      => 'Name',
                'type'       => 'text',
                'attributes' => [
                    'placeholder' => 'Name',
                ],
                'wrapper'    => [
                    'class' => 'col-md-6',
                ],
            ],
            [
                'name'       => 'slug',
                'label'      => 'Slug',
                'type'       => 'text',
                'attributes' => [
                    'placeholder' => 'Will be automatically generated from your name, if left empty',
                ],
                'hint'       => 'Will be automatically generated from your name, if left empty',
                'wrapper'    => [
                    'class' => 'col-md-6',
                ],
            ]
        ];
    }
}
