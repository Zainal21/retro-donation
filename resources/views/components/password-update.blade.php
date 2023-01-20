<form action="{{ route('password.update') }}" method="post">
    @csrf
    @method('PUT')
    <section class="nes-container with-title">
        <h3 class="title">Password Setting</h3>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="current_password">Current Password</label>
                <input type="text" id="current_password" name="current_password" class="nes-input">
                @error('current_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="password">New Password</label>
                <input type="text" id="password" name="new_password" class="nes-input">
                @error('new_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="text" id="confirm_password" name="confirm_new_password" class="nes-input">
                @error('confirm_new_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="nes-btn is-primary">Saves Change</button>
    </section>
</form>
