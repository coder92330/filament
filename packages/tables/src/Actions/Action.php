<?php

namespace Filament\Tables\Actions;

use Filament\Actions\Concerns\CanBeDisabled;
use Filament\Actions\Concerns\CanBeOutlined;
use Filament\Actions\Concerns\CanOpenUrl;
use Filament\Actions\Concerns\HasGroupedIcon;
use Filament\Actions\Concerns\HasTooltip;
use Filament\Actions\Concerns\InteractsWithRecord;
use Filament\Actions\Contracts\Groupable;
use Filament\Actions\Contracts\HasRecord;
use Filament\Actions\MountableAction;
use Filament\Tables\Actions\Modal\Actions\Action as ModalAction;
use Illuminate\Database\Eloquent\Model;

class Action extends MountableAction implements Groupable, HasRecord
{
    use CanBeDisabled;
    use CanBeOutlined;
    use CanOpenUrl;
    use Concerns\BelongsToTable;
    use HasGroupedIcon;
    use HasTooltip;
    use InteractsWithRecord;

    protected string $view = 'filament-tables::actions.link-action';

    public function button(): static
    {
        $this->view('filament-tables::actions.button-action');

        return $this;
    }

    public function grouped(): static
    {
        $this->view('filament-tables::actions.grouped-action');

        return $this;
    }

    public function link(): static
    {
        $this->view('filament-tables::actions.link-action');

        return $this;
    }

    public function iconButton(): static
    {
        $this->view('filament-tables::actions.icon-button-action');

        return $this;
    }

    protected function getLivewireCallActionName(): string
    {
        return 'callMountedTableAction';
    }

    protected static function getModalActionClass(): string
    {
        return ModalAction::class;
    }

    public static function makeModalAction(string $name): ModalAction
    {
        /** @var ModalAction $action */
        $action = parent::makeModalAction($name);

        return $action;
    }

    protected function getDefaultEvaluationParameters(): array
    {
        return array_merge(parent::getDefaultEvaluationParameters(), [
            'record' => $this->resolveEvaluationParameter(
                'record',
                fn (): ?Model => $this->getRecord(),
            ),
            'table' => $this->getTable(),
        ]);
    }

    public function getRecordTitle(?Model $record = null): string
    {
        $record ??= $this->getRecord();

        return $this->getCustomRecordTitle($record) ?? $this->getTable()->getRecordTitle($record);
    }

    public function getModelLabel(): string
    {
        return $this->getCustomModelLabel() ?? $this->getTable()->getModelLabel();
    }

    public function getPluralModelLabel(): string
    {
        return $this->getCustomPluralModelLabel() ?? $this->getTable()->getPluralModelLabel();
    }

    public function getModel(): string
    {
        return $this->getCustomModel() ?? $this->getTable()->getModel();
    }
}