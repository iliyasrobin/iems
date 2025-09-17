<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\IpAddress;
use Livewire\Component;
use Livewire\WithPagination;

class IpAddressList extends Component
{
    use WithPagination;
    
    protected static string $layout = 'components.layouts.app';
    
    // Form properties
    public $modalOpen = false;
    public $updateMode = false;
    public $ipAddressId;
    
    public $ip_address;
    public $subnet_mask;
    public $gateway;
    public $dns;
    public $department_id;
    public $location;
    public $device_name;
    public $mac_address;
    public $status = 'active';
    public $description;
    public $assigned_to;
    public $assigned_date;
    
    // Table properties
    public $searchTerm = '';
    public $sortField = 'ip_address';
    public $sortDirection = 'asc';
    public $filterStatus = '';
    public $filterDepartment = '';
    
    protected $rules = [
        'ip_address' => 'required|string|max:45|unique:ip_addresses,ip_address',
        'subnet_mask' => 'nullable|string|max:45',
        'gateway' => 'nullable|string|max:45',
        'dns' => 'nullable|string|max:255',
        'department_id' => 'nullable|exists:departments,id',
        'location' => 'nullable|string|max:255',
        'device_name' => 'nullable|string|max:255',
        'mac_address' => 'nullable|string|max:45',
        'status' => 'required|in:active,inactive,reserved',
        'description' => 'nullable|string',
        'assigned_to' => 'nullable|string|max:255',
        'assigned_date' => 'nullable|date',
    ];
    
    protected $listeners = ['delete' => 'confirmDelete'];
    
    public function create()
    {
        $this->resetInputFields();
        $this->updateMode = false;
        $this->modalOpen = true;
        $this->status = 'active';
    }
    
    public function store()
    {
        $validatedData = $this->validate([
            'ip_address' => 'required|string|max:45|unique:ip_addresses,ip_address',
            'subnet_mask' => 'nullable|string|max:45',
            'gateway' => 'nullable|string|max:45',
            'dns' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'location' => 'nullable|string|max:255',
            'device_name' => 'nullable|string|max:255',
            'mac_address' => 'nullable|string|max:45',
            'status' => 'required|in:active,inactive,reserved',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|string|max:255',
            'assigned_date' => 'nullable|date',
        ]);
        
        IpAddress::create([
            'ip_address' => $this->ip_address,
            'subnet_mask' => $this->subnet_mask,
            'gateway' => $this->gateway,
            'dns' => $this->dns,
            'department_id' => $this->department_id,
            'location' => $this->location,
            'device_name' => $this->device_name,
            'mac_address' => $this->mac_address,
            'status' => $this->status,
            'description' => $this->description,
            'assigned_to' => $this->assigned_to,
            'assigned_date' => $this->assigned_date,
        ]);
        
        $this->modalOpen = false;
        $this->resetInputFields();
        session()->flash('message', 'IP Address added successfully.');
    }
    
    public function edit($id)
    {
        $this->updateMode = true;
        $ipAddress = IpAddress::findOrFail($id);
        $this->ipAddressId = $id;
        $this->ip_address = $ipAddress->ip_address;
        $this->subnet_mask = $ipAddress->subnet_mask;
        $this->gateway = $ipAddress->gateway;
        $this->dns = $ipAddress->dns;
        $this->department_id = $ipAddress->department_id;
        $this->location = $ipAddress->location;
        $this->device_name = $ipAddress->device_name;
        $this->mac_address = $ipAddress->mac_address;
        $this->status = $ipAddress->status;
        $this->description = $ipAddress->description;
        $this->assigned_to = $ipAddress->assigned_to;
        $this->assigned_date = $ipAddress->assigned_date;
        $this->modalOpen = true;
    }
    
    public function update()
    {
        $validatedData = $this->validate([
            'ip_address' => 'required|string|max:45|unique:ip_addresses,ip_address,'.$this->ipAddressId,
            'subnet_mask' => 'nullable|string|max:45',
            'gateway' => 'nullable|string|max:45',
            'dns' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'location' => 'nullable|string|max:255',
            'device_name' => 'nullable|string|max:255',
            'mac_address' => 'nullable|string|max:45',
            'status' => 'required|in:active,inactive,reserved',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|string|max:255',
            'assigned_date' => 'nullable|date',
        ]);
        
        $ipAddress = IpAddress::find($this->ipAddressId);
        $ipAddress->update([
            'ip_address' => $this->ip_address,
            'subnet_mask' => $this->subnet_mask,
            'gateway' => $this->gateway,
            'dns' => $this->dns,
            'department_id' => $this->department_id,
            'location' => $this->location,
            'device_name' => $this->device_name,
            'mac_address' => $this->mac_address,
            'status' => $this->status,
            'description' => $this->description,
            'assigned_to' => $this->assigned_to,
            'assigned_date' => $this->assigned_date,
        ]);
        
        $this->modalOpen = false;
        $this->updateMode = false;
        $this->resetInputFields();
        session()->flash('message', 'IP Address updated successfully.');
    }
    
    public function delete($id)
    {
        $this->ipAddressId = $id;
        $this->dispatch('show-delete-confirmation');
    }
    
    public function confirmDelete()
    {
        $ipAddress = IpAddress::find($this->ipAddressId);
        if ($ipAddress) {
            $ipAddress->delete();
            session()->flash('message', 'IP Address deleted successfully.');
        }
    }
    
    public function resetInputFields()
    {
        $this->reset([
            'ip_address', 'subnet_mask', 'gateway', 'dns', 
            'department_id', 'location', 'device_name', 'mac_address',
            'status', 'description', 'assigned_to', 'assigned_date', 'ipAddressId'
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
        $query = IpAddress::query()
            ->when($this->searchTerm, function($query) {
                $query->where(function($query) {
                    $query->where('ip_address', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('device_name', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('location', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('assigned_to', 'like', '%' . $this->searchTerm . '%');
                });
            })
            ->when($this->filterStatus, function($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterDepartment, function($query) {
                $query->where('department_id', $this->filterDepartment);
            });
        
        $ipAddresses = $query->orderBy($this->sortField, $this->sortDirection)
                            ->with('department')
                            ->paginate(10);
        
        $departments = Department::where('status', 'active')->get();
        
        // Count by status for stats
        $totalCount = IpAddress::count();
        $activeCount = IpAddress::where('status', 'active')->count();
        $inactiveCount = IpAddress::where('status', 'inactive')->count();
        $reservedCount = IpAddress::where('status', 'reserved')->count();
        
        return view('livewire.ip-address-list', [
            'ipAddresses' => $ipAddresses,
            'departments' => $departments,
            'totalCount' => $totalCount,
            'activeCount' => $activeCount,
            'inactiveCount' => $inactiveCount,
            'reservedCount' => $reservedCount,
            'title' => __('IP Address Management')
        ]);
    }
}
