<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\SigningOffice;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = \App\Models\Student::class;
    private string $deanDefaultName = 'Dean';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function masterAdmin(): static
    {
        return $this->afterCreating(function (Student $student) {
            $signingOffice = SigningOffice::firstOrCreate(['office_name' => $this->deanDefaultName]);

            $student->update(['current_team_id' => $signingOffice->office_id]);

            setPermissionsTeamId($signingOffice->office_id);

            $student->assignRole(Role::MasterAdmin);
        });
    }

    public function user(): static
    {
        return $this->afterCreating(function (Student $student) {
            $signingOffice = SigningOffice::firstOrCreate(['office_name' => 'Student']);

            $student->update(['current_team_id' => $signingOffice->office_id]);

            setPermissionsTeamId($signingOffice->office_id);

            $student->assignRole(Role::User);
        });
    }

    public function libraryAdmin(): static
    {
        return $this->afterCreating(function (Student $student) {
            $signingOffice = SigningOffice::firstOrCreate(['office_name' => 'Library']);

            $student->update(['current_team_id' => $signingOffice->office_id]);

            setPermissionsTeamId($signingOffice->office_id);

            $student->assignRole(Role::Librarian);
        });
    }

    public function psitsAdmin(): static
    {
        return $this->afterCreating(function (Student $student) {
            $signingOffice = SigningOffice::firstOrCreate(['office_name' => 'Library']);

            $student->update(['current_team_id' => $signingOffice->office_id]);

            setPermissionsTeamId($signingOffice->office_id);

            $student->assignRole(Role::PSITS);
        });
    }

    public function ccsoAdmin(): static
    {
        return $this->afterCreating(function (Student $student) {
            $signingOffice = SigningOffice::firstOrCreate(['office_name' => 'Library']);

            $student->update(['current_team_id' => $signingOffice->office_id]);

            setPermissionsTeamId($signingOffice->office_id);

            $student->assignRole(Role::CCSO);
        });
    }

    public function sboAdmin(): static
    {
        return $this->afterCreating(function (Student $student) {
            $signingOffice = SigningOffice::firstOrCreate(['office_name' => 'Library']);

            $student->update(['current_team_id' => $signingOffice->office_id]);

            setPermissionsTeamId($signingOffice->office_id);

            $student->assignRole(Role::SBO);
        });
    }

    public function programHead(): static
    {
        return $this->afterCreating(function (Student $student) {
            $signingOffice = SigningOffice::firstOrCreate(['office_name' => 'Library']);

            $student->update(['current_team_id' => $signingOffice->office_id]);

            setPermissionsTeamId($signingOffice->office_id);

            $student->assignRole(Role::Program_Head);
        });
    }

    public function dean(): static
    {
        return $this->afterCreating(function (Student $student) {
            $signingOffice = SigningOffice::firstOrCreate(['office_name' => 'Library']);

            $student->update(['current_team_id' => $signingOffice->office_id]);

            setPermissionsTeamId($signingOffice->office_id);

            $student->assignRole(Role::Dean);
        });
    }
}
