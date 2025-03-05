<?php

namespace App\Livewire\Pages\Admin\Generals\EmployeeResources\Components;

use App\Helpers\Table\Traits\WithTable;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable; 

final class EmployeeTable extends PowerGridComponent
{
    public string $tableName = 'employee';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public string $url = '/employees';

    use WithExport;
    use WithTable;

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'my-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV), 
        ];
    }

    public function datasource(): Builder
    {
        return Employee::query()
            ->join('positions', 'employees.position_id', 'positions.id')
            ->select([
                'employees.id',
                'positions.name AS position_name',
                'employees.name',
                'employees.phone',
                'employees.email',
                'employees.image_url',
                'employees.created_by',
                'employees.updated_by',
                'employees.created_at',
                'employees.updated_at',
                'employees.is_activated',
            ]);
    }

    public function relationSearch(): array
    {
        return [
            'position' => [
                'name',
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('action', fn($record) => Blade::render('
                <x-dropdown no-x-anchor class="btn-sm">
                    <x-menu-item title="Show" Link="/employees/show/' . e($record->id) . '/readonly" />
                    <x-menu-item title="Edit" Link="/employees/edit/' . e($record->id) . '"/>
                </x-dropdown>'))
            ->add('name')
            ->add('position_name', fn($record) => $record->position_name)
            ->add('is_activated', fn($record) => $record->is_activated ? 'Aktif' : 'Non-aktif');
    }

    public function columns(): array
    {
        return [
            Column::make('Action', 'action')
                ->visibleInExport(false)
                ->bodyAttribute('text-center'),

            Column::make('ID', 'id')
                ->visibleInExport(false) // Hide ID column in export
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable(),

            Column::make('Position', 'position_name')
                ->sortable()
                ->searchable(),

            Column::make('No. Telp / HP', 'phone')
                ->sortable(),

            Column::make('Email', 'email')
                ->sortable(),

            Column::make('Created At', 'created_at')
                ->sortable(),

            Column::make('Updated At', 'updated_at')
                ->sortable(),

            Column::make('Is Activated', 'is_activated')
                ->bodyAttribute('text-center')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('id', 'id')->placeholder('ID'),
            Filter::inputText('name', 'employees.name')->placeholder('Name'),
            Filter::inputText('position_name', 'positions.name')->placeholder('Position'),
            Filter::inputText('phone', 'phone')->placeholder('Phone'),
            Filter::inputText('email', 'email')->placeholder('Email'),
            Filter::datetimepicker('created_at', 'created_at')
                ->params(['timezone' => 'Asia/Jakarta']),
            Filter::datetimepicker('updated_at', 'updated_at')
                ->params(['timezone' => 'Asia/Jakarta']),
            Filter::boolean('is_activated', 'is_activated')
                ->label('Aktif', 'Non-aktif'),
        ];
    }

    #[\Livewire\Attributes\On('clickToPrint')]
    public function clickToPrint(string $id, string $name): void
    {
        $this->js('alert(\'Print  ' . $id . '\')');
    }

    #[\Livewire\Attributes\On('clickToShow')]
    public function clickToShow(string $id, string $name): void
    {
        $this->js('alert(\'Show ' . $id . '\')');
    }

    #[\Livewire\Attributes\On('clickToEdit')]
    public function clickToEdit(string $id, string $name): void
    {
        $this->js('alert(\'Edit ' . $id . '\')');
    }

    #[\Livewire\Attributes\On('clickToDelete')]
    public function clickToDelete(string $id, string $name): void
    {
        $this->js('alert(\'Delete ' . $id . '\')');
    }
}
