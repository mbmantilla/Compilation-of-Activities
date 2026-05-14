<!DOCTYPE html>
<html>
<head>
    <title>Mobile Legends Player Role Preference Form</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: radial-gradient(circle at top, #0f172a, #020617);
            font-family: 'Orbitron', sans-serif;
            color: #fff;
        }

        .game-card {
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid #3b82f6;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(59,130,246,0.6);
            backdrop-filter: blur(10px);
        }

        .title {
            color: #38bdf8;
            text-shadow: 0 0 10px #38bdf8;
        }

        label {
            color: #cbd5f5;
            font-weight: 500;
        }

        .form-control {
            background: #020617;
            border: 1px solid #3b82f6;
            color: #fff;
        }

        .form-control:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 10px #38bdf8;
        }

        .form-check-input:checked {
            background-color: #38bdf8;
            border-color: #38bdf8;
        }

        .btn-submit {
            background: linear-gradient(90deg, #2563eb, #38bdf8);
            border: none;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            box-shadow: 0 0 15px #38bdf8;
        }

        .alert-success {
            background: #022c22;
            color: #4ade80;
        }

        .alert-danger {
            background: #450a0a;
            color: #f87171;
        }

        small {
            color: #facc15;
        }

        .subtitle {
            color: #22d3ee; /* bright cyan */
            text-shadow: 0 0 8px #22d3ee, 0 0 15px #38bdf8;
            font-weight: 600;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <div class="card game-card p-4">

        <h2 class="text-center mb-2 title">🎮 ML Player Role Preference</h2>
        <p class="text-center mb-4 subtitle">
            Enter the Land of Dawn and define your playstyle!
        </p>

        <!-- SUCCESS -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- ERRORS -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/ml-form">
            @csrf

            <!-- PLAYER NAME -->
            <div class="mb-3">
                <label>Player Name</label>
                <input type="text" name="player_name" class="form-control"
                       value="{{ old('player_name') }}">
                @error('player_name')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}">
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- FAVORITE HERO -->
            <div class="mb-3">
                <label>Favorite Hero</label>
                <input type="text" name="favorite_hero" class="form-control"
                       value="{{ old('favorite_hero') }}">
                @error('favorite_hero')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- AGE -->
            <div class="mb-3">
                <label>Age</label>
                <input type="number" name="age" class="form-control"
                       value="{{ old('age') }}">
                @error('age')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- ROLES -->
            <div class="mb-3">
                <label>Select Your Roles</label>

                @php
                    $roles = ['Tank','Fighter','Mage','Marksman','Assassin','Support'];
                @endphp

                @foreach($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]"
                            value="{{ $role }}"
                            class="form-check-input"
                            {{ (is_array(old('roles')) && in_array($role, old('roles'))) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $role }}</label>
                    </div>
                @endforeach

                @error('roles')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- RANK -->
            <div class="mb-3">
                <label>Current Rank</label>
                <select name="rank" class="form-control">
                    <option value="">-- Select Rank --</option>
                    <option value="Warrior" {{ old('rank')=='Warrior'?'selected':'' }}>Warrior</option>
                    <option value="Elite" {{ old('rank')=='Elite'?'selected':'' }}>Elite</option>
                    <option value="Master" {{ old('rank')=='Master'?'selected':'' }}>Master</option>
                    <option value="Grandmaster" {{ old('rank')=='Grandmaster'?'selected':'' }}>Grandmaster</option>
                    <option value="Epic" {{ old('rank')=='Epic'?'selected':'' }}>Epic</option>
                    <option value="Legend" {{ old('rank')=='Legend'?'selected':'' }}>Legend</option>
                    <option value="Mythic" {{ old('rank')=='Mythic'?'selected':'' }}>Mythic</option>
                    <option value="Mythical Honor" {{ old('rank')=='Mythical Honor'?'selected':'' }}>Mythical Honor</option>
                    <option value="Mythical Glory" {{ old('rank')=='Mythical Glory'?'selected':'' }}>Mythical Glory</option>
                    <option value="Mythical Immortal" {{ old('rank')=='Mythical Immortal'?'selected':'' }}>Mythical Immortal</option>
                </select>
                @error('rank')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- PLAYSTYLE -->
            <div class="mb-3">
                <label>Describe Your Playstyle</label>
                <textarea name="play_style" class="form-control">{{ old('play_style') }}</textarea>
                @error('play_style')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit w-100 mt-3">
                🚀 Submit & Enter Battle
            </button>

        </form>
    </div>
</div>

</body>
</html>