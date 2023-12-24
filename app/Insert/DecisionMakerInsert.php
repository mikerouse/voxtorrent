<?php
namespace App\Insert;

use App\Models\User;
use WireElements\Pro\Components\Insert\InsertQueryResult;
use WireElements\Pro\Components\Insert\InsertQueryResults;
use WireElements\Pro\Components\Insert\Types\InsertType;
use App\Models\DecisionMakers;
use Livewire\Component;
 
class DecisionMakerInsert extends InsertType
{
    protected string $delimiter = '@';
    protected string $match = '\w{1,20}$';

    public function search($query): InsertQueryResults
    {
        return InsertQueryResults::make(
            DecisionMakers::query()
                ->where('display_name', 'like', "%{$query}%")
                ->orderBy('display_name')
                ->get()
                ->map(function ($decisionMaker) {
                    return InsertQueryResult::make(
                        id: $decisionMaker->id,
                        headline: $decisionMaker->display_name,
                        subheadline: '@' . str($decisionMaker->constituencies[0]->name)->slug('_'),
                        photo: sprintf('https://ui-avatars.com/api/?name=%s', urlencode($decisionMaker->display_name)),
                        insert: '@' . str($decisionMaker->display_name)->slug('_'),
                        dispatch: [
                            'decisionMakerSelected' => ['id' => $decisionMaker->id]
                        ],
                    );
                }));
    }
}