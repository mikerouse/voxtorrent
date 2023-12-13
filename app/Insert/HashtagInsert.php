<?php
namespace App\Insert;

use App\Models\User;
use App\Models\Hashtags;
use WireElements\Pro\Components\Insert\InsertQueryResult;
use WireElements\Pro\Components\Insert\InsertQueryResults;
use WireElements\Pro\Components\Insert\Types\InsertType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
 
class HashtagInsert extends InsertType
{
    protected string $delimiter = '#';
    protected string $match = '\w{1,20}$';

    public function search($query): InsertQueryResults
    {
        return InsertQueryResults::make(
            Hashtags::query()
                ->where('name', 'like', "%{$query}%")
                ->orderBy('name')
                ->get()
                ->map(function ($user) {
                    return InsertQueryResult::make(
                        id: $user->id,
                        headline: $user->name,
                        subheadline: '#' . str($user->name)->slug('_'),
                        insert: '#' . str($user->name)->slug('_'),
                    );
                }));
    }
}