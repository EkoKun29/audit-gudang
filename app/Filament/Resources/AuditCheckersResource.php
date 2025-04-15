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

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_user')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->default(auth()->id())
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Otomatis terisi sesuai user yang login')
                    ->required(),
                    
                    Forms\Components\Select::make('id_audit')
                    ->label('ID Audit')
                    ->relationship('audit', 'barang'),     
                    
                Forms\Components\TextInput::make('produk')
                    ->label('Isi/Produk')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        self::calculateTotal($get, $set);
                    }),
                    
                Forms\Components\TextInput::make('dus')
                    ->label('Dus')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        self::calculateTotal($get, $set);
                    }),
                                    
                Forms\Components\TextInput::make('btl')
                    ->label('Botol') 
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        self::calculateTotal($get, $set);
                    }),
                    
                Forms\Components\TextInput::make('kotak')
                    ->label('Kotak')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                        self::calculateTotal($get, $set);
                    }),
                    
                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->required()
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),
            ]);
    }
    
    protected static function calculateTotal(Forms\Get $get, Forms\Set $set): void
    {
        $isi = (float) $get('produk') ?: 0;
        $dus = (float) $get('dus') ?: 0;
        $btl = (float) $get('btl') ?: 0;
        $kotak = (float) $get('kotak') ?: 0;
        
        // Rumus: produk × dus + botol + kotak
        $total = ($isi * $dus) + $btl + $kotak;
        
        $set('total', $total);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([   
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->state(
                        static function ($record, $livewire, $rowLoop) {
                            return $rowLoop->iteration;
                        }),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('audit.barang')
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
                Tables\Actions\ViewAction::make()
                ->label('Lihat'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->label('Hapus'),
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