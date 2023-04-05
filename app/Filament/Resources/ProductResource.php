<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Livewire\TemporaryUploadedFile;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->reactive()
                    ->afterStateUpdated(function(Closure $set, $state){
                        $set('slug', Str::slug($state));
                        $nameParts = explode(' ',trim($state));
                        $firstWord = array_shift($nameParts);
                        $secondWord = array_pop($nameParts);
                        $set('category_code', Str::substr($firstWord,0,1) . Str::substr($secondWord,0,1));
                    })
                    ->unique()
                    ->required(),
                Forms\Components\TextInput::make('slug')->required()->disabled(),
                Forms\Components\TextInput::make('details')->rules(['min:10', 'max:20'])->required(),
                Forms\Components\TextInput::make('product_code')->required(),
                Forms\Components\TextInput::make('price')->numeric()->rules(['gte:500'])->required(),
                Forms\Components\TextInput::make('quantity')->numeric()->rules(['gte:1'])->required(),
                Forms\Components\Textarea::make('description')->rows(5)->cols(20)->minLength(10)->maxLength(300)->required(),
                CheckboxList::make('categories')
                    ->relationship('categories', 'name')
                    ->required(),
                FileUpload::make('main_image')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        $fileName = $file->hashName();
                        $name = explode('.', $fileName);
                        return (string) str('images/products/'.date_format(now(),'FY').$name[0].'.png');
                    })
                    ->label('Main Image')
                    ->maxSize(3072)
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')->sortable(),
                Tables\Columns\TextColumn::make('name')->sortable(),
                Tables\Columns\TextColumn::make('product_code')->sortable(),
                Tables\Columns\TextColumn::make('price')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }    
}
