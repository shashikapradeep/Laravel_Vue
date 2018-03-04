<?php

namespace App\Repositories;


use App\Helpers\FileReader;
use App\User as UserModel;

/**This class is for application performance checking.
 * Class AppPerformance
 * @package App\Repositories
 */
class AppPerformance
{

    /**
     * this return onboard data
     * @return array
     */
    public function getOnboardData()
    {
        //if new step is introduced it should come here. best practice is to put this in config file.
        $aMilestoneSteps = [100 => 'Approval', 99 => 'Waiting for approval', 90 => 'Are you freelancer', 70 => 'Relevant experience', 50 => 'Interested jobs', 40 => 'Profile information', 20 => 'Activate account', 0 => 'Create account'];
        $aMilestones = array_keys($aMilestoneSteps);

        $aOnboardingData = UserModel::whereIn('onboarding_percentage', $aMilestones)->get();

        $aWeeksCount = [];
        foreach ($aOnboardingData as $iIndex => $aRow) {
            $oDate = new \DateTime($aRow['created_at']);
            $iWeek = $oDate->format("W");

            $aWeekRecords[$iWeek][] = $aRow;

            $iPercentage = $aRow['onboarding_percentage'];
            $aRelevantMilestones = array_slice($aMilestones, array_search($iPercentage, $aMilestones));
            foreach ($aRelevantMilestones as $iMilestone) {
                $aWeeksCount[$iWeek][$iMilestone] = isset($aWeeksCount[$iWeek][$iMilestone]) ? ++$aWeeksCount[$iWeek][$iMilestone] : 1;
            }

            ksort($aWeeksCount[$iWeek]);
        }

        $aGraphData = [];
        foreach ($aWeeksCount as $iWeekNumber => $aStages) {
            $iTotalUsers = $aStages['0'];

            $aSeries = [];

            $aSeriesData = [];
            foreach ($aStages as $iPercentage => $iCount) {
                $aSeriesData[] = [$aMilestoneSteps[$iPercentage], intval(($iCount / $iTotalUsers) * 100)];
            }

            $aSeries['name'] = $iWeekNumber.' week';
            $aSeries['data'] = $aSeriesData;

            $aGraphData[] = $aSeries;
        }

        return ['weekly_counts' => $aWeeksCount, 'graph_data' => $aGraphData];
    }
}