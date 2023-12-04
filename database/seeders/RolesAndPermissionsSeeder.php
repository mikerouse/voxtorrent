<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        // A torrent is a petition to the decision maker, which includes multiple signatures and a request for action or policy change.
        // Torrents are created by those seeking change, they are signed by those who agree, and then they are sent to the decision makers.
        // The decision makers can then choose to respond to the torrent, or ignore it.
        // The decision maker's staff can also respond to the torrent on their behalf.
        // The decision maker's staff can also create torrents on behalf of the decision maker.
        // The decision maker's staff can also sign torrents on behalf of the decision maker.
        // The decision maker's staff can also edit torrents on behalf of the decision maker.
        // Campaigners can create torrents.
        // Campaigners can sign torrents.
        // Campaigners can edit torrents.
        // Campaigners can delete torrents.
        // Campaigners can download the details of those who signed torrents.
        // Signers can be constituents, or they can be located anywhere in the country.
        // Signers can be registered to vote, or not registered to vote..
        // Decision makers have the right to only receive emails from constituents. Additional signers who are not constituents will be held back until the decision maker decides to receive them, or goes online to view them.
        // Decision makers can choose to receive torrents from anyone, or only from constituents.
        // Constituents can see how many people have signed a torrent, but they cannot see who has signed it. The can opt to see signatures by fellow constituents only.
        // Journalists can see how many people have signed a torrent, but they cannot see who has signed it. They can see a post code distribution of the signers.
        // Any registered user with a valid account can create a new torrent. 
        // Anonymous users can see how many people have signed a torrent, but they cannot see who has signed it. They can see a post code distribution of the signers.
        // Anonymous users can sign a torrent, but they must provide a valid email address and a postal address. This will not be shared with the decision maker. They will be told 'valid address supplied'.
        // 
    
        Permission::create(['name' => 'do anything']);
        Permission::create(['name' => 'view torrent']);
        Permission::create(['name' => 'download own torrent signers']);
        Permission::create(['name' => 'download a given torrent signers']);
        Permission::create(['name' => 'view own torrent signers']);
        Permission::create(['name' => 'view a given torrent signers']);
        Permission::create(['name' => 'contact own torrent signers']);
        Permission::create(['name' => 'contact a given torrent signers']);
        Permission::create(['name' => 'create torrent']);
        Permission::create(['name' => 'sign torrent']);
        Permission::create(['name' => 'edit own torrent']);
        Permission::create(['name' => 'delete own torrent']);
        Permission::create(['name' => 'can view torrent signers']);
        Permission::create(['name' => 'can manager users and roles']);
        Permission::create(['name' => 'can manage constituencies']);
        Permission::create(['name' => 'can manage constituency types']);
        Permission::create(['name' => 'can manage all decision makers']);
        Permission::create(['name' => 'can manage own decision maker profile']);
        Permission::create(['name' => 'can manage own decision maker staff']);

        // Create roles and assign existing permissions
        $superAdmin = Role::create(['name' => 'super admin']);
        $decisionMaker = Role::create(['name' => 'decision maker']);
        $decisionMakerStaff = Role::create(['name' => 'decision maker staff']);
        $campaigner = Role::create(['name' => 'campaigner']);
        $petitioner = Role::create(['name' => 'petitioner']);
        $constituent = Role::create(['name' => 'constituent']);
        $voter = Role::create(['name' => 'voter']);
        $partyMember = Role::create(['name' => 'party member']);
        $constituencyChairman = Role::create(['name' => 'constituency chairman']);
        $journalist = Role::create(['name' => 'journalist']);
        $registeredUser = Role::create(['name' => 'registered user']);
        $anonymous = Role::create(['name' => 'anonymous']);

        $superAdmin->givePermissionTo('do anything');
        
        $decisionMaker->givePermissionTo('download torrent signers');
        $decisionMaker->givePermissionTo('contact torrent signers');
        $decisionMaker->givePermissionTo('can view torrent signers');
        $decisionMaker->givePermissionTo('create torrent');
        $decisionMaker->givePermissionTo('sign torrent');
        $decisionMaker->givePermissionTo('edit own torrent');
        $decisionMaker->givePermissionTo('delete own torrent');
        
        $decisionMakerStaff->givePermissionTo($decisionMaker->permissions);

        $registeredUser->givePermissionTo('view torrent');
        $registeredUser->givePermissionTo('create torrent');
        $registeredUser->givePermissionTo('sign torrent');
        $registeredUser->givePermissionTo('edit own torrent');
        $registeredUser->givePermissionTo('delete own torrent');
        $registeredUser->givePermissionTo('download own torrent signers');
        $registeredUser->givePermissionTo('view own torrent signers');

        $campaigner->givePermissionTo($registeredUser->permissions);
        $petitioner->givePermissionTo($registeredUser->permissions);
        $constituent->givePermissionTo($registeredUser->permissions);
        $voter->givePermissionTo($registeredUser->permissions);
        $partyMember->givePermissionTo($registeredUser->permissions);
        $constituencyChairman->givePermissionTo($registeredUser->permissions);
        $journalist->givePermissionTo($registeredUser->permissions);
        
        $anonymous->givePermissionTo('view torrent');
        $anonymous->givePermissionTo('sign torrent');
    }
}