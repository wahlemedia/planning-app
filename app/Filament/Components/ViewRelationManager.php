<?php

declare(strict_types=1);

namespace App\Filament\Components;

use Filament\Facades\Filament;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Gate;

class ViewRelationManager extends RelationManager
{
    protected function getRelatedModel(): string
    {
        return $this->getRelationship()->getModel()::class;
    }

    public static function canViewForRecord(Model $ownerRecord): bool
    {
        if (static::shouldIgnorePolicies()) {
            return true;
        }

        $model = $ownerRecord->{static::getRelationshipName()}()->getModel()::class;

        $policy = Gate::getPolicyFor($model);
        $user = Filament::auth()->user();
        $action = 'viewAny';

        if ($policy === null) {
            return true;
        }

        if (!method_exists($policy, $action)) {
            return true;
        }

        return Gate::forUser($user)->check($action, $model);
    }

    protected function getTableQuery(): Builder | Relation
    {
        return  $this->getRelationship();
        ;
    }
}
