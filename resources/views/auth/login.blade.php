<x-guest-layout>
    <style>
        /* Reset background bawaan Breeze biar jadi dark theme kelas atas */
        body, .min-h-screen {
            background-color: #121318 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Hilangkan card default putih bawaan Breeze */
        .min-h-screen > div:nth-child(2) {
            background-color: transparent !important;
            box-shadow: none !important;
            padding: 0 !important;
            width: auto !important;
            max-width: none !important;
        }

        /* CONTAINER UTAMA (Split Screen 1000px x 620px) */
        .login-wrapper {
            width: 1000px;
            height: 620px;
            background-color: #181920;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.03);
            display: flex;
        }

        /* SISI KIRI: Form Input */
        .form-section {
            width: 50%;
            height: 100%;
            padding: 50px 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .app-logo {
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 2px;
            color: #ffffff;
            text-transform: uppercase;
        }
        .app-logo span { color: #0084ff; }

        .form-title {
            color: #ffffff;
            font-size: 32px;
            font-weight: 700;
            margin-top: 20px;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }
        .form-subtitle {
            color: #6c727f;
            font-size: 13.5px;
            margin-bottom: 35px;
        }

        /* Override Desain Input Component Breeze */
        .input-block-custom {
            margin-bottom: 22px;
        }
        .input-block-custom label {
            display: block;
            color: #6c727f !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .input-block-custom input {
            width: 100% !important;
            background-color: #20222c !important;
            border: 1px solid #2e313e !important;
            border-radius: 8px !important;
            height: 46px !important;
            padding: 0 16px !important;
            color: #ffffff !important;
            font-size: 14px !important;
            box-shadow: none !important;
            transition: all 0.2s ease !important;
        }
        .input-block-custom input:focus {
            border-color: #0084ff !important;
            box-shadow: 0 0 0 4px rgba(0, 132, 255, 0.15) !important;
        }

        /* Checkbox & Forgot Link */
        .remember-text { color: #6c727f !important; font-size: 13px; }
        .forgot-link { color: #6c727f !important; font-size: 13px; text-decoration: none; transition: 0.2s; }
        .forgot-link:hover { color: #0084ff !important; }

        /* Tombol Utama Bulat Sesuai Gambar Referensi */
        .btn-login-premium {
            background-color: #0084ff !important;
            color: #ffffff !important;
            border: none !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            width: 100%;
            height: 46px;
            border-radius: 25px !important; /* Bentuk oval elips kelas atas */
            box-shadow: 0 4px 15px rgba(0, 132, 255, 0.25);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .btn-login-premium:hover { background-color: #0070d6 !important; }

        /* SISI KANAN: Kustom Gambar Latar Belakang */
        .image-section {
            width: 50%;
            height: 100%;
            /* Ntar kamu tinggal upload foto apa aja, ganti namanya jadi background-login.jpg taro di public/images/ */
            background-image: linear-gradient(to right, #181920, rgba(24, 25, 32, 0.2)), url('/images/background-login.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .watermark-logo {
            position: absolute;
            bottom: 40px;
            right: 40px;
            color: rgba(255, 255, 255, 0.3);
            font-weight: 800;
            font-size: 20px;
            letter-spacing: 1px;
        }
    </style>

    <div class="login-wrapper">

        <div class="form-section">
            <div class="app-logo">TEFA INVENTORY<span>.</span></div>

            <div>
                <h1 class="form-title">Masuk akun baru<span>.</span></h1>
                <div class="form-subtitle">Sistem Informasi Pengelolaan Lab Praktik</div>

                <x-auth-session-status class="mb-4 text-sm text-red-500" :status="session('status')" />
                <x-input-error :messages="$errors->get('email')" class="mb-3 text-sm text-red-400 list-none p-0" />
                <x-input-error :messages="$errors->get('password')" class="mb-3 text-sm text-red-400 list-none p-0" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-block-custom">
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@domain.com" />
                    </div>

                    <div class="input-block-custom">
                        <div class="d-flex justify-content-between align-items-center">
                            <x-input-label for="password" :value="__('Password')" />
                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>
                        <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <label for="remember_me" class="inline-flex items-center" style="cursor: pointer;">
                            <input id="remember_me" type="checkbox" class="border-gray-700 bg-gray-900 text-blue-600 focus:ring-0" style="border-radius: 3px;" name="remember">
                            <span class="ms-2 remember-text">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <button type="submit" class="btn-login-premium">
                        {{ __('Log in') }}
                    </button>
                </form>
            </div>

            <div class="text-muted" style="font-size: 11px;">&copy; {{ date('Y') }} TEFA Technopark. All rights reserved.</div>
        </div>

        <div class="image-section d-none d-md-block">
            <div class="watermark-logo">.TF</div>
        </div>

    </div>
</x-guest-layout>
