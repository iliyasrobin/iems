<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;

class Departments extends Component
{
    use WithPagination;

    protected static string $layout = 'components.layouts.app';
    
    public $modalOpen = false;
    public $updateMode = false;
    public $departmentId;
    
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
            'name' => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        Department::create($validatedData);

        $this->modalOpen = false;
        $this->resetInputFields();
        session()->flash('message', 'Department created successfully.');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $department = Department::findOrFail($id);
        $this->departmentId = $id;
        $this->name = $department->name;
        $this->description = $department->description;
        $this->status = $department->status;
        $this->modalOpen = true;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255|unique:departments,name,'.$this->departmentId,
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        $department = Department::find($this->departmentId);
        $department->update($validatedData);

        $this->modalOpen = false;
        $this->updateMode = false;
        $this->resetInputFields();
        session()->flash('message', 'Department updated successfully.');
    }

    public function delete($id)
    {
        $this->departmentId = $id;
        $this->dispatch('show-delete-confirmation');
    }
    
    public function confirmDelete()
    {
        $department = Department::find($this->departmentId);
        if ($department) {
            $department->delete();
            session()->flash('message', 'Department deleted successfully.');
        }
    }

    public function resetInputFields()
    {
        $this->reset(['name', 'description', 'status', 'departmentId']);
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
        $departments = Department::when($this->searchTerm, function($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
        
        return view('livewire.departments', [
            'departments' => $departments,
            'title' => __('Departments')
        ]);
    }
}
