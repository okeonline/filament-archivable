<?php

namespace Okeonline\FilamentArchivable\Tables\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class ArchiveAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'archive';
    }

    protected function setUp(): void
    {
        parent::setUp();

        // $this->label(__('filament-actions::delete.single.label'));
        $this->label('Archiveren');

        $this->modalHeading(fn (): string => __('filament-actions::delete.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalSubmitActionLabel(__('filament-actions::delete.single.modal.actions.delete.label'));

        $this->successNotificationTitle(__('filament-actions::delete.single.notifications.deleted.title'));

        $this->color('warning');

        // $this->icon(FilamentIcon::resolve('actions::delete-action') ?? 'heroicon-m-archive-box-arrow-down');
        $this->icon('heroicon-m-archive-box-arrow-down');

        $this->requiresConfirmation();

        $this->modalIcon(FilamentIcon::resolve('actions::delete-action.modal') ?? 'heroicon-m-archive-box-arrow-down');

        $this->hidden(static function (Model $record): bool {
            if (! method_exists($record, 'isArchived')) {
                return false;
            }

            return $record->isArchived();
        });

        $this->action(function (): void {
            $result = $this->process(static fn (Model $record) => $record->archive());

            if (! $result) {
                // @codeCoverageIgnoreStart
                $this->failure();

                return;
                // @codeCoverageIgnoreEnd
            }

            $this->success();
        });
    }
}
