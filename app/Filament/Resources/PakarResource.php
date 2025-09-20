<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PakarResource\Pages;
use App\Models\Pakar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PakarResource extends Resource
{
    protected static ?string $model = Pakar::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Data Pakar';
    protected static ?string $navigationGroup = 'Sistem Pakar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->label('Nama Pakar')
                ->required(),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->required()
                ->rows(3),

            Forms\Components\TextInput::make('jam_praktek')
                ->label('Jam Praktek')
                ->required()
                ->placeholder('08.00 - 15.00 WIB'),

            Forms\Components\FileUpload::make('foto')
                ->label('Foto Pakar')
                ->image()
                ->directory('pakars')
                ->imageEditor()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(40),

                Tables\Columns\TextColumn::make('jam_praktek')
                    ->label('Jam Praktek')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPakars::route('/'),
            'create' => Pages\CreatePakar::route('/create'),
            'edit' => Pages\EditPakar::route('/{record}/edit'),
        ];
    }
}
