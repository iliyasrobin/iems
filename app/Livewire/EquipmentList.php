<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Equipment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EquipmentList extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected static string $layout = 'components.layouts.app';

    // Form properties
    public $modalOpen = false;
    public $updateMode = false;
    public $equipmentId;

    public $name;
    public $category;
    public $serial_number;
    public $department_id;
    public $assigned_to;
    public $purchase_date;
    public $purchase_price;
    public $chalan_number;
    public $chalan_image;
    public $description;
    public $manufacturer;
    public $model;
    public $status = 'active';
    public $warranty_expiry;
    public $temp_chalan_image;

    // Table properties
    public $searchTerm = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $filterStatus = '';
    public $filterCategory = '';
    public $filterDepartment = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:100',
        'serial_number' => 'nullable|string|max:100',
        'department_id' => 'nullable|exists:departments,id',
        'assigned_to' => 'nullable|string|max:100',
        'purchase_date' => 'nullable|date',
        'purchase_price' => 'nullable|numeric',
        'chalan_number' => 'nullable|string|max:100',
        'temp_chalan_image' => 'nullable|image|max:1024', // 1MB Max
        'description' => 'nullable|string',
        'manufacturer' => 'nullable|string|max:100',
        'model' => 'nullable|string|max:100',
        'status' => 'required|in:active,inactive,maintenance,disposed',
        'warranty_expiry' => 'nullable|date',
    ];

    protected $listeners = ['delete' => 'confirmDelete'];

    public function create()
    {
        $this->resetInputFields();
        $this->updateMode = false;
        $this->modalOpen = true;
    }

    public function store()
    {
        $validatedData = $this->validate();

        // Handle file upload
        if ($this->temp_chalan_image) {
            $validatedData['chalan_image'] = $this->temp_chalan_image->store('equipment-chalans', 'public');
        }

        // Remove temporary upload field
        unset($validatedData['temp_chalan_image']);

        Equipment::create($validatedData);

        $this->modalOpen = false;
        $this->resetInputFields();
        session()->flash('message', 'Equipment added successfully.');

        // Dispatch event to refresh dashboard
        $this->dispatch('equipmentCreated');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $equipment = Equipment::findOrFail($id);
        $this->equipmentId = $id;
        $this->name = $equipment->name;
        $this->category = $equipment->category;
        $this->serial_number = $equipment->serial_number;
        $this->department_id = $equipment->department_id;
        $this->assigned_to = $equipment->assigned_to;
        $this->purchase_date = $equipment->purchase_date;
        $this->purchase_price = $equipment->purchase_price;
        $this->chalan_number = $equipment->chalan_number;
        $this->chalan_image = $equipment->chalan_image;
        $this->description = $equipment->description;
        $this->manufacturer = $equipment->manufacturer;
        $this->model = $equipment->model;
        $this->status = $equipment->status;
        $this->warranty_expiry = $equipment->warranty_expiry;
        $this->modalOpen = true;
    }

    public function update()
    {
        $validatedData = $this->validate();

        // Handle file upload
        if ($this->temp_chalan_image) {
            $validatedData['chalan_image'] = $this->temp_chalan_image->store('equipment-chalans', 'public');
        } else {
            // Keep existing image
            $validatedData['chalan_image'] = $this->chalan_image;
        }

        // Remove temporary upload field
        unset($validatedData['temp_chalan_image']);

        $equipment = Equipment::find($this->equipmentId);
        $equipment->update($validatedData);

        $this->modalOpen = false;
        $this->updateMode = false;
        $this->resetInputFields();
        session()->flash('message', 'Equipment updated successfully.');

        // Dispatch event to refresh dashboard
        $this->dispatch('equipmentUpdated');
    }

    public function delete($id)
    {
        $this->equipmentId = $id;
        $this->dispatch('show-delete-confirmation');
    }

    public function deleteEquipment()
    {
        Equipment::find($this->equipmentId)->delete();
        session()->flash('message', 'Equipment deleted successfully.');
        $this->equipmentId = null;
    }

    public function resetInputFields()
    {
        $this->reset([
            'name', 'category', 'serial_number', 'department_id',
            'assigned_to', 'purchase_date', 'purchase_price',
            'chalan_number', 'temp_chalan_image', 'description',
            'manufacturer', 'model', 'status', 'warranty_expiry',
            'equipmentId'
        ]);
        $this->resetValidation();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $query = Equipment::with('department')
            ->when($this->searchTerm, function($query) {
                $query->where(function($query) {
                    $query->where('name', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('serial_number', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('assigned_to', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
                });
            })
            ->when($this->filterStatus, function($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterCategory, function($query) {
                $query->where('category', $this->filterCategory);
            })
            ->when($this->filterDepartment, function($query) {
                $query->where('department_id', $this->filterDepartment);
            });

        $equipments = $query->orderBy($this->sortField, $this->sortDirection)->paginate(10);

        $departments = Department::where('status', 'active')->get();
        $categories = Equipment::select('category')->distinct()->pluck('category');

        // Count by status for stats
        $totalCount = Equipment::count();
        $activeCount = Equipment::where('status', 'active')->count();
        $maintenanceCount = Equipment::where('status', 'maintenance')->count();
        $inactiveCount = Equipment::where('status', 'inactive')->count();

        return view('livewire.equipment-list', [
            'equipments' => $equipments,
            'departments' => $departments,
            'categories' => $categories,
            'totalCount' => $totalCount,
            'activeCount' => $activeCount,
            'maintenanceCount' => $maintenanceCount,
            'inactiveCount' => $inactiveCount,
            'title' => __('Equipment List')
        ]);
    }
}
