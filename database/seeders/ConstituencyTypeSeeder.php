<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConstituencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $constituencyTypes = [
            [
                'name' => 'UK Parliamentary Constituency',
                'acronym' => 'UKHOC',
            ],
            [
                'name' => 'County Council',
                'acronym' => 'CC',
            ],
            [
                'name' => 'County Council Division',
                'acronym' => 'CCD',
            ],
            [
                'name' => 'District Council',
                'acronym' => 'DC',
            ],
            [
                'name' => 'District Council Ward',
                'acronym' => 'DCW',
            ],
            [
                'name' => 'London Assembly Constituency',
                'acronym' => 'LAC',
            ],
            [
                'name' => 'Parish Council',
                'acronym' => 'PC',
            ],
            [
                'name' => 'Parish Council Ward',
                'acronym' => 'PCW',
            ],
            [   
                'name' => 'Scottish Parliament Constituency',
                'acronym' => 'SPC',
            ],
            [   
                'name' => 'Scottish Parliament Region',
                'acronym' => 'SPR',
            ],
            [   
                'name' => 'Unitary Authority',
                'acronym' => 'UA',
            ],
            [   
                'name' => 'Unitary Authority Division',
                'acronym' => 'UAD',
            ],
            [   
                'name' => 'Welsh Assembly Constituency',
                'acronym' => 'WAC',
            ],
            [   
                'name' => 'Welsh Assembly Region',
                'acronym' => 'WAR',
            ],
            [
                'name' => 'European Parliament Constituency',
                'acronym' => 'EPC',
            ],
            [   
                'name' => 'Police & Crime Commissioner',
                'acronym' => 'PCC',
            ],
            [
                'name' => 'Mayor',
                'acronym' => 'MAY',
            ],
            [
                'name' => 'London Borough Council',
                'acronym' => 'LBC',
            ],
            [
                'name' => 'London Borough Council Ward',    
                'acronym' => 'LBCW',
            ],
            [   
                'name' => 'Greater London Authority',
                'acronym' => 'GLA',
            ],
            [   
                'name' => 'Greater London Authority Constituency',
                'acronym' => 'GLAC',
            ],
            [   
                'name' => 'Greater London Authority Region',
                'acronym' => 'GLAR',
            ],
            [
                'name' => 'Combined Authority',
                'acronym' => 'CA',
            ],
            [   
                'name' => 'Combined Authority Constituency',
                'acronym' => 'CAC',
            ],
            [
                'name' => 'Combined Authority Region',
                'acronym' => 'CAR',
            ],
            [
                'name' => 'Combined Authority Mayoralty',
                'acronym' => 'CAM',
            ],
            [
                'name' => 'Student Union',
                'acronym' => 'SU',
            ],
            [
                'name' => 'Student Union Constituency',
                'acronym' => 'SUC',
            ],
            [
                'name' => 'School Council',
                'acronym' => 'SC',
            ],
            [
                'name' => 'UK Youth Parliament',
                'acronym' => 'UKYP',
            ],
            [
                'name' => 'UK Youth Parliament Constituency',
                'acronym' => 'UKYPC',
            ],
            [
                'name' => 'Political Party',
                'acronym' => 'PP',
            ],
            [
                'name' => 'Political Party Region',
                'acronym' => 'PPR',
            ],
            [
                'name' => 'Political Party Constituency',
                'acronym' => 'PPC',
            ],
            [
                'name' => 'Political Party Branch', 
                'acronym' => 'PPB',
            ],
            [
                'name' => 'Political Party Area',
                'acronym' => 'PPA',
            ],
            [
                'name' => 'Private Membership Club',
                'acronym' => 'PMC',
            ],
            [
                'name' => 'Private Company',
                'acronym' => 'PCO',
            ],
            [  
                'name' => 'Charity',
                'acronym' => 'CHA',
            ],
            [
                'name' => 'Trade Union',
                'acronym' => 'TU',
            ],
            [
                'name' => 'Trade Union Branch',
                'acronym' => 'TUB',
            ],
            [
                'name' => 'School Governing Body',
                'acronym' => 'SGB',
            ],
            [
                'name' => 'Newspaper Coverage Area',
                'acronym' => 'NCA',
            ],
            [
                'name' => 'Newspaper Readership',
                'acronym' => 'NR',
            ],
            [
                'name' => 'Media Outlet',
                'acronym' => 'MO',
            ],
            [
                'name' => 'Public Body',
                'acronym' => 'PB',
            ],
            [
                'name' => 'Government Department',
                'acronym' => 'GD',
            ],
            [
                'name' => 'Government Agency',
                'acronym' => 'GA',
            ],
            [
                'name' => 'Government Quango',
                'acronym' => 'GQ',
            ],
            [
                'name' => 'Website',
                'acronym' => 'WEB',
            ],
            [
                'name' => 'Social Media Platform',
                'acronym' => 'SMP',
            ],
            [
                'name' => 'Smartphone App',
                'acronym' => 'SA',
            ],
            [
                'name' => 'Political Party Group',
                'acronym' => 'PPG',
            ],
            [
                'name' => 'Training',
                'acronym' => 'TRAIN',
            ],
            [
                'name' => 'Testing',
                'acronym' => 'TEST',
            ]
        ];

        foreach ($constituencyTypes as $constituencyType) {
            \App\Models\ConstituencyType::create($constituencyType);
        }
    }
}
