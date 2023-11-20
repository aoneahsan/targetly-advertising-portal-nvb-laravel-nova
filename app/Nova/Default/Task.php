<?php

namespace App\Nova\Default;

use App\Models\Default\Task as ModelsTask;
use App\Nova\Actions\TaskActions\ApproveTaskAction;
use App\Nova\Actions\TaskActions\ReviewTaskAction;
use App\Nova\Filters\TaskFilters\TaskStatusFilter;
use App\Nova\Filters\TaskFilters\TaskTypeFilter;
use App\Nova\Filters\TaskFilters\TaskVerificationStatusFilter;
use App\Nova\Lenses\TaskLens\PendingTaskLens;
use App\Nova\Metrics\PartitionMetrics\TasksPerStatusPartitionMetrics;
use App\Nova\Metrics\TrendMetrics\TasksPerWeekTrendMetrics;
use App\Nova\Metrics\ValueMetrics\TaskCountValueMetrics;
use App\Nova\Resource;
use App\Zaions\Enums\TaskStatusEnum;
use App\Zaions\Enums\VerificationStatusEnum;
use App\Zaions\Helpers\ZHelpers;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Task extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Default\Task>
     */
    public static $model = \App\Models\Default\Task::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'type'
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
            ID::make()
                ->sortable(),

            // Relationship Fields
            BelongsTo::make('Created By', 'user', User::class)
                ->default(function (NovaRequest $request) {
                    return $request->user()->getKey();
                })
                ->hideFromIndex()
                ->showOnDetail(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                })
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            // Hidden Fields
            Hidden::make('userId', 'userId')
                ->default(function (NovaRequest $request) {
                    return $request->user()->getKey();
                }),

            Hidden::make('sortOrderNo', 'sortOrderNo')->default(function () {
                $lastItem = ModelsTask::latest()->first();
                return $lastItem ? $lastItem->sortOrderNo + 1 : 1;
            }),

            // Normal Form Fields
            Text::make('Title', 'title')
                ->sortable()
                ->rules('required', 'max:'. config('zInAppConfig.stringLength')),

            Textarea::make('Description', 'description')->rules('required', 'max:' . config('zInAppConfig.textLength')),

            Select::make('Task Status', 'status')
                ->default(TaskStatusEnum::todo->name)
                ->rules('required')
                ->options([
                    TaskStatusEnum::todo->name => TaskStatusEnum::todo->value,
                    TaskStatusEnum::inProgress->name => TaskStatusEnum::inProgress->value,
                    TaskStatusEnum::requireInfo->name => TaskStatusEnum::requireInfo->value,
                    TaskStatusEnum::availableForReview->name => TaskStatusEnum::availableForReview->value,
                    TaskStatusEnum::done->name => TaskStatusEnum::done->value,
                    TaskStatusEnum::closed->name => TaskStatusEnum::closed->value,
                    TaskStatusEnum::other->name => TaskStatusEnum::other->value,
                ])->displayUsingLabels()->searchable(),

            Date::make('Start Date', 'startDate')->rules('required'),

            Date::make('Estimate Date', 'endDate')->rules('nullable'),

            Boolean::make('Is active', 'isActive')->default(true)
                ->show(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                }),

            KeyValue::make('Extra Attributes', 'extraAttributes')
                ->rules('nullable', 'json')
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
        return [

            TaskCountValueMetrics::make(),
            TasksPerWeekTrendMetrics::make(),
            TasksPerStatusPartitionMetrics::make()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            TaskTypeFilter::make(),
            TaskStatusFilter::make(),
            TaskVerificationStatusFilter::make()
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
        return [
            PendingTaskLens::make()
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            ReviewTaskAction::make()
                ->canSee(function (NovaRequest $request) {
                    $currentUserId = $request->user()->id;
                    return ($this->userId !== $currentUserId || ZHelpers::isNRUserSuperAdmin($request)) && $this->verificationStatus === VerificationStatusEnum::pending->name;
                })
                ->canRun(function (NovaRequest $request) {
                    $currentUserId = $request->user()->id;
                    return ($this->userId !== $currentUserId || ZHelpers::isNRUserSuperAdmin($request)) && $this->verificationStatus === VerificationStatusEnum::pending->name;
                }),
            ApproveTaskAction::make()
                ->canSee(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request);
                })
                ->canRun(function (NovaRequest $request) {
                    return ZHelpers::isNRUserSuperAdmin($request) && $this->verificationStatus === VerificationStatusEnum::verified->name;
                })
        ];
    }
}
