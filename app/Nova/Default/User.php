<?php

namespace App\Nova\Default;

use App\Nova\Resource;
use App\Nova\ZTech\Batch;
use App\Nova\ZTech\Receipt;
use App\Nova\ZTech\Recovery;
use App\Nova\ZTech\Installment;
use App\Zaions\Helpers\ZHelpers;
use Dniccum\PhoneNumber\PhoneNumber;

use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Timezone;
use Laravel\Nova\Fields\Image;
use Outl1ne\NovaInputFilter\InputFilter;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class User extends Resource
{
    use HasSortableRows;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Default\User>
     */
    public static $model = \App\Models\Default\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    // public static $title = 'email';
    public function title() : string {
        return 'Username: ' . $this->username;
    }
    public function subTitle() : string {
        return 'Email: ' . $this->email;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
     'email', 'username'
    ];

    /**
     * The number of results to display when searching for relatable resources without Scout.
     *
     * @var int|null
     */
    public static $relatableSearchResults = 10;

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

            Gravatar::make()->maxWidth(50),

            Text::make('Unique Id', 'uniqueId')
                ->onlyOnDetail()
                ->default(function () {
                    return uniqid();
                }),

            Text::make('Username', 'username')
                ->sortable()
                ->rules(config('zInAppConfig.fieldRules.text'))
                ->showWhenPeeking(),

            Text::make('Email', 'email')
                ->sortable()
                ->rules(config('zInAppConfig.fieldRules.emailRules'))
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')
                ->showOnUpdating(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                })
                ->filterable(function ($request, $query, $value, $attribute) {
                    return $query->where($attribute, 'LIKE', "%{$value}%");
                }),

            Password::make('Password', 'password')
                ->onlyOnForms()
                ->creationRules(config('zInAppConfig.fieldRules.password'))
                ->updateRules(config('zInAppConfig.fieldRules.passwordNullable'))
                ->showOnUpdating(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                }),

            Image::make('Profile Pitcher', 'profilePitcher')
                ->rules(config('zInAppConfig.fieldRules.imageNullable'))
                ->disk(ZHelpers::getActiveFileDriver())
                ->maxWidth(300),

            // https://novapackages.com/packages/dniccum/phone-number
            PhoneNumber::make('Phone Number', 'phoneNumber')
                ->format('+## ### ### ####')
                ->country('PK'),

            Timezone::make('Timezone', 'timezone')->searchable()->default(ZHelpers::getTimezone()),

            Number::make('dailyMinOfficeTime', 'dailyMinOfficeTime')
                ->default(function () {
                    return 8;
                })
                ->min(3)
                ->max(12)
                ->step('any')
                ->rules(config('zInAppConfig.fieldRules.numaric'))
                ->showOnIndex(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                })
                ->showOnCreating(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                })
                ->showOnUpdating(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                })
                ->showOnDetail(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                }),

            Number::make('dailyMinOfficeTimeActivity', 'dailyMinOfficeTimeActivity')
                ->default(function ($request) {
                    return 85;
                })
                ->min(70)
                ->max(100)
                ->step('any')
                ->rules('required', 'numeric', 'min:70', 'max:100')
                ->showOnIndex(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                })
                ->showOnCreating(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                })
                ->showOnUpdating(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                })
                ->showOnDetail(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                }),


            Boolean::make('Is active', 'isActive')->default(true)
                ->show(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                }),

            KeyValue::make('Extra attributes', 'extraAttributes')
                ->rules(config('zInAppConfig.fieldRules.jsonNullable')),

            BelongsToMany::make('Batches', 'batch', Batch::class),

            HasMany::make('Student receipts', 'receipts', Receipt::class),

            HasMany::make('Student recoveries', 'recoveries', Recovery::class),

            HasMany::make('Student installments', 'installments', Installment::class)

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
        return $this->myFilters();
    }

    protected function myFilters()
    {
        return [
            InputFilter::make()->forColumns(['email'])->withName('Email')
        ];
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
