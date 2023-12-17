<?php
namespace App\Insert;

use App\Models\User;
use WireElements\Pro\Components\Insert\InsertQueryResult;
use WireElements\Pro\Components\Insert\InsertQueryResults;
use WireElements\Pro\Components\Insert\Types\InsertType;
use App\Models\Geography\City;
use Livewire\Component;
 
class TownCityInsert extends InsertType
{
    protected string $delimiter = '';
    protected string $match = '\w{1,20}$';

    public function search($query): InsertQueryResults
    {
        return InsertQueryResults::make(
            City::query()
                ->where('name', 'like', "%{$query}%")
                ->orderBy('name')
                ->get()
                ->map(function ($city) {
                    return InsertQueryResult::make(
                        id: $city->id,
                        headline: $city->name,
                        subheadline: 'location: ' . str($city->name)->slug('_'),
                        photo: sprintf('https://ui-avatars.com/api/?name=%s', urlencode($city->name)),
                        insert: str($city->name)->slug('_'),
                    );
                }));
    }
}