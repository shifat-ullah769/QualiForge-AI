<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Factory;
use App\Models\Machine;
use App\Models\ProductionLine;
use App\Models\User;
use App\Services\UserAssignmentService;
use App\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserAssignmentSecurityTest extends TestCase
{
    use RefreshDatabase;

    private function createCompany(string $code): Company
    {
        return Company::create([
            'name' => "Company {$code}",
            'code' => $code,
            'country' => 'Bangladesh',
            'is_active' => true,
        ]);
    }

    private function createEngineer(Company $company): User
    {
        return User::create([
            'name' => 'Test Engineer',
            'email' => uniqid() . '@example.com',
            'password' => 'password',
            'role' => UserRole::QUALITY_ENGINEER,
            'company_id' => $company->id,
            'is_active' => true,
        ]);
    }

    private function createFactory(Company $company, string $code): Factory
    {
        return Factory::create([
            'company_id' => $company->id,
            'name' => "Factory {$code}",
            'factory_code' => $code,
            'status' => 'active',
        ]);
    }

    private function createProductionLine(
        Company $company,
        Factory $factory,
        string $code
    ): ProductionLine {
        return ProductionLine::create([
            'company_id' => $company->id,
            'factory_id' => $factory->id,
            'name' => "Line {$code}",
            'code' => $code,
            'status' => 'active',
        ]);
    }

    private function createMachine(
        Company $company,
        ProductionLine $line,
        string $code
    ): Machine {
        return Machine::create([
            'company_id' => $company->id,
            'production_line_id' => $line->id,
            'name' => "Machine {$code}",
            'machine_code' => $code,
            'status' => 'active',
        ]);
    }

    public function test_user_from_another_company_is_rejected(): void
    {
        $companyA = $this->createCompany('COMP-A');
        $companyB = $this->createCompany('COMP-B');

        $factoryA = $this->createFactory($companyA, 'FACT-A');
        $userB = $this->createEngineer($companyB);

        $this->expectException(ValidationException::class);

        app(UserAssignmentService::class)->validate([
            'company_id' => $companyA->id,
            'user_id' => $userB->id,
            'factory_id' => $factoryA->id,
        ]);
    }

    public function test_factory_from_another_company_is_rejected(): void
    {
        $companyA = $this->createCompany('COMP-C');
        $companyB = $this->createCompany('COMP-D');

        $userA = $this->createEngineer($companyA);
        $factoryB = $this->createFactory($companyB, 'FACT-B');

        $this->expectException(ValidationException::class);

        app(UserAssignmentService::class)->validate([
            'company_id' => $companyA->id,
            'user_id' => $userA->id,
            'factory_id' => $factoryB->id,
        ]);
    }

    public function test_production_line_from_another_factory_is_rejected(): void
    {
        $company = $this->createCompany('COMP-E');

        $user = $this->createEngineer($company);

        $factoryA = $this->createFactory($company, 'FACT-C');
        $factoryB = $this->createFactory($company, 'FACT-D');

        $lineB = $this->createProductionLine(
            $company,
            $factoryB,
            'LINE-B'
        );

        $this->expectException(ValidationException::class);

        app(UserAssignmentService::class)->validate([
            'company_id' => $company->id,
            'user_id' => $user->id,
            'factory_id' => $factoryA->id,
            'production_line_id' => $lineB->id,
        ]);
    }

    public function test_machine_from_another_production_line_is_rejected(): void
    {
        $company = $this->createCompany('COMP-F');

        $user = $this->createEngineer($company);
        $factory = $this->createFactory($company, 'FACT-E');

        $lineA = $this->createProductionLine(
            $company,
            $factory,
            'LINE-C'
        );

        $lineB = $this->createProductionLine(
            $company,
            $factory,
            'LINE-D'
        );

        $machineB = $this->createMachine(
            $company,
            $lineB,
            'MACHINE-B'
        );

        $this->expectException(ValidationException::class);

        app(UserAssignmentService::class)->validate([
            'company_id' => $company->id,
            'user_id' => $user->id,
            'factory_id' => $factory->id,
            'production_line_id' => $lineA->id,
            'machine_id' => $machineB->id,
        ]);
    }

    public function test_valid_assignment_data_passes_validation(): void
    {
        $company = $this->createCompany('COMP-G');

        $user = $this->createEngineer($company);
        $factory = $this->createFactory($company, 'FACT-F');

        $line = $this->createProductionLine(
            $company,
            $factory,
            'LINE-E'
        );

        $machine = $this->createMachine(
            $company,
            $line,
            'MACHINE-C'
        );

        app(UserAssignmentService::class)->validate([
            'company_id' => $company->id,
            'user_id' => $user->id,
            'factory_id' => $factory->id,
            'production_line_id' => $line->id,
            'machine_id' => $machine->id,
        ]);

        $this->assertTrue(true);
    }
}
