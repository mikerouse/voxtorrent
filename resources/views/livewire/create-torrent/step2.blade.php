<div>
    <h1>Step 2: What do you want to ask the decision-maker to do?</h1>
    <form wire:submit.prevent="$emit('incrementStep')">
        <div>
            <label for="request">Request</label>
            <input type="text" id="request" wire:model="request" required>
        </div>
        <button type="submit">Next</button>
    </form>
</div>