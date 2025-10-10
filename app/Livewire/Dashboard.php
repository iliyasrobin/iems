<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Equipment;
use App\Models\GatePass;
use App\Models\Requisition;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    protected static string $layout = 'components.layouts.app';

    // Enable polling to refresh the dashboard every 30 seconds
    public function getListeners()
    {
        return [
            '$refresh' => '$refresh',
            'refreshDashboard' => '$refresh',
            'equipmentCreated' => '$refresh',
            'equipmentUpdated' => '$refresh',
            'gatePassCreated' => '$refresh',
            'gatePassUpdated' => '$refresh',
            'requisitionCreated' => '$refresh',
            'requisitionUpdated' => '$refresh',
        ];
    }

    public function mount()
    {
        // Dispatch an event to initialize charts when component is mounted
        $this->dispatch('dashboardUpdated');

        // Add a small delay to ensure DOM is ready for chart initialization
        $this->dispatch('dashboard-mounted');
    }

    public function hydrate()
    {
        // Dispatch an event to reinitialize charts when component is rehydrated
        $this->dispatch('dashboardUpdated');

        // Force refresh to ensure all data is current
        $this->dispatch('dashboard-hydrated');
    }

    public function updated()
    {
        // Dispatch an event when component data is updated
        $this->dispatch('dashboardUpdated');
    }

    public function refresh()
    {
        // This method can be called to manually refresh the dashboard
        $this->dispatch('dashboardUpdated');
    }    public function render()
    {
        // Get equipment statistics
        $totalEquipment = Equipment::count();
        $activeEquipment = Equipment::where('status', 'active')->count();
        $maintenanceEquipment = Equipment::where('status', 'maintenance')->count();
        $inactiveEquipment = Equipment::where('status', 'inactive')->count();
        $disposedEquipment = Equipment::where('status', 'disposed')->count();

        // Calculate equipment percentage by status
        $equipmentStatusData = [
            'Active' => $activeEquipment,
            'Maintenance' => $maintenanceEquipment,
            'Inactive' => $inactiveEquipment,
            'Disposed' => $disposedEquipment,
        ];

        // Get department statistics
        $totalDepartments = Department::count();
        $activeDepartments = Department::where('status', 'active')->count();

        // Equipment by department
        $equipmentByDepartment = Department::withCount('equipment')
            ->orderByDesc('equipment_count')
            ->take(5)
            ->get()
            ->map(function ($dept) {
                return [
                    'name' => $dept->name,
                    'count' => $dept->equipment_count
                ];
            });

        // Gate Pass statistics
        $pendingGatePasses = GatePass::where('status', 'pending')->count();
        $approvedGatePasses = GatePass::where('status', 'approved')->count();
        $declinedGatePasses = GatePass::where('status', 'declined')->count();
        $totalGatePasses = $pendingGatePasses + $approvedGatePasses + $declinedGatePasses;

        // Requisition statistics
        $pendingRequisitions = Requisition::where('status', 'pending')->count();
        $approvedRequisitions = Requisition::where('status', 'approved')->count();
        $declinedRequisitions = Requisition::where('status', 'declined')->count();
        $totalRequisitions = $pendingRequisitions + $approvedRequisitions + $declinedRequisitions;

        // User statistics
        $totalUsers = User::count();
        $adminUsers = User::where('is_admin', true)->count();
        $regularUsers = $totalUsers - $adminUsers;

        // Monthly equipment additions
        $currentYear = Carbon::now()->year;
        $monthlyEquipment = Equipment::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->month => $item->count];
            });

        // Fill in missing months with zero
        $monthlyEquipmentData = [];
        $monthlyLabels = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyLabels[] = Carbon::create()->month($i)->format('M');
            $monthlyEquipmentData[] = $monthlyEquipment[$i] ?? 0;
        }

        // Monthly Gate Passes
        $monthlyGatePasses = GatePass::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->month => $item->count];
            });

        $monthlyGatePassData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyGatePassData[] = $monthlyGatePasses[$i] ?? 0;
        }

        // Get recent equipment (latest 10)
        $recentEquipment = Equipment::with(['department'])
            ->latest()
            ->take(10)
            ->get();

        // Recent gate passes
        $recentGatePasses = GatePass::with(['user'])
            ->latest()
            ->take(5)
            ->get();

        // Recent requisitions
        $recentRequisitions = Requisition::with(['user'])
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.dashboard', [
            'totalEquipment' => $totalEquipment,
            'activeEquipment' => $activeEquipment,
            'maintenanceEquipment' => $maintenanceEquipment,
            'inactiveEquipment' => $inactiveEquipment,
            'disposedEquipment' => $disposedEquipment,
            'equipmentStatusData' => $equipmentStatusData,
            'totalDepartments' => $totalDepartments,
            'activeDepartments' => $activeDepartments,
            'equipmentByDepartment' => $equipmentByDepartment,
            'pendingGatePasses' => $pendingGatePasses,
            'approvedGatePasses' => $approvedGatePasses,
            'declinedGatePasses' => $declinedGatePasses,
            'totalGatePasses' => $totalGatePasses,
            'pendingRequisitions' => $pendingRequisitions,
            'approvedRequisitions' => $approvedRequisitions,
            'declinedRequisitions' => $declinedRequisitions,
            'totalRequisitions' => $totalRequisitions,
            'totalUsers' => $totalUsers,
            'adminUsers' => $adminUsers,
            'regularUsers' => $regularUsers,
            'monthlyLabels' => $monthlyLabels,
            'monthlyEquipmentData' => $monthlyEquipmentData,
            'monthlyGatePassData' => $monthlyGatePassData,
            'recentEquipment' => $recentEquipment,
            'recentGatePasses' => $recentGatePasses,
            'recentRequisitions' => $recentRequisitions,
            'title' => __('Dashboard')
        ]);
    }
}
