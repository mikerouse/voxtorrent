<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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
    
        // This is a God permission for later developments, but is currently rendered somewhat useless by the fact that the super admin can do anything anyway as defined in AuthServiceProvider.php
        Permission::create(['name' => 'do anything']);

        // Let's start with permissions for torrents
        // Everyone can view a torrent, they are public.
        // Permission::create(['name' => 'view torrent']);
        Permission::create(['name' => 'sign torrent']); // let's start with this one, it's the most important. Only someone who is registered or provides their address can sign a torrent. This includes protected users (people who wish to remain anonymous to the decision maker, but we know who they are).
        Permission::create(['name' => 'create torrent']); // Most people can create a torrent, but some people will be protected, and will not be able to create a torrent. They will be able to sign torrents, but they will not be able to create them.
        Permission::create(['name' => 'edit torrent']); // Only the creator of the torrent, or a system admin, can edit it.
        Permission::create(['name' => 'delete torrent']); // Only the creator of the torrent, or a system admin, can delete it.
        Permission::create(['name' => 'download torrent signers']); // Only the creator of the torrent, or a system admin, can download the details of those who signed it.
        Permission::create(['name' => 'view torrent signers']); // Only the creator of the torrent, or a system admin, can view the details of those who signed it.
        Permission::create(['name' => 'contact torrent signers']); // Only the creator of the torrent, or a system admin, can contact the details of those who signed it.
        Permission::create(['name' => 'access creator torrent dashboard']); // Access to a dashboard for the creator of the torrent, or a system admin.
        Permission::create(['name' => 'access decision maker torrent dashboard']); // Access to a dashboard for the decision maker, or their staff, or a system admin.

        // Now let's create some permissions for decision makers and their staff
        Permission::create(['name' => 'can manage decision maker']);

        // Now let's create some permissions for system administators
        Permission::create(['name' => 'can manager users and roles']);
        Permission::create(['name' => 'can manage constituencies']);
        Permission::create(['name' => 'can manage constituency types']);

        // Create roles
        $superAdmin = Role::create(['name' => 'super admin']); // Can do anything
        $decisionMaker = Role::create(['name' => 'decision maker']); // A policymaker, legislator or other decision maker
        $decisionMakerStaff = Role::create(['name' => 'decision maker staff']); // Staff of a decision maker
        $campaigner = Role::create(['name' => 'campaigner']); // Someone who probably wants to create many torrents
        $petitioner = Role::create(['name' => 'petitioner']); // Someone who has signed a torrent
        $constituent = Role::create(['name' => 'constituent']); // Someone who lives in the decision maker's constituency, but may not have signed the torrent yet
        $voter = Role::create(['name' => 'voter']); // Someone who is registered to vote within the decision maker's constituency, but may not have signed the torrent yet
        $partyMember = Role::create(['name' => 'party member']); // Someone who is a member of the decision maker's party, but may not have signed the torrent yet
        $constituencyChairman = Role::create(['name' => 'constituency chairman']); // Someone who is the chairman of the decision maker's constituency, but may not have signed the torrent yet
        $journalist = Role::create(['name' => 'journalist']); // Someone who is a journalist and may wish to report about the torrent, so may need to see additional information about it
        $registeredUser = Role::create(['name' => 'registered user']);  // Someone who has registered to use the site, but may not fall into any other category yet
        $identity_protected_user = Role::create(['name' => 'identity protected user']); // Someone who wishes to remain anonymous to the decision maker, but we know who they are

        // Give permissions to roles
        $superAdmin->givePermissionTo('do anything'); // This is a God permission for later developments, but is currently rendered somewhat useless by the fact that the super admin can do anything anyway as defined in AuthServiceProvider.php
        
        // Let's start with permissions for decision makers and their staff
        $decisionMaker->givePermissionTo('sign torrent'); // Decision makers can sign torrents too, even one that they are listed as the decision maker for.
        $decisionMaker->givePermissionTo('create torrent'); // A decision maker can create a torrent on behalf of someone else, or on behalf of themselves.
        $decisionMaker->givePermissionTo('edit torrent'); // A decision maker can only edit their own torrents.
        $decisionMaker->givePermissionTo('delete torrent'); // A decision maker can only delete their own torrents.
        $decisionMaker->givePermissionTo('download torrent signers'); // A decision maker can only download the details of those who signed their own torrents.
        $decisionMaker->givePermissionTo('view torrent signers'); // A decision maker can only view the details of those who signed their own torrents.
        $decisionMaker->givePermissionTo('contact torrent signers'); // A decision maker can only contact the details of those who signed their own torrents.
        $decisionMaker->givePermissionTo('access decision maker torrent dashboard'); // A decision maker can only access the dashboard for their own torrents.
        
        $decisionMakerStaff->givePermissionTo($decisionMaker->permissions);
        $decisionMakerStaff->givePermissionTo('can manage decision maker');

        // Now let's create some permissions for registered users
        $registeredUser->givePermissionTo('sign torrent'); // Once a registered user has signed a torrent, they should be added to the petitioner role in relation to that torrent.
        $registeredUser->givePermissionTo('create torrent');
        $registeredUser->givePermissionTo('edit torrent');
        $registeredUser->givePermissionTo('delete torrent');
        $registeredUser->givePermissionTo('download torrent signers');
        $registeredUser->givePermissionTo('view torrent signers');
        $registeredUser->givePermissionTo('contact torrent signers');

        // Now let's allocate permissions to each of the additional roles.
        // At this time, each role will be treated the same as any other registered user.
        // Later, we will add additional permissions to each role to suit their needs, but we don't know what they are yet.
        $campaigner->givePermissionTo($registeredUser->permissions);
        $campaigner->givePermissionTo('access creator torrent dashboard');
        $petitioner->givePermissionTo($registeredUser->permissions);
        $constituent->givePermissionTo($registeredUser->permissions);
        $voter->givePermissionTo($registeredUser->permissions);
        $partyMember->givePermissionTo($registeredUser->permissions);
        $constituencyChairman->givePermissionTo($registeredUser->permissions);
        $journalist->givePermissionTo($registeredUser->permissions);
        
        // Finally, let's deal with identity protected users.
        // They can sign torrents, but they cannot create them.
        // Their details will not be shared with the decision maker.
        $identity_protected_user->givePermissionTo('sign torrent');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
