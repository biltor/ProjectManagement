<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MagasinResource\Pages;
use App\Filament\Resources\MagasinResource\RelationManagers;
use App\Models\Magasin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MagasinResource extends Resource
{
    protected static ?string $model = Magasin::class;

    protected static ?string $slug = 'inventory/magasin';
    protected static ?string $navigationGroup = 'Gestion de stock';
    protected static ?string $navigationIcon = 'heroicon-m-inbox-stack';

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
                Tables\Columns\TextColumn::make('id')
                ->label('N°'),
                Tables\Columns\TextColumn::make('code')
                ->label('CODE')
                ->searchable(),
                Tables\Columns\TextColumn::make('designation')
                ->label('DESIGNATION')
                ->searchable(),
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
            'index' => Pages\ListMagasins::route('/'),
            'create' => Pages\CreateMagasin::route('/create'),
            'edit' => Pages\EditMagasin::route('/{record}/edit'),
        ];
    }
}
