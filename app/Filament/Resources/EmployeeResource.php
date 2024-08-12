<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;


class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $slug = 'RH/employees';
    protected static ?string $navigationGroup = 'Ressource Humaine';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $directory='/app/public/';
        return $form
            ->schema([
                Forms\Components\TextInput::make('matricule')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('nom')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('prenom')
                ->required()
                ->maxLength(255),
                Forms\Components\DatePicker::make('date_of_birth')
                ->required()
                ->maxDate(now()),
                Forms\Components\Select::make('sex')
                ->label('Sex :')
                ->options([
                    'homme' => 'HOMME',
                    'femme' => 'FEMME',
                ]),
                Forms\Components\Select::make('fonction_id')
                ->label('Fonction')
                ->relationship('fonction', 'designation')
                ->required(),
                Forms\Components\TextInput::make('taux')
                ->label('Taux :')
                ->required()
                ->prefix('DZD'),
                Forms\Components\Checkbox::make('is_active')
                ->label('Active'),
                Forms\Components\Section::make('image')
                ->schema([
                    
                    FileUpload::make('Image')
                        ->image()
                        ->directory('image_profiles')
                        ->disk('local')
                        ->hiddenLabel(),                                
                        ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),
                Tables\Columns\TextColumn::make('matricule')
                ->searchable(),
                Tables\Columns\TextColumn::make('nom')
                ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')->label('Date de Naissance'),
                Tables\Columns\TextColumn::make('sex'),
                Tables\Columns\TextColumn::make('fonction.designation')
                ->searchable(),
                Tables\Columns\TextColumn::make('taux'),
                Tables\Columns\IconColumn::make('is_active')
                ->label('Status')
                ->boolean()
                ->trueIcon('heroicon-o-check-badge')
                ->falseIcon('heroicon-o-x-mark'),


                
                //
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sex')
                ->options([
                    'homme' => 'HOMME',
                    'femme' => 'FEMME',
                ]),
                Tables\Filters\Filter::make('is_active')
                   ->query(fn (Builder $query): Builder => $query->where('is_active', true))
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
