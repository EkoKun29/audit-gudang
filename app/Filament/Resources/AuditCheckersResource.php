<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuditCheckersResource\Pages;
use App\Filament\Resources\AuditCheckersResource\RelationManagers;
use App\Models\AuditChecker;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuditCheckersResource extends Resource
{
    protected static ?string $model = AuditChecker::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    
    protected static ?string $navigationLabel = 'Audit Checkers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_user')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                    
                Forms\Components\TextInput::make('id_audit')
                    ->label('ID Audit')
                    ->required()
                    ->numeric(),
                    
                Forms\Components\TextInput::make('produk')
                    ->label('Produk')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('dus')
                    ->label('Dus')
                    ->required()
                    ->numeric(),
                    
                Forms\Components\TextInput::make('btl')
                    ->label('Botol')
                    ->required()
                    ->numeric(),
                    
                Forms\Components\TextInput::make('kotak')
                    ->label('Kotak')
                    ->required()
                    ->numeric(),
                    
                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('id_audit')
                    ->label('ID Audit')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('produk')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('dus')
                    ->label('Dus')
                    ->sortable()
                    ->numeric(),
                    
                Tables\Columns\TextColumn::make('btl')
                    ->label('Botol')
                    ->sortable()
                    ->numeric(),
                    
                Tables\Columns\TextColumn::make('kotak')
                    ->label('Kotak')
                    ->sortable()
                    ->numeric(),
                    
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->sortable()
                    ->numeric(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListAuditCheckers::route('/'),
            'create' => Pages\CreateAuditCheckers::route('/create'),
            'edit' => Pages\EditAuditCheckers::route('/{record}/edit'),
        ];
    }
}