<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResponseResource\Pages;
use App\Models\Response;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResponseResource extends Resource
{
    protected static ?string $model = Response::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('question_id')
                    ->relationship('question', 'id')
                    ->required(),
                Forms\Components\Textarea::make('response')
                    ->required()
                    ->columnSpanFull(),
                // Forms\Components\Textarea::make('meta')
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('question.question')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Responded at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('user.name')
                    ->label('User name'),
                Infolists\Components\TextEntry::make('user.email')
                    ->label('User email'),
                Infolists\Components\TextEntry::make('question.question')
                    ->columnSpanFull(),
                Infolists\Components\TextEntry::make('response')
                    ->columnSpanFull(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResponses::route('/'),
            // 'create' => Pages\CreateResponse::route('/create'),
            'view' => Pages\ViewResponse::route('/{record}'),
            // 'edit' => Pages\EditResponse::route('/{record}/edit'),
        ];
    }
}
