<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilleResource\Pages;
use App\Filament\Resources\FamilleResource\RelationManagers;
use App\Models\Famille;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilleResource extends Resource
{
    protected static ?string $model = Famille::class;

    protected static ?string $slug = 'inventory/familly';
    protected static ?string $navigationGroup = 'Gestion de stock';
    protected static ?string $navigationIcon = 'heroicon-m-puzzle-piece';


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
            ->columns([Tables\Columns\TextColumn::make('id')
            ->label('N°'),
            Tables\Columns\TextColumn::make('code')
            ->label('CODE')
            ->searchable(),
            Tables\Columns\TextColumn::make('designation')
            ->label('DESIGNATION')
            ->searchable(),


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
            'index' => Pages\ListFamilles::route('/'),
            'create' => Pages\CreateFamille::route('/create'),
            'edit' => Pages\EditFamille::route('/{record}/edit'),
        ];
    }
}
