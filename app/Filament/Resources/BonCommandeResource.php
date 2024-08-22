<?php

namespace App\Filament\Resources;
use App\Enums\OrderStatus;
use App\Filament\Resources\BonCommandeResource\Pages;
use App\Filament\Resources\BonCommandeResource\RelationManagers;
use App\Models\BonCommande;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BonCommandeResource extends Resource
{
    protected static ?string $model = BonCommande::class;
    protected static ?string $slug = 'commercial/bc';
    protected static ?string $navigationGroup = 'Commeçial';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                    Forms\Components\ToggleButtons::make('status')
                     ->inline()
                     ->options(OrderStatus::class)
                     ->required()
                     ->grouped()
                     ->columnSpan('full'),



                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(static::getDetailsFormSchema())
                            ->columns(2),
                    ])
                    ->columnSpan('full'),
        

            


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
            'index' => Pages\ListBonCommandes::route('/'),
            'create' => Pages\CreateBonCommande::route('/create'),
            'edit' => Pages\EditBonCommande::route('/{record}/edit'),
        ];
    }

     /** @return Forms\Components\Component[] */
     public static function getDetailsFormSchema(): array
     {
         return [
            Forms\Components\TextInput::make('num_deman_chat')
            ->label('N° demande achat')
            ->required()
            ->columnSpan('full'),
            Forms\Components\TextInput::make('code_bc')
                ->label('N° BC')
                 ->required(),
            Forms\Components\TextInput::make('date_of_purchase')
                 ->required(),
 
            Forms\Components\Select::make('fournisseur_id')
                 ->relationship('fournisseur', 'nomination')
                 ->searchable()
                 ->required(),
            Forms\Components\MarkdownEditor::make('notes')
                 ->columnSpan('full'),
         ];
     }


}
