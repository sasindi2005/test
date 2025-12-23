<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class VetPortalSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Branch::insert([
            [
                'name' => 'SafePaws Colombo',
                'location' => 'Colombo',
                'phone' => '+94 11 234 5678',
                'email' => 'colombo@safepaws.lk',
                'address' => '123 Galle Road, Colombo 03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SafePaws Kandy',
                'location' => 'Kandy',
                'phone' => '+94 81 234 5678',
                'email' => 'kandy@safepaws.lk',
                'address' => '45 Peradeniya Road, Kandy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SafePaws Galle',
                'location' => 'Galle',
                'phone' => '+94 91 234 5678',
                'email' => 'galle@safepaws.lk',
                'address' => '78 Matara Road, Galle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Patient::insert([
            [
                'name' => 'Max',
                'species' => 'Dog',
                'breed' => 'Golden Retriever',
                'age' => 3,
                'owner_name' => 'John Silva',
                'owner_phone' => '+94 77 123 4567',
                'owner_email' => 'john.silva@email.com',
                'medical_history' => 'Regular vaccinations up to date',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bella',
                'species' => 'Cat',
                'breed' => 'Persian',
                'age' => 2,
                'owner_name' => 'Sarah Fernando',
                'owner_phone' => '+94 77 234 5678',
                'owner_email' => 'sarah.fernando@email.com',
                'medical_history' => 'Sensitive to certain foods',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Charlie',
                'species' => 'Dog',
                'breed' => 'Labrador',
                'age' => 5,
                'owner_name' => 'David Perera',
                'owner_phone' => '+94 77 345 6789',
                'owner_email' => 'david.perera@email.com',
                'medical_history' => 'Hip dysplasia, under treatment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Luna',
                'species' => 'Cat',
                'breed' => 'Siamese',
                'age' => 1,
                'owner_name' => 'Emma Wickramasinghe',
                'owner_phone' => '+94 77 456 7890',
                'owner_email' => 'emma.w@email.com',
                'medical_history' => 'First time pet owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rocky',
                'species' => 'Dog',
                'breed' => 'German Shepherd',
                'age' => 4,
                'owner_name' => 'Michael Jayawardena',
                'owner_phone' => '+94 77 567 8901',
                'owner_email' => 'michael.j@email.com',
                'medical_history' => 'Active and healthy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $branches = Branch::all();
        $patients = Patient::all();

        Appointment::insert([
            [
                'patient_id' => $patients[0]->id,
                'user_id' => $user?->id,
                'branch_id' => $branches[0]->id,
                'time' => now()->addDays(2),
                'status' => 'pending',
                'notes' => 'Annual checkup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => $patients[1]->id,
                'user_id' => $user?->id,
                'branch_id' => $branches[0]->id,
                'time' => now()->addDays(5),
                'status' => 'pending',
                'notes' => 'Vaccination booster',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => $patients[2]->id,
                'user_id' => $user?->id,
                'branch_id' => $branches[1]->id,
                'time' => now()->subDays(3),
                'status' => 'completed',
                'notes' => 'Follow-up for hip dysplasia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => $patients[3]->id,
                'user_id' => $user?->id,
                'branch_id' => $branches[2]->id,
                'time' => now()->addDays(7),
                'status' => 'pending',
                'notes' => 'First checkup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => $patients[4]->id,
                'user_id' => $user?->id,
                'branch_id' => $branches[0]->id,
                'time' => now()->addDays(1),
                'status' => 'pending',
                'notes' => 'Routine examination',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        MedicalRecord::insert([
            [
                'patient_id' => $patients[0]->id,
                'user_id' => $user?->id,
                'title' => 'Annual Checkup',
                'symptoms' => 'None - routine checkup',
                'diagnosis' => 'Healthy, all vitals normal',
                'prescription' => json_encode(['Multivitamin supplements']),
                'file_path' => null,
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],
            [
                'patient_id' => $patients[1]->id,
                'user_id' => $user?->id,
                'title' => 'Skin Allergy Treatment',
                'symptoms' => 'Itching, redness on skin',
                'diagnosis' => 'Allergic dermatitis',
                'prescription' => json_encode(['Antihistamine cream', 'Hypoallergenic diet']),
                'file_path' => null,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'patient_id' => $patients[2]->id,
                'user_id' => $user?->id,
                'title' => 'Hip Dysplasia Follow-up',
                'symptoms' => 'Difficulty walking, limping',
                'diagnosis' => 'Hip dysplasia - moderate',
                'prescription' => json_encode(['Pain relief medication', 'Joint supplements', 'Physical therapy']),
                'file_path' => null,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'patient_id' => $patients[3]->id,
                'user_id' => $user?->id,
                'title' => 'Vaccination',
                'symptoms' => 'None - vaccination',
                'diagnosis' => 'Routine vaccination administered',
                'prescription' => json_encode(['FVRCP vaccine']),
                'file_path' => null,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'patient_id' => $patients[4]->id,
                'user_id' => $user?->id,
                'title' => 'Dental Cleaning',
                'symptoms' => 'Bad breath, tartar buildup',
                'diagnosis' => 'Dental hygiene issues',
                'prescription' => json_encode(['Dental cleaning completed', 'Dental chews recommended']),
                'file_path' => null,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
        ]);
    }
}
