<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RuleResource\Pages;
use App\Models\Rule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RuleResource extends Resource
{
    protected static ?string $model = Rule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Rule';
    protected static ?string $navigationGroup = 'Sistem Pakar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('min')
                        ->label('Skor Minimum')
                        ->numeric()
                        ->required(),

                    Forms\Components\TextInput::make('max')
                        ->label('Skor Maksimum')
                        ->numeric()
                        ->required(),
                ]),

                Forms\Components\TextInput::make('kategori')
                    ->label('Kategori Depresi')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('saran')
                    ->label('Saran atau Penanganan')
                    ->required()
                    ->rows(4)
                    ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('min')
                    ->label('Skor Min')
                    ->sortable(),

                Tables\Columns\TextColumn::make('max')
                    ->label('Skor Max')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->searchable(),

                Tables\Columns\TextColumn::make('saran')
                    ->label('Saran')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->saran),
            ])
            ->defaultSort('min')
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRules::route('/'),
            'create' => Pages\CreateRule::route('/create'),
            'edit' => Pages\EditRule::route('/{record}/edit'),
        ];
    }
}
