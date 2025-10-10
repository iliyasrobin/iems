<?php

namespace App\Livewire;

use App\Models\GatePass;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class GatePassList extends Component
{
    use WithPagination;

    // Form properties
    #[Rule('required|string|max:255')]
    public $item_name = '';

    #[Rule('nullable|string|max:1000')]
    public $description = '';

    #[Rule('required|string|max:255')]
    public $purpose = '';

    #[Rule('nullable|date|after_or_equal:today')]
    public $expected_return_date = null;

    // Component state
    public $modalOpen = false;
    public $confirmingDelete = false;
    public $activeTab = 'all';
    public $selectedId = null;
    public $isEditing = false;
    public $detailGatePass = null;
    public $showDetailModal = false;

    public function createNewGatePass()
    {
        $this->reset('item_name', 'description', 'purpose', 'expected_return_date');
        $this->isEditing = false;
        $this->modalOpen = true;
    }

    public function saveGatePass()
    {
        $this->validate();

        $data = [
            'user_id' => Auth::id(),
            'item_name' => $this->item_name,
            'description' => $this->description,
            'purpose' => $this->purpose,
            'expected_return_date' => $this->expected_return_date,
            'status' => 'pending',
        ];

        if ($this->isEditing) {
            $gatePass = GatePass::find($this->selectedId);

            // Only allow editing if status is still pending
            if ($gatePass->status === 'pending') {
                $gatePass->update($data);
                session()->flash('message', 'Gate pass updated successfully.');
                // Dispatch event to refresh dashboard
                $this->dispatch('gatePassUpdated');
            } else {
                session()->flash('error', 'Cannot edit a gate pass that has already been processed.');
            }
        } else {
            GatePass::create($data);
            session()->flash('message', 'Gate pass created successfully.');
            // Dispatch event to refresh dashboard
            $this->dispatch('gatePassCreated');
        }

        $this->modalOpen = false;
    }

    public function edit($id)
    {
        $gatePass = GatePass::find($id);

        // Only allow editing if status is still pending
        if ($gatePass->status !== 'pending') {
            session()->flash('error', 'Cannot edit a gate pass that has already been processed.');
            return;
        }

        $this->selectedId = $id;
        $this->item_name = $gatePass->item_name;
        $this->description = $gatePass->description;
        $this->purpose = $gatePass->purpose;
        $this->expected_return_date = $gatePass->expected_return_date?->format('Y-m-d');

        $this->isEditing = true;
        $this->modalOpen = true;
    }

    public function confirmDelete($id)
    {
        $this->selectedId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        $gatePass = GatePass::find($this->selectedId);

        // Only allow deleting if status is still pending
        if ($gatePass->status === 'pending') {
            $gatePass->delete();
            session()->flash('message', 'Gate pass deleted successfully.');
        } else {
            session()->flash('error', 'Cannot delete a gate pass that has already been processed.');
        }

        $this->confirmingDelete = false;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function loadGatePassDetails($id)
    {
        $this->detailGatePass = GatePass::with(['user', 'approver'])->find($id);
        $this->showDetailModal = true;
    }

    public function render()
    {
        $gatePasses = Auth::user()->gatePasses();

        // Filter by status
        if ($this->activeTab === 'pending') {
            $gatePasses = $gatePasses->where('status', 'pending');
        } elseif ($this->activeTab === 'approved') {
            $gatePasses = $gatePasses->where('status', 'approved');
        } elseif ($this->activeTab === 'declined') {
            $gatePasses = $gatePasses->where('status', 'declined');
        }

        $gatePasses = $gatePasses->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.gate-pass-list', [
            'gatePasses' => $gatePasses
        ]);
    }
}
