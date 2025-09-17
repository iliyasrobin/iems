<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Designation as DesignationModel;
use Livewire\WithPagination;

class Designation extends Component
{
    use WithPagination;

    protected static string $layout = 'components.layouts.app';
    
    public $modalOpen = false;
    public $updateMode = false;
    public $designationId;
    
    public $name;
    public $description;
    public $status = 'active';
    
    public $searchTerm = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'status' => 'required|in:active,inactive',
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
        $validatedData = $this->validate([
            'name' => 'required|string|max:255|unique:designations,name',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        DesignationModel::create($validatedData);

        $this->modalOpen = false;
        $this->resetInputFields();
        session()->flash('message', 'Designation created successfully.');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $designation = DesignationModel::findOrFail($id);
        $this->designationId = $id;
        $this->name = $designation->name;
        $this->description = $designation->description;
        $this->status = $designation->status;
        $this->modalOpen = true;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255|unique:designations,name,'.$this->designationId,
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        $designation = DesignationModel::find($this->designationId);
        $designation->update($validatedData);

        $this->modalOpen = false;
        $this->updateMode = false;
        $this->resetInputFields();
        session()->flash('message', 'Designation updated successfully.');
    }

    public function delete($id)
    {
        $this->designationId = $id;
        $this->dispatch('show-delete-confirmation');
    }
    
    public function confirmDelete()
    {
        $designation = DesignationModel::find($this->designationId);
        if ($designation) {
            $designation->delete();
            session()->flash('message', 'Designation deleted successfully.');
        }
    }

    public function resetInputFields()
    {
        $this->reset(['name', 'description', 'status', 'designationId']);
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
        $designations = DesignationModel::when($this->searchTerm, function($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
        
        return view('livewire.designation', [
            'designations' => $designations,
            'title' => __('Designations')
        ]);
    }
}
