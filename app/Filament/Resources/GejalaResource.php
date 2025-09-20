<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GejalaResource\Pages;
use App\Models\Gejala;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class GejalaResource extends Resource
{
    protected static ?string $model = Gejala::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Gejala';
    protected static ?string $navigationGroup = 'Sistem Pakar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('pertanyaan')
                ->label('Pertanyaan Gejala')
                ->required(),

            Forms\Components\Repeater::make('opsiJawaban')
                ->label('Opsi Jawaban')
                ->relationship('opsiJawaban')
                ->schema([
                    Forms\Components\Textarea::make('keterangan')
                        ->label('Keterangan Jawaban')
                        ->required(),

                    Forms\Components\Select::make('skor')
                        ->label('Skor')
                        ->options([
                            0 => '0',
                            1 => '1',
                            2 => '2',
                            3 => '3',
                        ])
                        ->required(),
                ])
                ->columns(2)
                ->minItems(4)
                ->maxItems(4),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pertanyaan')
                    ->label('Pertanyaan'),

                Tables\Columns\TextColumn::make('opsi_jawaban_count') // ← ini diperbaiki
                    ->label('Jumlah Opsi Jawaban')
                    ->badge(),
            ])
            ->defaultSort('id')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('opsiJawaban');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGejalas::route('/'),
            'create' => Pages\CreateGejala::route('/create'),
            'edit' => Pages\EditGejala::route('/{record}/edit'),
        ];
    }
}
