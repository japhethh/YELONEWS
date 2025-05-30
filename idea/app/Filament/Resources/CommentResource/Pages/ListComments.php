<?php

namespace App\Filament\Resources\CommentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CommentResource;
use App\Filament\Resources\CommentResource\Widgets\LatestCommentWidget;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
