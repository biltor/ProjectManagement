<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratsRelationManager extends RelationManager
{
    protected static string $relationship = 'contrats';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ref')
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
                   ->label('Period d\'essai'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ref')
            ->columns([
                Tables\Columns\TextColumn::make('ref'),
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
