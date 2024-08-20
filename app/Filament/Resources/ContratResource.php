<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContratResource\Pages;
use App\Filament\Resources\ContratResource\RelationManagers;
use App\Models\Contrat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratResource extends Resource
{
    protected static ?string $model = Contrat::class;

    protected static ?string $slug = 'RH/Contrats';
    protected static ?string $navigationGroup = 'Ressource Humaine';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                ->label('matricule d\'employee')
                ->relationship('employees', 'matricule')
                ->required(),
                Forms\Components\TextInput::make('ref')
                    ->label('Refference')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('type_contrat')
                    ->label('Type Contrat :')
                    ->options([
                        'cdd' => 'CDD',
                        'cdi' => 'CDI',
                        'anem' => 'ANEM',
                    ]),
                Forms\Components\DatePicker::make('date_recrutement')
                    ->label('Debut de contrat')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\DatePicker::make('date_fin')
                    ->label('Fin de contrat')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\TextInput::make('period')
                   ->label('Period d\'essai :')
                   ->required()
                   ->suffix ('Mois'),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ref'),
                Tables\Columns\TextColumn::make('date_recrutement')
                ->label('date de debut de contrat')
                ->searchable(),
                Tables\Columns\TextColumn::make('date_fin')
                ->label('date de fin de contrat')
                ->searchable(),
                Tables\Columns\TextColumn::make('period')
                ->label('Period d\'essai / mois')
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
            'index' => Pages\ListContrats::route('/'),
            'create' => Pages\CreateContrat::route('/create'),
            'edit' => Pages\EditContrat::route('/{record}/edit'),
        ];
    }
}
