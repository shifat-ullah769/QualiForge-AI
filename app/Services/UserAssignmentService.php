<?php

namespace App\Services;

use App\Models\Factory;
use App\Models\Machine;
use App\Models\ProductionLine;
use App\Models\User;
use App\UserRole;
use Illuminate\Validation\ValidationException;

class UserAssignmentService
{
    public function validate(array $data): void
    {
        $companyId = $data['company_id'] ?? null;
        $userId = $data['user_id'] ?? null;
        $factoryId = $data['factory_id'] ?? null;
        $productionLineId = $data['production_line_id'] ?? null;
        $machineId = $data['machine_id'] ?? null;
        $assignedBy = $data['assigned_by'] ?? null;

        $this->ensure(
            $companyId && $userId &&
            User::whereKey($userId)
                ->where('company_id', $companyId)
                ->where('is_active', true)
                ->whereIn('role', [
                    UserRole::QUALITY_ENGINEER->value,
                    UserRole::PRODUCTION_SUPERVISOR->value,
                ])
                ->exists(),
            'user_id',
            'The selected user must be an active Quality Engineer or Production Supervisor in this company.'
        );

        $this->ensure(
            $companyId && $factoryId &&
            Factory::whereKey($factoryId)
                ->where('company_id', $companyId)
                ->exists(),
            'factory_id',
            'The selected factory does not belong to this company.'
        );

        if ($assignedBy !== null) {
            $this->ensure(
                User::whereKey($assignedBy)
                    ->where('company_id', $companyId)
                    ->exists(),
                'assigned_by',
                'The assigner does not belong to this company.'
            );
        }

        if ($productionLineId !== null) {
            $this->ensure(
                ProductionLine::whereKey($productionLineId)
                    ->where('company_id', $companyId)
                    ->where('factory_id', $factoryId)
                    ->exists(),
                'production_line_id',
                'The selected production line does not belong to this factory and company.'
            );
        }

        if ($machineId !== null) {
            $this->ensure(
                $productionLineId !== null &&
                Machine::whereKey($machineId)
                    ->where('company_id', $companyId)
                    ->where('production_line_id', $productionLineId)
                    ->exists(),
                'machine_id',
                'The selected machine does not belong to the selected production line and company.'
            );
        }
    }

    private function ensure(
        bool $condition,
        string $field,
        string $message
    ): void {
        if (!$condition) {
            throw ValidationException::withMessages([
                $field => $message,
            ]);
        }
    }
}
