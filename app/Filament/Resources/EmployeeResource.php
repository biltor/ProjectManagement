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
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\Tabs;


class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $slug = 'RH/employees';
    protected static ?string $navigationGroup = 'Ressource Humaine';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        //declaration personnel
        $directory='/app/public/';
        return $form
        ->schema([
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Informations Personnel')
                        ->schema([
                            Forms\Components\TextInput::make('matricule')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan('full'),
                            Forms\Components\TextInput::make('nom')
                            ->required()
                            ->maxLength(255),
                            Forms\Components\TextInput::make('prenom')
                            ->required()
                            ->maxLength(255),
                            Forms\Components\DatePicker::make('date_of_birth')
                            ->label('Date de naissance :')
                            ->required()
                            ->maxDate(now()),
                            Forms\Components\Select::make('sex')
                            ->label('Sex :')
                            ->options([
                                'homme' => 'HOMME',
                                'femme' => 'FEMME',
                            ]),
                            Forms\Components\TextInput::make('tel')
                            ->label('Telephone')
                            ->tel(),
                            Forms\Components\TextInput::make('email')
                            ->label('E-MAIL')
                            ->email(),
                                
                        ])
                        ->columns(2),

                        Forms\Components\Section::make('image')
                        ->schema([
                            Forms\Components\FileUpload::make('image'),
                        ])
                        ->collapsible(),


                ])
                ->columnSpan(['lg' => 2]),

            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Information Professionel')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')
                            ->label('Active'),
                            //->helperText('cette opti')

                            Forms\Components\Select::make('fonction_id')
                                ->label('Fonction')
                                ->relationship('fonction', 'designation')
                                ->required(),
                            Forms\Components\TextInput::make('taux')
                                ->label('Taux :')
                                ->required()
                                ->prefix('DZD'),
                        ]),
                    Forms\Components\Section::make('Notes Interne')
                        ->schema([
                            Forms\Components\MarkdownEditor::make('note_interne')
                           // ->label('Note interne')
                            ->columnSpan('full'),

                        ]),


            

                ])
                ->columnSpan(['lg' => 1]),
        ])
        ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')    
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
            RelationManagers\ContratsRelationManager::class,
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
