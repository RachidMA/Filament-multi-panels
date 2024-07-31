<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Http\Controllers\EmployeeController;
use App\Models\Company;
use App\Models\Headquater;
use App\Models\User;

use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Cache;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('email'),
                //password and confimation
                TextInput::make('password')
                    //confirm password
                    ->password()
                    ->confirmed(),
                TextInput::make('password_confirmation')
                    ->password(),
                //selected company type
                Select::make('userable_type')
                    ->label('Company Sector')
                    ->options([
                        'headquater' => 'Headquater',
                        'company' => 'Company',
                    ])
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('userable_id', null)),

                Select::make('userable_id')
                    ->label('Name')
                    ->options(function (callable $get) {
                        $type = $get('userable_type');

                        return Cache::remember("userable_options_{$type}", now()->addMinutes(5), function () use ($type) {
                            switch ($type) {
                                case 'headquater':
                                    return Headquater::pluck('name', 'id');
                                case 'company':
                                    return Company::pluck('name', 'id');
                                default:
                                    return collect();
                            }
                        });
                    })
                //->searchable()
                //->disabled(fn ($get) => !$get('userable_type'))

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            //EXCLUDE TO CURRENT ADMIN 
            ->query(fn () => User::query()->where('id', '!=', auth()->id())) // Exclude the current user
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Action::make('CREAT NEW USER')
                    ->label('CREAT NEW USER')
                    ->url(route('employees.create'))
                    ->icon('heroicon-o-map')
                    ->color('success'),
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
            'index' => Pages\ListUsers::route('/'),
            //'create' => Pages\CreateUser::route('/create'),
            //'create' => Pages\CreateUser::route('/custom/create-user'), // Redirect to custom route
            //'create' => Pages\CreateUser::route('/create')->middlewares(['custom-employee-creation']),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    //     public static function getNavigationItems(): array
    //     {
    //         return [
    //             NavigationItem::make('Users')
    //                 ->icon('heroicon-o-users')
    //                 ->url(fn () => EmployeeController::class . '@create')
    //                 ->activeWhen(fn () => request()->routeIs('filament.resources.users.create')),
    //             // ... other navigation items ...
    //         ];
    //     }
}
