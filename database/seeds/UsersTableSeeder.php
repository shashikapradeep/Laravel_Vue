<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $sFilePath = base_path('storage/Admin/onboarding/onboarding_data_2018_02_25.csv');
        $aFileData = \App\Helpers\FileReader::simpleCsv($sFilePath);

        $aUserTableRecords = [];
        foreach ($aFileData as $aRow) {
            if (!is_numeric($aRow['user_id'])) {
                continue;
            }
            $aUserTableRecords[] = [
                'user_id' => intval($aRow['user_id']),
                'created_at' => $aRow['created_at'],
                'onboarding_percentage' => intval($aRow['onboarding_percentage']),
                'count_applications' => intval($aRow['count_applications']),
                'accepted_applications' => intval($aRow['count_accepted_applications'])
            ];
        }

        \App\User::insert($aUserTableRecords);
    }
}
