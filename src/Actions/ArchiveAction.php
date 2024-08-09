<?php

namespace Okeonline\FilamentArchivable\Actions;

use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
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

        $this->label(__('filament-archivable::actions.archive.single.label'));

        $this->modalHeading(fn (): string => __('filament-archivable::actions.archive.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalSubmitActionLabel(__('filament-archivable::actions.archive.single.modal.actions.archived.label'));

        $this->successNotificationTitle(__('filament-archivable::actions.archive.single.notifications.archived.title'));

        $this->color('warning');

        $this->icon('heroicon-m-archive-box-arrow-down');

        $this->requiresConfirmation();

        $this->modalIcon('heroicon-m-archive-box-arrow-down');

        $this->hidden(static function (Model $record): bool {
            if (! method_exists($record, 'isArchived')) {
                // @codeCoverageIgnoreStart
                return false;
                // @codeCoverageIgnoreEnd
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
