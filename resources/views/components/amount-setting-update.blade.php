<section class="nes-container with-title">
    <h3 class="title">Ammount Setting</h3>
    <form action="{{ route('amount-setting.update') }}" method="post">
        @csrf
        @method('PUT')
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="amount_option_1">Amount Option 1</label>
                <input type="text" id="amount_option_1" name="amount_1" class="nes-input money-mask" value="{{$user->amount_setting->amount_1}}">
                @error('amount_1')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="amount_option_2">Amount Option 2</label>
                <input type="text" id="amount_option_2" name="amount_2" class="nes-input money-mask" value="{{$user->amount_setting->amount_2}}">
                @error('amount_2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="amount_option_3">Amount Option 3</label>
                <input type="text" id="amount_option_3" name="amount_3" class="nes-input money-mask" value="{{$user->amount_setting->amount_3}}">
                @error('amount_3')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="nes-btn is-primary">Saves Change</button>
    </form>
</section>