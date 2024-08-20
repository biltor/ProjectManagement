<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniteResource\Pages;
use App\Filament\Resources\UniteResource\RelationManagers;
use App\Models\Unite;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UniteResource extends Resource
{
    protected static ?string $model = Unite::class;

    protected static ?string $slug = 'inventory/unite';
    protected static ?string $navigationGroup = 'Gestion de stock';
    protected static ?string $navigationIcon = 'heroicon-m-beaker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                ->label('Code')
                ->required(),
                Forms\Components\TextInput::make('designation')
                ->label('Designation')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUnites::route('/'),
            'create' => Pages\CreateUnite::route('/create'),
            'edit' => Pages\EditUnite::route('/{record}/edit'),
        ];
    }
}
