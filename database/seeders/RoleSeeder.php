<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Campaigner',
            'Petitioner',
            'Constituent',
            'Voter',
            'Party Member',
            'Constituency Chairman',
            'Member of Parliament (Commons)',
            'Member of Parliament (Lords)',
            'Government Minister',
            'County Councillor',
            'District-level Councillor',
            'Parish Councillor',
            'Unitary Authority Councillor',
            'London Assembly Member',
            'Welsh Assembly Member',
            'Scottish Parliament Member',
            'Mayor',
            'Police & Crime Commissioner',
            'Journalist',
            'Blogger',
            'Policymaker',
            'Policy Researcher',
            'Caseworker',
            'Office Manager',
            'Chief of Staff',
            'Correspondence Manager',
            'Correspondence Viewer',
            'Candidate',
            'Legal Representative',
            'Police Investigator',
            'Complaints Investigator',
            'System Administrator',
            'Intern',
            'Developer',
            'API User',
            'Data Analyst',
            'Data Engineer',
            'Data Protection Officer',
            'Data Controller',
            'Data Processor',
            'Public Relations Officer',
            'Policy Advisor',
            'Executive Assistant',
            'Fundraiser',
            'Volunteer Coordinator',
            'Event Coordinator',
            'Campaign Manager',
            'Lobbyist',
            'Activist',
            'Diplomat',
            'Economic Advisor',
            'Social Media Manager',
            'Graphic Designer',
            'Research Assistant',
            'Human Resources Manager',
            'Legal Advisor',
            'Press Secretary',
            'Spokesperson',
            'Electoral Officer',
            'Public Affairs Consultant',
            'Community Organizer',
            'Outreach Coordinator',
            'Digital Marketing Specialist',
            'IT Support Technician',
            'User Experience Designer',
            'Web Developer',
            'Grant Writer',
            'Nonprofit Director',
            'Election Monitor',
            'Legislative Assistant',
            'Public Policy Analyst',
            'Risk Analyst',
            'Urban Planner',
        ];        
    
        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName]);
        }
    }
}