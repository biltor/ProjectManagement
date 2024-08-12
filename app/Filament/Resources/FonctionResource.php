<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FonctionResource\Pages;
use App\Filament\Resources\FonctionResource\RelationManagers;
use App\Models\Fonction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FonctionResource extends Resource
{
    protected static ?string $model = Fonction::class;
    protected static ?string $slug = 'RH/fonctions';
    protected static ?string $navigationGroup = 'Ressource Humaine';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('designation')
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
                Tables\Columns\TextColumn::make('designation')
                ->label('Designation')
                ->searchable(),

            ])
            ->filters([
                //
                
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFonctions::route('/'),
            'create' => Pages\CreateFonction::route('/create'),
            'edit' => Pages\EditFonction::route('/{record}/edit'),
        ];
    }
}
