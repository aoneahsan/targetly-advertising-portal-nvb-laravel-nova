<?php

namespace App\Nova\Targetly;

use App\Nova\Resource;
use App\Zaions\Enums\PlatformEnum;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class SocialPostLink extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Targetly\SocialPostLink>
     */
    public static $model = \App\Models\Targetly\SocialPostLink::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    // public static $title = 'id';
    public function title(): string
    {
        return 'Title: ' . $this->title;
    }
    public function subTitle(): string
    {
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

            Hidden::make('userId', 'userId')
                ->default(function (NovaRequest $request) {
                    return $request->user()->getKey();
                }),

            // Normal Form Fields
            Text::make('Title', 'title')
                ->sortable()
                ->rules(config('zInAppConfig.fieldRules.text')),

            Textarea::make('Description', 'description')->rules(config('zInAppConfig.fieldRules.content')),

            URL::make('URL', 'url')->rules('required'),

            Select::make('Status', 'status')
                ->searchable()
                ->rules('required', 'string')
                ->options(function () {
                    return [
                        PlatformEnum::facebook->name => PlatformEnum::facebook->value,
                        PlatformEnum::linkedin->name => PlatformEnum::linkedin->value,
                        PlatformEnum::blogger->name => PlatformEnum::blogger->value,
                        PlatformEnum::youtube->name => PlatformEnum::youtube->value,
                        PlatformEnum::tiktok->name => PlatformEnum::tiktok->value,
                        PlatformEnum::twitter->name => PlatformEnum::twitter->value,
                    ];
                })
                ->displayUsingLabels(),

            Date::make('Last check at', 'lastCheckAt')->rules('required'),

            Date::make('Next recheck at', 'nextRecheckAt')->rules('nullable'),

            Boolean::make('Is active', 'isActive')->default(true)
                ->show(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                }),

            KeyValue::make('Extra Attributes', 'extraAttributes')
                ->rules(config('zInAppConfig.fieldRules.jsonNullable'))
                ->hideFromIndex()
                ->showOnDetail(function () {
                    return $this->extraAttributes !== null;
                }),
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
