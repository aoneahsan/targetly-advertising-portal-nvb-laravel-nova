<?php

namespace App\Nova\ZTech;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Default\User;
use Laravel\Nova\Fields\KeyValue;

class Installment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ZTech\Installment>
     */
    public static $model = \App\Models\ZTech\Installment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    // public static $title = 'id';
    public function title() : string {
        return 'Title: ' . $this->title;
    }
    public function subTitle() : string {
        return 'CreatedAt: ' . $this->created_at;
    }

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
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Unique Id', 'uniqueId')
                ->onlyOnDetail()
                ->default(function () {
                    return uniqid();
                }),

            // Normal Form Fields
            Text::make('Title', 'title')
                ->sortable()
                ->rules(config('zInAppConfig.fieldRules.text')),

            Textarea::make('Content', 'content')->rules(config('zInAppConfig.fieldRules.content')),

            KeyValue::make('Extra Attributes', 'extraAttributes')
            ->rules(config('zInAppConfig.fieldRules.jsonNullable'))
            ->hideFromIndex()
            ->showOnDetail(function () {
                return $this->extraAttributes !== null;
            }),

            BelongsTo::make('Student', 'user', User::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
