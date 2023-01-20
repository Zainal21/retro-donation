<section class="nes-container with-title">
    <h3 class="title">Profile</h3>
    <section class="nes-container is-dark ">
        <div class="avatar"><img data-src="https://github.com/BcRikko.png?size=80" alt="Core Member B.C.Rikko"
                class="" src="https://github.com/BcRikko.png?size=80"></div>
        <div class="profile">
            <h4 class="name">{{ $user->name }}</h4>
            <p>{{isset($user->profession) ? $user->profession : '-'}}</p>
        </div>
    </section>
    <form action="{{ route('profile.update') }}" method="post">
        @csrf
        @method('PUT')
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="nes-input" value="{{ $user->username }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="nes-input" value="{{ $user->name }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="name">Profession</label>
                <input type="text" id="profession" name="profession" class="nes-input" value="{{ $user->profession}}">
                @error('profession')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="nes-input" value="{{ $user->email }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="inputs" class="item">
            <div class="nes-field form-group">
                <label for="message">Tagline</label>
                <textarea id="message" name="tagline" class="nes-textarea">
                {{ $user->tagline }}
            </textarea>
                @error('tagline')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="nes-btn is-primary">Saves Change</button>
        <button type="button" class="nes-btn is-dark">Back</button>
    </form>
</section>
