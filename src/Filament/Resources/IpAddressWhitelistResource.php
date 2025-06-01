<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Filament\Resources;

use Atendwa\Filakit\Concerns\CustomizesFilamentResource;
use Atendwa\Filakit\Resource;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource\Pages\CreateIpAddressWhitelist;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource\Pages\EditIpAddressWhitelist;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource\Pages\ListIpAddressWhitelists;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource\Pages\ViewIpAddressWhitelist;
use Atendwa\Whitelist\Models\IpAddressWhitelist;
use Filament\Clusters\Cluster;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Pages\PageRegistration;
use Filament\Tables\Table;
use Throwable;

class IpAddressWhitelistResource extends Resource
{
    use CustomizesFilamentResource;

    protected static ?string $defaultRecordTitleAttribute = null;

    public static function getCluster(): ?string
    {
        try {
            $cluster = app(asString(config('whitelist.resource.cluster')));

            return match ($cluster instanceof Cluster) {
                true => $cluster::class,
                false => null,
            };
        } catch (Throwable) {
            return null;
        }
    }

    public static function getNavigationSort(): ?int
    {
        return asInteger(config('whitelist.resource.sort'));
    }

    public static function getNavigationGroup(): ?string
    {
        $group = config('whitelist.resource.group');

        return match (is_string($group)) {
            true => $group,
            false => null,
        };
    }

    public static function getNavigationIcon(): string
    {
        $icon = config('whitelist.resource.icon');

        return match (is_string($icon)) {
            true => $icon,
            false => 'heroicon-o-rectangle-stack',
        };
    }

    public static function getActiveNavigationIcon(): string
    {
        $icon = config('whitelist.resource.active_icon');

        return match (is_string($icon)) {
            true => $icon,
            false => self::getNavigationIcon(),
        };
    }

    public static function form(Form $form): Form
    {
        $required = boolval(config('whitelist.user.is_required'));

        return $form->schema([
            Fieldset::make('')->columns()->schema([
                Select::make('user_id')->searchable()->required($required)->nullable(! $required)
                    ->relationship('user', asString(config('whitelist.user.title_attribute'))),

                ToggleButtons::make('action')->options(IpAddressWhitelist::ACTIONS)->inline()->required()
                    ->icons(['whitelist' => 'heroicon-o-check', 'blacklist' => 'heroicon-o-no-symbol'])
                    ->colors(['whitelist' => 'success', 'blacklist' => 'danger'])->default('whitelist'),

                TagsInput::make('ip_addresses')->required()->rules(['required', 'array'])
                    ->nestedRecursiveRules(['string', 'required', 'ip'])->columnSpanFull(),
            ]),
        ]);
    }

    /**
     * @throws Throwable
     */
    public static function table(Table $table): Table
    {
        $title = asString(config('whitelist.user.title_attribute'));

        self::$customTable = $table->columns([
            column('user.' . $title)->label(headline("User's " . $title)),
            column('ip_addresses')->label('IP Addresses')->badge()->color('gray'),
            badgeColumn('action', 'whitelist', ['whitelist', 'blacklist']),
        ]);

        return self::customTable();
    }

    /**
     * @return PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => ListIpAddressWhitelists::route('/'),
            'create' => CreateIpAddressWhitelist::route('/create'),
            'view' => ViewIpAddressWhitelist::route('/view/{record]'),
            'edit' => EditIpAddressWhitelist::route('/edit/{record]'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected static function scopes(): array
    {
        return [];
    }
}
