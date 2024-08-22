<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;
    protected static ?string $slug = 'commercial/client';
    protected static ?string $navigationGroup = 'Commeçial';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                ->label('Code')
                ->required(),
                Forms\Components\TextInput::make('nomination')
                ->label('Nomination')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('nis')
                ->label('NIS'),
                Forms\Components\TextInput::make('nif')
                ->label('NIF'),
                Forms\Components\TextInput::make('rc')
                ->label('RC'),
                Forms\Components\TextInput::make('ci')
                ->label('CI'),
                Forms\Components\TextInput::make('email')
                ->label('E-mail')
                ->email(),
                Forms\Components\TextInput::make('phone_number')
                ->label('Tel')
                ->tel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                ->searchable(),
                Tables\Columns\TextColumn::make('nomination')
                ->searchable(),
                Tables\Columns\TextColumn::make('nis')
                ->searchable(),
                Tables\Columns\TextColumn::make('nif')
                ->searchable(),
                Tables\Columns\TextColumn::make('rc')
                ->searchable(),
                Tables\Columns\TextColumn::make('ci')
                ->searchable(),
                Tables\Columns\TextColumn::make('email')
                ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                ->label('Status')
                ->boolean()
                ->trueIcon('heroicon-o-check-badge')
                ->falseIcon('heroicon-o-x-mark'),
                
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
