<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProduitResource\Pages;
use App\Filament\Resources\ProduitResource\RelationManagers;
use App\Models\Produit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProduitResource extends Resource
{
    protected static ?string $model = Produit::class;
    protected static ?string $slug = 'inventory/produit';
    protected static ?string $navigationGroup = 'Gestion de stock';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

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

                Forms\Components\Select::make('unite_id')
                ->label('Unite')
                ->relationship('unites', 'designation')
                ->required(),
                Forms\Components\Select::make('famille_id')
                                ->label('Famille')
                                ->relationship('familles', 'designation')
                                ->required(),

                Forms\Components\Select::make('tva')
                ->label('TVA :')
                ->options([
                    '0%' => '0%',
                    '17%' => '17%',
                    '19%' => '19%',
                ]),
                Forms\Components\Select::make('type')
                ->label('TYPE :')
                ->options([
                    'stock' => 'STOCKABLE',
                    'service' => 'SERVICE',

                ]),

                //
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
            'index' => Pages\ListProduits::route('/'),
            'create' => Pages\CreateProduit::route('/create'),
            'edit' => Pages\EditProduit::route('/{record}/edit'),
        ];
    }
}
