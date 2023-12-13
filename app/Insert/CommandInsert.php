<?php 

namespace App\Insert;

use App\Models\User;
use WireElements\Pro\Components\Insert\InsertQueryResult;
use WireElements\Pro\Components\Insert\InsertQueryResults;
use WireElements\Pro\Components\Insert\Types\InsertType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommandInsert extends InsertType
{
    protected string $delimiter = '/';
    protected string $match = '\w*$';
 
    public function search($query): InsertQueryResults
    {
        return InsertQueryResults::make(
            // Create a static array with different commands
            collect([[
                [
                    'name' => 'Insert image',
                    'subheadline' => 'Choose from the image library',
 
                    // Instead of inserting a value we will dispatch the event to open a slide-over
                    'dispatch' => [
                        'slide-over.open' => ['media-library'],
                        // You can also pass properties, element attributes and behavior
                        // 'slide-over.open' => [
                            // 'some-other-slide-over', // Component
                            // ['param1' => 'x', 'param2' => 'y'] // Properties !!(this must be a key value array)!!
                            // ['size' => '6xl'], // Element attributes
                            // ['close-on-escape' => false, 'trap-focus' => true], // Element behavior
                        ],
                    ],
                ],
                [
                    'name' => 'Insert link',
                    'subheadline' => 'Add external link',
 
                    // Instead of inserting a value we will dispatch the event to open a slide-over
                    'dispatch' => [
                        'slide-over.open' => ['link'],
                    ],
                ]
            ])
            // We only 'search' if a query string is provided, if the string is empty we want to return all the commands
            // This will ensure the user can see the available commands when they only type the "/" character.
            ->unless(empty($query), fn($q) => $q->filter(fn($command) => str($command['name'])->lower()->contains($query)))
            // Finally, we map the commands into the InsertQueryResult object
            ->map(function ($command, $id) {
                return InsertQueryResult::make(
                    id: $id,
                    headline: $command['name'],
                    dispatch: $command['dispatch'],
                    subheadline: $command['subheadline'],
                );
            })
        );
    }
}