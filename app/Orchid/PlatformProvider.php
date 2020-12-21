<?php

namespace App\Orchid;

use Laravel\Scout\Searchable;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return ItemMenu[]
     */
    public function registerMainMenu(): array
    {
        return [
            // debugging
            ItemMenu::label('Telescope')
                ->title('Debugging')
                ->icon('magnifier')
                ->url('/telescope')
                ->permission('platform.telescope'),

            // documentation
            ItemMenu::label('Blueprint')
                ->title('Docs') // section title
                ->icon('docs')
                ->url('https://github.com/tjventurini/laravel-blueprint')
                ->permission('platform.docs'),
            ItemMenu::label('Laravel')
                ->icon('docs')
                ->url('https://laravel.com/docs')
                ->permission('platform.docs'),
            ItemMenu::label('Orchid')
                ->icon('docs')
                ->url('https://orchid.software/en/docs')
                ->permission('platform.docs'),
            ItemMenu::label('Laradock')
                ->icon('docs')
                ->url('https://laradock.io/docs')
                ->permission('platform.docs'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            ItemMenu::label('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerSystemMenu(): array
    {
        return [
            ItemMenu::label(__('Access rights'))
                ->icon('lock')
                ->slug('Auth')
                ->active('platform.systems.*')
                ->permission('platform.systems.index')
                ->sort(1000),

            ItemMenu::label(__('Users'))
                ->place('Auth')
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->sort(1000)
                ->title(__('All registered users')),

            ItemMenu::label(__('Roles'))
                ->place('Auth')
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->sort(1000)
                ->title(__('A Role defines a set of tasks a user assigned the role is allowed to perform.')),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('Systems'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.docs', __('Documentation'))
                ->addPermission('platform.telescope', __('Telescope')),
        ];
    }

    /**
     * @return Searchable|string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
