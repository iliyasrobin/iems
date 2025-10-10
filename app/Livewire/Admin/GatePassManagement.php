<?php

namespace App\Livewire\Admin;

use App\Models\GatePass;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class GatePassManagement extends Component
{
    use WithPagination;

    // Action properties
    #[Rule('required|string|max:1000')]
    public $remarks = '';

    // Component state
    public $activeTab = 'pending';
    public $selectedId = null;
    public $actionModalOpen = false;
    public $actionType = ''; // 'approve' or 'decline'
    public $viewingUserId = null;
    public $detailGatePass = null;
    public $showDetailModal = false;

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function viewUserPasses($userId)
    {
        $this->viewingUserId = $userId;
    }

    public function resetUserFilter()
    {
        $this->viewingUserId = null;
    }

    public function confirmAction($id, $type)
    {
        $this->selectedId = $id;
        $this->actionType = $type;
        $this->remarks = '';
        $this->actionModalOpen = true;
    }

    public function processAction()
    {
        $this->validate();

        $gatePass = GatePass::findOrFail($this->selectedId);

        // Only process if the gate pass is still pending
        if ($gatePass->status !== 'pending') {
            session()->flash('error', 'This gate pass has already been processed.');
            $this->actionModalOpen = false;
            return;
        }

        $gatePass->update([
            'status' => $this->actionType === 'approve' ? 'approved' : 'declined',
            'remarks' => $this->remarks,
            'approved_by' => Auth::id(),
            'action_date' => now(),
        ]);

        $message = $this->actionType === 'approve' ? 'approved' : 'declined';
        session()->flash('message', "Gate pass {$message} successfully.");

        $this->actionModalOpen = false;

        // Dispatch event to refresh dashboard
        $this->dispatch('gatePassUpdated');
    }

    public function loadGatePassDetails($id)
    {
        $this->detailGatePass = GatePass::with(['user', 'approver'])->find($id);
        $this->showDetailModal = true;
    }

    public function render()
    {
        $query = GatePass::with(['user', 'approver']);

        // Filter by status tab
        if ($this->activeTab === 'pending') {
            $query->where('status', 'pending');
        } elseif ($this->activeTab === 'approved') {
            $query->where('status', 'approved');
        } elseif ($this->activeTab === 'declined') {
            $query->where('status', 'declined');
        }

        // Filter by user if selected
        if ($this->viewingUserId) {
            $query->where('user_id', $this->viewingUserId);
        }

        $gatePasses = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get users who have gate passes for the filter dropdown
        $users = User::whereHas('gatePasses')->select('id', 'name')->get();

        return view('livewire.admin.gate-pass-management', [
            'gatePasses' => $gatePasses,
            'users' => $users,
        ]);
    }
}
