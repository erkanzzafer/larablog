<div>
    <form method="POST" wire:submit.prevent='changePassword()'>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="example-text-input" placeholder="Current Password" wire:model='current_password'>
                    <span class="text-danger">@error('current_password'){{$message}}@enderror</span>
                  </div>

            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" name="example-text-input" placeholder="New Password" wire:model='new_password'>
                    <span class="text-danger">@error('new_password'){{$message}}@enderror</span>
                  </div>

            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="example-text-input" placeholder="Confirm New Password" wire:model='confirm_password'>
                    <span class="text-danger">@error('confirm_password'){{$message}}@enderror</span>
                  </div>

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Change</button>
    </form>
</div>
