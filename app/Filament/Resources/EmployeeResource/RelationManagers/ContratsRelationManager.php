<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
class ContratsRelationManager extends RelationManager
{
    protected static string $relationship = 'contrats';

    protected static ?string $recordTitleAttribute='ref';


    public function form(Form $form): Form
    {
        return $form
        ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('ref')
                    ->label('')
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
                   ->label('Period d\'essai')
                   ->suffix ('Mois'),
                   
            ]);
    }

    //infolit disfonctionement


    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('ref'),
                TextEntry::make('type_contrat'),
                TextEntry::make('date_recrutement'),
                TextEntry::make('date_fin'),

            ]);
    }

    public function table(Table $table): Table
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
