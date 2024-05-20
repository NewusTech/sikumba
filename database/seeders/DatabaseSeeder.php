<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'fullname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'status' => '1'
        ]);
        DB::table('users')->insert([
            'username' => 'user',
            'fullname' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'),
            'status' => '1'
        ]);
        DB::table('users')->insert([
            'username' => 'kauptd',
            'fullname' => 'UPTD',
            'email' => 'uptd@gmail.com',
            'password' => bcrypt('123456'),
            'status' => '1'
        ]);
        DB::table('users')->insert([
            'username' => 'TU',
            'fullname' => 'TU',
            'email' => 'tu@gmail.com',
            'password' => bcrypt('123456'),
            'status' => '1'
        ]);
        DB::table('users')->insert([
            'username' => 'Pengawasan',
            'fullname' => 'Pengawasan',
            'email' => 'pengawasan@gmail.com',
            'password' => bcrypt('123456'),
            'status' => '1'
        ]);
        DB::table('users')->insert([
            'username' => 'Sertifikasi',
            'fullname' => 'Sertifikasi',
            'email' => 'sertifikasi@gmail.com',
            'password' => bcrypt('123456'),
            'status' => '1'
        ]);
        DB::table('users')->insert([
            'username' => 'PPC',
            'fullname' => 'PPC',
            'email' => 'ppc@gmail.com',
            'password' => bcrypt('123456'),
            'status' => '1'
        ]);
        DB::table('users')->insert([
            'username' => 'Analis',
            'fullname' => 'Analis',
            'email' => 'analis@gmail.com',
            'password' => bcrypt('123456'),
            'status' => '1'
        ]);

        DB::table('roles')->insert([
            'name' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'User',
        ]);
        DB::table('roles')->insert([
            'name' => 'Ka. UPTD',
        ]);
        DB::table('roles')->insert([
            'name' => 'TU',
        ]);
        DB::table('roles')->insert([
            'name' => 'Kasi Pengawasan',
        ]);
        DB::table('roles')->insert([
            'name' => 'Kasi Sertifikasi',
        ]);
        DB::table('roles')->insert([
            'name' => 'PPC',
        ]);
        DB::table('roles')->insert([
            'name' => 'Analis',
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 4,
            'user_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('role_user')->insert([
            'role_id' => 5,
            'user_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 6,
            'user_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('role_user')->insert([
            'role_id' => 7,
            'user_id' => 7,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 8,
            'user_id' => 8,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('master_commodity')->insert([
            'kode' => 'K',
            'keterangan' => 'Kopi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('master_commodity')->insert([
            'kode' => 'L',
            'keterangan' => 'Lada',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'John Doe',
            'userID' => 2,
            'date' => '2024-02-11',
            'sealing_mark' => 'Seal123',
            'report_sealing' => 'Report123',
            'consignment_commodity' => 'Commodity123',
            'identification' => 'ID123',
            'exporting_comp' => 'ExportCo',
            'address' => '123 Main St, City',
            'regist_number' => 'Reg123',
            'type_packing' => 'Type123',
            'type_commodity' => 'Lada',
            'qty_package' => 10,
            'weight' => 25.5,
            'volume' => 10.2,
            'type' => 1,
            'status' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('form_pengajuan')->insert([
            'name' => 'Jane Karbu',
            'userID' => 2,
            'date' => '2024-02-06',
            'sealing_mark' => 'Seal456',
            'report_sealing' => 'Report456',
            'consignment_commodity' => 'Commodity456',
            'identification' => 'ID456',
            'exporting_comp' => 'ExportCo',
            'address' => '456 Oak St, Town',
            'regist_number' => 'Reg456',
            'type_packing' => 'Type456',
            'type_commodity' => 'Kopi',
            'qty_package' => 15,
            'weight' => 30.0,
            'volume' => 12.5,
            'type' => 2,
            'status' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('form_pengajuan')->insert([
            'name' => 'Another User',
            'userID' => 2,
            'date' => '2024-02-06',
            'sealing_mark' => 'Seal789',
            'report_sealing' => 'Report789',
            'consignment_commodity' => 'Commodity789',
            'identification' => 'ID789',
            'exporting_comp' => 'ExportCo',
            'address' => '789 Pine St, Village',
            'regist_number' => 'Reg789',
            'type_packing' => 'Type789',
            'type_commodity' => 'Kopi',
            'qty_package' => 20,
            'weight' => 40.0,
            'volume' => 15.5,
            'type' => 2,
            'status' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('form_pengajuan')->insert([
            'name' => 'Jane Doe',
            'userID' => 2,
            'date' => '2024-03-10',
            'sealing_mark' => 'Seal456',
            'report_sealing' => 'Report456',
            'consignment_commodity' => 'Commodity456',
            'identification' => 'ID456',
            'exporting_comp' => 'ExportCo',
            'address' => '456 Oak St, Town',
            'regist_number' => 'Reg456',
            'type_packing' => 'Type456',
            'type_commodity' => 'Lada',
            'qty_package' => 15,
            'weight' => 30.0,
            'volume' => 12.5,
            'type' => 2,
            'status' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 3',
            'userID' => 2,
            'date' => '2024-02-28',
            'sealing_mark' => 'Seal789',
            'report_sealing' => 'Report789',
            'consignment_commodity' => 'Commodity789',
            'identification' => 'ID789',
            'exporting_comp' => 'ExportCo',
            'address' => '789 Pine St, Village',
            'regist_number' => 'Reg789',
            'type_packing' => 'Type789',
            'type_commodity' => 'Lada',
            'qty_package' => 20,
            'weight' => 40.0,
            'volume' => 15.5,
            'type' => 1,
            'status' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 4',
            'userID' => 2,
            'date' => '2024-03-06',
            'sealing_mark' => 'Seal4',
            'report_sealing' => 'Report4',
            'consignment_commodity' => 'Commodity4',
            'identification' => 'ID4',
            'exporting_comp' => 'ExportCo',
            'address' => '4 Pine St, Village',
            'regist_number' => 'Reg4',
            'type_packing' => 'Type4',
            'type_commodity' => 'Lada',
            'qty_package' => 25,
            'weight' => 45.0,
            'volume' => 18.5,
            'type' => 2,
            'status' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 5',
            'userID' => 2,
            'date' => '2024-02-06',
            'sealing_mark' => 'Seal5',
            'report_sealing' => 'Report5',
            'consignment_commodity' => 'Commodity5',
            'identification' => 'ID5',
            'exporting_comp' => 'ExportCo',
            'address' => '5 Pine St, Village',
            'regist_number' => 'Reg5',
            'type_packing' => 'Type5',
            'type_commodity' => 'Lada',
            'qty_package' => 22,
            'weight' => 42.0,
            'volume' => 16.5,
            'type' => 1,
            'status' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 6',
            'userID' => 2,
            'date' => '2024-02-06',
            'sealing_mark' => 'Seal6',
            'report_sealing' => 'Report6',
            'consignment_commodity' => 'Commodity6',
            'identification' => 'ID6',
            'exporting_comp' => 'ExportCo',
            'address' => '6 Pine St, Village',
            'regist_number' => 'Reg6',
            'type_packing' => 'Type6',
            'type_commodity' => 'Lada',
            'qty_package' => 18,
            'weight' => 38.0,
            'volume' => 14.5,
            'type' => 2,
            'status' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 7',
            'userID' => 2,
            'date' => '2024-01-06',
            'sealing_mark' => 'Seal7',
            'report_sealing' => 'Report7',
            'consignment_commodity' => 'Commodity7',
            'identification' => 'ID7',
            'exporting_comp' => 'ExportCo',
            'address' => '7 Pine St, Village',
            'regist_number' => 'Reg7',
            'type_packing' => 'Type7',
            'type_commodity' => 'Lada',
            'qty_package' => 28,
            'weight' => 48.0,
            'volume' => 20.5,
            'type' => 1,
            'status' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 8',
            'userID' => 2,
            'date' => '2024-01-06',
            'sealing_mark' => 'Seal8',
            'report_sealing' => 'Report8',
            'consignment_commodity' => 'Commodity8',
            'identification' => 'ID8',
            'exporting_comp' => 'ExportCo',
            'address' => '8 Pine St, Village',
            'regist_number' => 'Reg8',
            'type_packing' => 'Type8',
            'type_commodity' => 'Lada',
            'qty_package' => 30,
            'weight' => 50.0,
            'volume' => 22.5,
            'type' => 2,
            'status' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 9',
            'userID' => 2,
            'date' => '2024-02-06',
            'sealing_mark' => 'Seal9',
            'report_sealing' => 'Report9',
            'consignment_commodity' => 'Commodity9',
            'identification' => 'ID9',
            'exporting_comp' => 'ExportCo',
            'address' => '9 Pine St, Village',
            'regist_number' => 'Reg9',
            'type_packing' => 'Type9',
            'type_commodity' => 'Lada',
            'qty_package' => 35,
            'weight' => 55.0,
            'volume' => 25.5,
            'type' => 1,
            'status' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 10',
            'userID' => 2,
            'date' => '2024-02-06',
            'sealing_mark' => 'Seal10',
            'report_sealing' => 'Report10',
            'consignment_commodity' => 'Commodity10',
            'identification' => 'ID10',
            'exporting_comp' => 'ExportCo',
            'address' => '10 Pine St, Village',
            'regist_number' => 'Reg10',
            'type_packing' => 'Type10',
            'type_commodity' => 'Lada',
            'qty_package' => 40,
            'weight' => 60.0,
            'volume' => 28.5,
            'type' => 2,
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 11',
            'userID' => 2,
            'date' => '2024-02-06',
            'sealing_mark' => 'Seal11',
            'report_sealing' => 'Report11',
            'consignment_commodity' => 'Commodity11',
            'identification' => 'ID11',
            'exporting_comp' => 'ExportCo',
            'address' => '11 Pine St, Village',
            'regist_number' => 'Reg11',
            'type_packing' => 'Type11',
            'type_commodity' => 'Lada',
            'qty_package' => 45,
            'weight' => 65.0,
            'volume' => 30.5,
            'type' => 1,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_pengajuan')->insert([
            'name' => 'User 12',
            'userID' => 2,
            'date' => '2024-02-06',
            'sealing_mark' => 'Seal12',
            'report_sealing' => 'Report12',
            'consignment_commodity' => 'Commodity12',
            'identification' => 'ID12',
            'exporting_comp' => 'ExportCo',
            'address' => '12 Pine St, Village',
            'regist_number' => 'Reg12',
            'type_packing' => 'Type12',
            'type_commodity' => 'Lada',
            'qty_package' => 50,
            'weight' => 70.0,
            'volume' => 32.5,
            'type' => 2,
            'status' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_kalibrasi')->insert([
            'name' => 'PT. A',
            'userID' => 2,
            'date' => '2024-02-06',
            'address' => '12 Pine St, Village',
            'status' => 0,
            'nama_alat' => 'Alat 1',
            'merek_alat' => 'Merek 1',
            'serial_number_alat' => '1/ALAT/2024',
            'kapasitas' => '30',
            'area_kalibrasi' => 'Kemiling',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('form_kalibrasi')->insert([
            'name' => 'PT. B',
            'userID' => 2,
            'date' => '2024-03-06',
            'address' => '13 Pine St, Village',
            'status' => 0,
            'nama_alat' => 'Alat 2',
            'merek_alat' => 'Merek 2',
            'serial_number_alat' => '2/ALAT/2024',
            'kapasitas' => '40',
            'area_kalibrasi' => 'Panjang',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('data_sertifikat')->insert([
            'kepala_dinas' => 'Syukron Kalamando',
            'nip' => '187128398123',
            'kepala_bpsmb' => 'Mr. Quin',
            'nip_bpsmb' => '21323123',
            'technical_manager' => 'Sabil Yuanalda Qurota Agustin',
            'nip_manager' => '231123',
            'no_lab' => '123-LAB',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('survey')->insert([
            'userID' => 2,
            'name' => 'Muttaqin',
            'no_handphone' => '089626613284',
            'rating' => 'cukup_memuaskan',
            'comments' => 'Pelayanan ramah',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $ratings = ['cukup_memuaskan', 'sangat_memuaskan', 'memuaskan', 'buruk'];

        for ($i = 1; $i <= 12; $i++) {
            DB::table('survey')->insert([
                'userID' => 2,
                'name' => 'User' . $i,
                'no_handphone' => '08962661' . $i . $i . $i,
                'rating' => $ratings[rand(0, count($ratings) - 1)],
                'comments' => 'Pelayanan', // Isi sesuai kebutuhan
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
