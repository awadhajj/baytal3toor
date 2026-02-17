<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'الطلبات';

    protected static ?string $modelLabel = 'طلب';

    protected static ?string $pluralModelLabel = 'الطلبات';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات العميل')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')->label('الاسم')->disabled(),
                        Forms\Components\TextInput::make('customer_phone')->label('الهاتف')->disabled(),
                        Forms\Components\TextInput::make('customer_city')->label('المدينة')->disabled(),
                        Forms\Components\Textarea::make('customer_address')->label('العنوان')->disabled(),
                        Forms\Components\Textarea::make('notes')->label('ملاحظات')->disabled(),
                    ])->columns(2),
                Forms\Components\Section::make('حالة الطلب')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('الحالة')
                            ->options([
                                'pending' => 'قيد الانتظار',
                                'confirmed' => 'مؤكد',
                                'delivered' => 'تم التوصيل',
                                'cancelled' => 'ملغي',
                            ])
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')->label('رقم الطلب')->searchable(),
                Tables\Columns\TextColumn::make('customer_name')->label('العميل')->searchable(),
                Tables\Columns\TextColumn::make('customer_phone')->label('الهاتف'),
                Tables\Columns\TextColumn::make('customer_city')->label('المدينة'),
                Tables\Columns\TextColumn::make('total')
                    ->label('الإجمالي')
                    ->money('SAR'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'قيد الانتظار',
                        'confirmed' => 'مؤكد',
                        'delivered' => 'تم التوصيل',
                        'cancelled' => 'ملغي',
                        default => $state,
                    })
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'confirmed',
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\IconColumn::make('whatsapp_sent')->label('واتساب')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('التاريخ')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'pending' => 'قيد الانتظار',
                        'confirmed' => 'مؤكد',
                        'delivered' => 'تم التوصيل',
                        'cancelled' => 'ملغي',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('معلومات الطلب')
                    ->schema([
                        Infolists\Components\TextEntry::make('order_number')->label('رقم الطلب'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('الحالة')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'pending' => 'قيد الانتظار',
                                'confirmed' => 'مؤكد',
                                'delivered' => 'تم التوصيل',
                                'cancelled' => 'ملغي',
                                default => $state,
                            })
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'confirmed' => 'info',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),
                        Infolists\Components\TextEntry::make('total')->label('الإجمالي')->money('SAR'),
                        Infolists\Components\TextEntry::make('created_at')->label('التاريخ')->dateTime(),
                    ])->columns(2),
                Infolists\Components\Section::make('معلومات العميل')
                    ->schema([
                        Infolists\Components\TextEntry::make('customer_name')->label('الاسم'),
                        Infolists\Components\TextEntry::make('customer_phone')->label('الهاتف'),
                        Infolists\Components\TextEntry::make('customer_city')->label('المدينة'),
                        Infolists\Components\TextEntry::make('customer_address')->label('العنوان'),
                        Infolists\Components\TextEntry::make('notes')->label('ملاحظات'),
                    ])->columns(2),
                Infolists\Components\Section::make('المنتجات')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                Infolists\Components\TextEntry::make('product_name')->label('المنتج'),
                                Infolists\Components\TextEntry::make('quantity')->label('الكمية'),
                                Infolists\Components\TextEntry::make('price')->label('السعر')->money('SAR'),
                            ])->columns(3),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
