<?php

namespace App\Livewire\Admin;

use App\Models\Requisition;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RequisitionManagement extends Component
{
    use WithPagination;

    public $viewingUserId = null;
    public $activeTab = 'pending';
    public $requisitionId;
    public $actionType;
    public $remarks;
    public $actionModalOpen = false;
    public $detailRequisition = null;
    public $showDetailModal = false;

    protected $rules = [
        'remarks' => 'required|string|max:1000',
    ];

    public function render()
    {
        return view('livewire.admin.requisition-management', [
            'requisitions' => $this->getRequisitions(),
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function getRequisitions()
    {
        $query = Requisition::with('user');

        if ($this->viewingUserId) {
            $query->where('user_id', $this->viewingUserId);
        }

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

    public function resetUserFilter()
    {
        $this->viewingUserId = null;
    }

    public function confirmAction($requisitionId, $actionType)
    {
        $this->resetValidation();
        $this->reset(['remarks']);

        $requisition = Requisition::find($requisitionId);

        if ($requisition && $requisition->status === 'pending') {
            $this->requisitionId = $requisitionId;
            $this->actionType = $actionType;
            $this->actionModalOpen = true;
        } else {
            session()->flash('error', 'This requisition cannot be processed.');
        }
    }

    public function processAction()
    {
        $this->validate();

        $requisition = Requisition::find($this->requisitionId);

        if ($requisition && $requisition->status === 'pending') {
            $requisition->update([
                'status' => $this->actionType,
                'approved_by' => Auth::id(),
                'approval_remarks' => $this->remarks,
            ]);

            $actionLabel = $this->actionType === 'approved' ? 'approved' : 'declined';
            session()->flash('message', "Requisition #{$requisition->id} has been {$actionLabel} successfully.");
        } else {
            session()->flash('error', 'This requisition cannot be processed or has already been processed.');
        }

        $this->actionModalOpen = false;
        $this->reset(['requisitionId', 'actionType', 'remarks']);

        // Dispatch event to refresh dashboard
        $this->dispatch('requisitionUpdated');
    }

    public function loadRequisitionDetails($requisitionId)
    {
        $this->detailRequisition = Requisition::with(['user', 'approver'])
            ->where('id', $requisitionId)
            ->first();

        $this->showDetailModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailModal = false;
        $this->detailRequisition = null;
    }
}
