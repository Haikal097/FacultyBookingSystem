<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'name' => 'Dewan Kuliah 100A',
                'type' => 'Lecture Hall',
                'capacity' => 100,
                'building' => 'Dewan Kuliah',
                'status' => 'available',
                'description' => 'Spacious hall for lectures, presentations, or seminars',
                'price_per_hour' => 200.00, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dewan Kuliah 100B',
                'type' => 'Lecture Hall',
                'capacity' => 100,
                'building' => 'Dewan Kuliah',
                'status' => 'available',
                'description' => 'Spacious hall for lectures, presentations, or seminars',
                'price_per_hour' => 200.00, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dewan Kuliah 200',
                'type' => 'Lecture Hall',
                'capacity' => 200,
                'building' => 'Dewan Kuliah',
                'status' => 'available',
                'description' => 'Spacious and well-equipped hall suitable for large-scale lectures and university functions.',
                'price_per_hour' => 250.00, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bilik Perbincangan',
                'type' => 'Meeting Room',
                'capacity' => 20,
                'building' => 'Perpustakaan Tun Dr Ismail (PTDI)',
                'status' => 'available',
                'description' => 'Quiet meeting room ideal for study groups, team discussions, and academic collaboration.',
                'price_per_hour' => 100.00, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bilik Seminar',
                'type' => 'Lecture Hall',
                'capacity' => 50,
                'building' => 'Perpustakaan Tun Dr Ismail (PTDI)',
                'status' => 'available',
                'description' => 'Comfortable venue for hosting seminars, briefings, or workshops in an academic setting.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Makmal Komputer',
                'type' => 'Computer Lab',
                'capacity' => 30,
                'building' => 'Perpustakaan Tun Dr Ismail (PTDI)',
                'status' => 'available',
                'description' => 'Technology-enabled space for academic computing, training, and research activities.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Padang Bola Sepak',
                'type' => 'Sports Facility',
                'capacity' => 60,
                'building' => 'Padang Permainan',
                'status' => 'available',
                'description' => 'Outdoor football field suitable for training, matches, and recreational activities.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gelanggang Futsal',
                'type' => 'Sports Facility',
                'capacity' => 50,
                'building' => 'Padang Permainan',
                'status' => 'available',
                'description' => 'Outdoor futsal court ideal for team practice and friendly matches.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gelanggang Bola Jaring',
                'type' => 'Sports Facility',
                'capacity' => 40,
                'building' => 'Padang Permainan',
                'status' => 'available',
                'description' => 'Outdoor netball court suitable for training sessions and matches.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gelanggang Bola Tampar',
                'type' => 'Sports Facility',
                'capacity' => 30,
                'building' => 'Padang Permainan',
                'status' => 'available',
                'description' => 'A versatile outdoor volleyball court perfect for both casual play and organized competitions.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lapangan Memanah',
                'type' => 'Sports Facility',
                'capacity' => 30,
                'building' => 'Padang Permainan',
                'status' => 'available',
                'description' => 'Archery range equipped for both recreational and competitive archery sessions.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more rooms here if needed
        ]);
    }
}
