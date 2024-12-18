<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $label = 'Produk ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->label('Kategori Produk')
                    ->placeholder('Isi Kategori produk'),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Produk')
                    ->placeholder('Isi nama produk'),

                Forms\Components\TextInput::make('slug')
                    ->maxLength(255)
                    ->dehydrated()
                    ->label('Slug Produk')
                    ->placeholder('Slug akan diisi otomatis setelah mengisi nama produk')
                    ->disabled(true),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->label('Harga Produk')
                    ->placeholder('Isi harga produk'),

                Forms\Components\TextInput::make('size')
                    ->required()
                    ->maxLength(255)
                    ->label('Ukuran Produk')
                    ->placeholder('Isi ukuran produk'),

                Forms\Components\TextInput::make('weight')
                    ->required()
                    ->numeric()
                    ->label('Berat Produk')
                    ->placeholder('Isi berat produk (gram)'),

                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->label('Stok Produk')
                    ->placeholder('Isi stok produk'),

                Repeater::make('members')
                    ->relationship('photos')
                    ->required()
                    ->schema([
                        FileUpload::make('path')
                            ->image()
                            ->required()
                            ->label('Foto Produk')
                            ->directory('photo')
                            ->columnSpanFull()
                            ->maxFiles(1)
                            ->imageEditor()
                            ->imageCropAspectRatio('1:1')
                    ])
                    ->columnSpanFull()
                    ->grid([
                        'sm' => 2,
                        'md' => 3,
                        'lg' => 4,
                    ])
                    ->maxItems(3),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('Deskripsi Produk')
                    ->rows(8)
                    ->autosize()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')
                    ->sortable()
                    ->searchable()
                    ->label('Kategori'),

                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->sortable()
                    ->money('IDR'),

                TextColumn::make('size')
                    ->label('Ukuran'),

                TextColumn::make('weight')
                    ->label('Berat (g)')
                    ->sortable(),

                TextColumn::make('stock')
                    ->label('Stok')
                    ->sortable(),

                ImageColumn::make('photos.path')
                    ->label('Foto Produk')
                    ->circular(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
