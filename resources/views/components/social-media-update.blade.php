<section class="nes-container with-title">
    <h3 class="title">Social Media</h3>
    <form action="{{ route('social-media.update') }}" method="post">
        @csrf
        @method('PUT')
        <div id="inputs" class="item">
            <div class="nes-field form-group form-group">
                <label for="instagram">Instagram.com/</label>
                <input type="text" id="instagram" name="instagram" class="nes-input"
                    value="{{ $user->social_media->instagram }}">
                @error('instagram')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="facebook">facebook.com/</label>
                <input type="text" id="facebook" name="facebook" class="nes-input"
                    value="{{ $user->social_media->facebook }}">
                @error('facebook')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="twitter">twitter.com/</label>
                <input type="text" id="twitter" name="twitter" class="nes-input"
                    value="{{ $user->social_media->twitter }}">
                @error('twitter')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="youtube">youtube.com/</label>
                <input type="text" id="youtube" name="youtube" class="nes-input"
                    value="{{ $user->social_media->youtube }}">
                @error('youtube')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="nes-btn is-primary">Saves Change</button>
    </form>
</section>