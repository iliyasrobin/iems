<?php

namespace App\Livewire;

use App\Models\Requisition;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RequisitionList extends Component
{
    use WithPagination;

    public $item_name;
    public $quantity;
    public $purpose;
    public $description;
    public $requisitionId;
    public $isEditing = false;
    public $modalOpen = false;
    public $confirmingDelete = false;
    public $activeTab = 'all';
    public $detailRequisition = null;
    public $showDetailModal = false;

    protected $rules = [
        'item_name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'purpose' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ];

    public function render()
    {
        $requisitions = $this->getRequisitions();

        return view('livewire.requisition-list', [
            'requisitions' => $requisitions,
        ]);
    }

    public function getRequisitions()
    {
        $query = Auth::user()->requisitions();

        if ($this->activeTab !== 'all') {
            $query->where('status', $this->activeTab);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function createNewRequisition()
    {
        $this->resetValidation();
        $this->reset(['item_name', 'quantity', 'purpose', 'description', 'requisitionId', 'isEditing']);
        $this->modalOpen = true;
    }

    public function saveRequisition()
    {
        $this->validate();

        if ($this->isEditing) {
            $requisition = Requisition::find($this->requisitionId);

            if ($requisition && $requisition->user_id == Auth::id() && $requisition->status === 'pending') {
                $requisition->update([
                    'item_name' => $this->item_name,
                    'quantity' => $this->quantity,
                    'purpose' => $this->purpose,
                    'description' => $this->description,
                ]);

                session()->flash('message', 'Requisition updated successfully.');
                // Dispatch event to refresh dashboard
                $this->dispatch('requisitionUpdated');
            } else {
                session()->flash('error', 'Cannot edit this requisition. It may have been processed or deleted.');
            }
        } else {
            Auth::user()->requisitions()->create([
                'item_name' => $this->item_name,
                'quantity' => $this->quantity,
                'purpose' => $this->purpose,
                'description' => $this->description,
                'status' => 'pending',
            ]);

            session()->flash('message', 'Requisition created successfully.');
            // Dispatch event to refresh dashboard
            $this->dispatch('requisitionCreated');
        }

        $this->modalOpen = false;
        $this->reset(['item_name', 'quantity', 'purpose', 'description', 'requisitionId', 'isEditing']);
    }

    public function edit($requisitionId)
    {
        $this->resetValidation();

        $requisition = Requisition::find($requisitionId);

        if ($requisition && $requisition->user_id == Auth::id() && $requisition->status === 'pending') {
            $this->requisitionId = $requisition->id;
            $this->item_name = $requisition->item_name;
            $this->quantity = $requisition->quantity;
            $this->purpose = $requisition->purpose;
            $this->description = $requisition->description;
            $this->isEditing = true;
            $this->modalOpen = true;
        } else {
            session()->flash('error', 'Cannot edit this requisition. It may have been processed or deleted.');
        }
    }

    public function confirmDelete($requisitionId)
    {
        $requisition = Requisition::find($requisitionId);

        if ($requisition && $requisition->user_id == Auth::id() && $requisition->status === 'pending') {
            $this->requisitionId = $requisitionId;
            $this->confirmingDelete = true;
        } else {
            session()->flash('error', 'Cannot delete this requisition. It may have been processed or deleted.');
        }
    }

    public function delete()
    {
        $requisition = Requisition::find($this->requisitionId);

        if ($requisition && $requisition->user_id == Auth::id() && $requisition->status === 'pending') {
            $requisition->delete();
            session()->flash('message', 'Requisition deleted successfully.');
        } else {
            session()->flash('error', 'Cannot delete this requisition. It may have been processed or deleted.');
        }

        $this->confirmingDelete = false;
        $this->reset(['requisitionId']);
    }

    public function loadRequisitionDetails($requisitionId)
    {
        $this->detailRequisition = Requisition::with(['approver'])
            ->where('id', $requisitionId)
            ->where('user_id', Auth::id())
            ->first();

        $this->showDetailModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailModal = false;
        $this->detailRequisition = null;
    }
}
