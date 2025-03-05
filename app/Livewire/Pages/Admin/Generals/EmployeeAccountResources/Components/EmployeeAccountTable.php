<?php

namespace App\Livewire\Pages\Admin\Generals\EmployeeAccountResources\Components;

use App\Helpers\Table\Traits\WithTable;
use App\Models\EmployeeAccount;
use App\Models\Position;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class EmployeeAccountTable extends PowerGridComponent
{

  public string $tableName = 'employee-account';
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
    ];
  }

  public function datasource(): Builder
  {

    return EmployeeAccount::query()
    ->join('employees', 'employee_accounts.employee_id', 'employees.id')
    ->select([
      'employee_accounts.id',
      'employees.name AS employee_name',
      'employee_accounts.username',
      'employee_accounts.created_by',
      'employee_accounts.updated_by',
      'employee_accounts.created_at',
      'employee_accounts.updated_at',
      'employee_accounts.is_activated',
    ]);

  }

  public function relationSearch(): array
  {
    
    return [
      'employee' => [
        'name',
      ],
    ];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('action', fn($record) => Blade::render('
        <x-dropdown no-x-anchor class="btn-sm">
            <x-menu-item title="Show" Link="/employee-accounts/show/' . e($record->id) . '/readonly" />
            <x-menu-item title="Edit" Link="/employee-accounts/edit/' . e($record->id) . '"/>
        </x-dropdown>'))
      ->add('id')
      ->add('username')
      ->add('employee_name', fn($record) => $record->employee_name)
      ->add('is_activated', fn($record) => $record->is_activated ? 'Aktif' : 'Non-aktif')
    ;
  }

  public function columns(): array
  {
    return [

      Column::make('Action', 'action')
        ->bodyAttribute('text-center'),

      Column::make('ID', 'id')
        ->sortable(),

      Column::make('Username', 'username')
        ->sortable(),

      Column::make('Employee', 'employee_name'),

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
      Filter::inputText('username', 'username')->placeholder('Position'),
      Filter::inputText('employee_name', 'employees.name')->placeholder('Position'),
      Filter::datetimepicker('created_at', 'created_at')
        ->params(['timezone' => 'Asia/Jakarta',]),
      Filter::datetimepicker('updated_at', 'updated_at')
        ->params(['timezone' => 'Asia/Jakarta',]),

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

  /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
