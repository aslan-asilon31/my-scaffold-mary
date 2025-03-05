<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources\Components;


use App\Models\SalesOrder;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Action;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Illuminate\Support\Number;


final class SalesOrderTable extends PowerGridComponent
{

  use \Mary\Traits\Toast;

    public string $tableName = 'sales-order-table';
    public string $sortField = 'updated_at';
    public string $sortDirection = 'desc';
    public string $url = '/sales-order';
    public bool $deferLoading = true;

    #[Validate]
    public  $first_name;
    public  $last_name;
    public  $is_processed;
    public  $date;
    public  $number;
    public  $total_amount;
    public  $created_at;
    public  $is_activated;
    public  $status;

    protected $listeners = [
        '$refresh'
    ];

    #[On('success')]
    public function manageSuccess()
    {
        /* do something*/
    }

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),


            PowerGrid::detail()
                ->view('components.detail')
                ->showCollapseIcon()
                ->params(['name' => 'Luan']),


            
        ];
    }

    public function datasource(): Builder
    {
        return \App\Models\SalesOrder::query()
        ->join('customers', 'sales_orders.customer_id', 'customers.id')
        ->select([
          'sales_orders.id',
          'customers.first_name',
          'customers.last_name',
          'sales_orders.date',
          'sales_orders.number',
          'sales_orders.total_amount',
          'sales_orders.status',
          'sales_orders.is_processed',
          'sales_orders.updated_by',
          'sales_orders.created_at',
          'sales_orders.updated_at',
          'sales_orders.is_activated',
        ]);

        // return SalesOrder::query();


    }



    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        $options = $this->statusSelectOptions();
        // dd($options);


        return PowerGrid::fields()
            // ->add('action', fn($record) => Blade::render('
            //     <x-dropdown no-x-anchor class="btn-sm">
            //             <x-menu-item link="/sales-orders/edit/' . e($record->id) . '" title="edit"/>
            //     </x-dropdown>'))
            ->add('id')
            ->add('action')

            ->add('first_name')
            ->add('last_name')
            ->add('date')
            ->add('number')
            ->add('total_amount')
            ->add('status', function ($record) use ($options) {
                $status = $record->status;
                return Blade::render('
                    <x-dropdown no-x-anchor class="btn-sm">
                        <x-slot name="trigger">
                            <button class="btn btn-secondary">' . e($status) . '</button>
                        </x-slot>
                        <x-menu-item link="/sales-orders/status/' . e($record->id) . '/pending" title="Set Pending" />
                        <x-menu-item link="/sales-orders/update/' . e($record->id) . '/" title="Set Settlement" />
                        <x-menu-item link="/sales-orders/status/' . e($record->id) . '/expired" title="Set Expired" />
                    </x-dropdown>
                ');
            })
            ->add('is_processed', fn($record) => $record->is_processed  ? 'yes' : 'no')
            ->add('created_at')
            ->add('is_activated', fn($record) => $record->is_processed  ? 'yes' : 'no');

    }


    public function columns(): array
    {
        return [
                    
            // Column::make('Action', 'action')
            //     ->bodyAttribute('text-center'),

            Column::action('Action'),
            
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),

                
            Column::make('Status', 'status')
                ->sortable()
                // ->editOnClick(hasPermission: true)
                ->searchable(),

                
            // Column::make('Is Proccessed', 'is_processed')
            //     ->sortable()
            //     ->searchable()
            //     ->editOnClick(),

                
            // Column::make('Is Proccessed', 'is_processed')
            //     ->searchable()
            //     ->sortable()
            //     ->toggleable(hasPermission: true, trueLabel: 'yes', falseLabel: 'no'),


            // Column::add()
            //     ->title('Is Proccessed')
            //     ->field('is_processed')
            //     ->toggleable(hasPermission: true, trueLabel: 'yes', falseLabel: 'no')
            //     ->contentClasses([
            //             true    => 'bg-green-600',
            //             false => 'bg-red-600'
            //        ])
            //     ->sortable(),

            // Column::add()
            //     ->title('Is Proccessed')
            //     ->field('is_processed')
            //     ->toggleable(hasPermission: true, trueLabel: 'yes', falseLabel: 'no')
            //     ->contentClasses([
            //             true    => 'bg-green-600',
            //             false => 'bg-red-600'
            //        ])
            //     ->sortable(),

            Column::make('Is Proccessed', 'is_processed')
                ->sortable()
                ->searchable()
                ->editOnClick(hasPermission: true),

            Column::make('Customer First Name', 'first_name')
                ->sortable()
                ->searchable()
                ->editOnClick(hasPermission: true),

            Column::make('Customer Last Name', 'last_name')
                ->sortable()
                ->searchable(),

            Column::make('Date', 'date')
                ->sortable()
                ->searchable(),

            Column::make('Number', 'number')
                ->sortable()
                ->searchable(),


            Column::make('Total Amount', 'total_amount')
                ->sortable()
                ->searchable(),


            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),
                

            // Column::make('is activated', 'is_activated')
            // ->sortable()
            // ->searchable(),


            Column::add()
                ->title('Is Proccessed')
                ->field('is_processed')
                ->toggleable(hasPermission: true, trueLabel: 'yes', falseLabel: 'no')
                ->contentClasses([
                        true    => 'bg-green-600',
                        false => 'bg-red-600'
                   ])
                ->sortable(),
            
                

            // Column::add()
            //     ->title('is activated')
            //     ->field('is_activated')
            //     ->toggleable(
            //             hasPermission: auth()->check(),
            //             trueLabel: 'Yes',
            //             falseLabel: 'No',
                    
            //     ),

        ];
    }

    protected function rules()
    {
        return [
            
            'first_name.*' => [
                'required', 'string', 'max:255',
            ],
            
            
            'last_name.*' => [
                'required', 'string', 'max:255',
            ],

            'date.*' => [
                'nullable',
            ],

            'number.*' => [
                'nullable',
            ],

            'total_amount.*' => [
                'nullable',
            ],

            'status.*' => [
               'nullable',
            ],

            // 'status.*' => [
            //     'required',
            //     'in:settlement,pending,expired',
            // ],


            'is_processed.*' => [
                'boolean',
                'required',
                'in:1,0',
            ],

            'is_activated.*' => [
                'boolean',
                'required',
                'in:1,0',
            ],


        ];
    }

    protected function validationAttributes()
    {
        return [
            'first_name.*'       => 'customer first name',
            'is_processed.*' => 'is processed',
        ];
    }

    protected function messages()
    {
        return [
            'first_name.*' => 'Valid name: :values',
            'is_processed.*' => 'Valid value :values',
        ];
    }




    // public function confirmUpdate($id)
    // {
    //     $this->dispatchBrowserEvent('show-confirmation-modal', ['id' => $id]);
    // }

    public function actionRules($row): array
    {
        return [
            // Rule::rows()
            //     ->when(fn ($record) => $record->is_processed == false)
            //     ->showToggleable(),

            // Rule::rows()
            //     ->loop(fn ($loop) => $loop->index % 2)
            //     ->setAttribute('class', '!text-red-500'),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('id', 'sales_orders.id')->placeholder('ID'),
            // Filter::inputText('status', 'status')->placeholder('Status'),
            Filter::select('status', 'status')
                ->dataSource(
                        [
                            [
                                'status'       => 'settlement',
                            ],
                            [
                                'status'       => 'expired',
                            ],
                            [
                                'status'       => 'pending',
                            ],
                        ]
                    )
                ->optionLabel('status')
                ->optionValue('status'),
            Filter::inputText('first_name', 'first_name')->placeholder('Customer First Name'),
            Filter::inputText('last_name', 'last_name')->placeholder('Customer Last Name'),
            Filter::inputText('created_by', 'sales_orders.created_by')->placeholder('Created By'),
            Filter::inputText('updated_by', 'sales_orders.updated_by')->placeholder('Updated By'),
            Filter::datepicker('created_at', 'sales_orders.created_at'),
            Filter::datepicker('updated_at', 'sales_orders.updated_at'),
            // Filter::boolean('is_processed', 'sales_orders.is_processed')->label('Yes', 'No'),
            Filter::boolean('is_processed', 'is_processed')
            ->label('yes', 'no'),
            Filter::boolean('is_activated', 'sales_orders.is_activated')->label('Yes', 'No'),
        ];
    }


    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {

        $this->withValidator(function (\Illuminate\Validation\Validator $validator) use ($id, $field) {
            if ($validator->errors()->isNotEmpty()) {
                $this->dispatch('toggle-' . $field . '-' . $id);
            }
        })->validate();


        if($field=="first_name"){
            SalesOrder::query()->find($id)->customer()->update([
                'first_name' => e($value),
            ]);


            $this->dispatch('pg:eventRefresh-default')->to(SalesOrderTable::class);
        }

        
        if($field=="is_processed"){
            SalesOrder::query()->find($id)->update([
                'is_processed' => e($value),
            ]);
        }

      $this->success('Data has been updated');

      $this->dispatch('showAlert', ['message' => 'Sales order updated successfully!']);
    }


    public function onUpdatedToggleable(string|int $id, string $field, string $value): void
    {
        
        if($field=="is_activated"){
            SalesOrder::query()->find($id)->customer()->update([
                'is_activated' => e($value),
            ]);
        }

        // SalesOrder::query()->find($id)->update([
        //     $field => e($value),
        // ]);


    }

    public function statusSelectOptions(): Collection
    {
        $salesOrders = SalesOrder::all(['id', 'status'])->map(function ($order) {
            $order->status = trim($order->status); // Trim the status
            return $order;
        });
    
        $uniqueStatuses = $salesOrders->unique('status');
    
        // $result = collect($data)->mapWithKeys(function ($item, $key) {
        $result = collect($uniqueStatuses)->mapWithKeys(function ($item, $key) {
            // Menghapus spasi di awal dan akhir
            $trimmedItem = trim($item);
            
            // Memisahkan string berdasarkan spasi dan mengambil kata pertama
            $firstWord = explode(' ', $trimmedItem)[0];
        
            return [
                $key => $firstWord,
            ];
        });

        return  $result;

        // return $uniqueStatuses->mapWithKeys(function ($item) {
        //     return [
        //         $item->id => match (strtolower($item->status)) {
        //             'settlement' => 'settlement',
        //             'pending' => ' Pending',
        //             'ordered' => 'ordered',
        //         } . ' ' . $item->status,
        //     ];
        // });
    }

    #[On('statusChanged')]
    public function statusChanged($statusId, $statId): void
    {
        dd("category Id: {$statusId} for Dish id: {$statId}");
    }

    

    public function actions($row): array
    {
        return [
            Button::add('detail')
                ->slot('Detail')
                ->class('bg-blue-500 text-white font-bold py-2 px-2 rounded')
                ->toggleDetail($row->id),
        ];
    }






}
