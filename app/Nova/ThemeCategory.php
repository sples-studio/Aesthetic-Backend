<?php

namespace App\Nova;

use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Eminiarts\Tabs\TabsOnEdit;
use NovaAttachMany\AttachMany;
use Laravel\Nova\Fields\BelongsToMany;

class ThemeCategory extends Resource
{
    use TabsOnEdit;

    public static function label() {
        return 'Theme Category';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ThemeCategory::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $tabs = [
            'General' => [
                ID::make(__('ID'), 'id')->sortable()->hideFromIndex(),
                Text::make('Category Name', 'title')->required(),
            ],
            'Themes' => [
                AttachMany::make('Themes', 'themes', Theme::class),
            ]
        ];
        return [
            new Tabs("Category Edit/Create", $tabs),
            BelongsToMany::make('Theme', 'themes', Theme::class),
        ];
}

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
