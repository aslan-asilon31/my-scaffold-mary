<div>
  <!-- component -->
  <div class="bg-sky-100 flex justify-center items-center h-screen">
    <!-- Left: Image -->
    <div class="w-1/2 h-screen hidden lg:block">
    <img src="{{ asset('frontend/assets/img/office-building.png') }}" alt="KBN Image" class="object-cover w-full h-full">
    </div>
    <!-- Right: Login Form -->
    <div class= "lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
      <div class="mt-12 flex flex-col items-center">
        <img class="w-32 my-8" src="{{ asset('frontend/assets/img/logo.png') }}" alt="" srcset="">
        <h1 class="text-2xl xl:text-3xl font-extrabold">
          Login
        </h1>

        <div class="w-full flex-1 mt-8">
          <div class="mx-auto max-auto">
            <x-form wire:submit="login">
              <x-input wire:model="loginForm.username" label="Username" placeholder="Username" icon-right="o-user"
                right />
              <x-password wire:model="loginForm.password" label="Password" placeholder="Password"
                password-icon="o-lock-closed" password-visible-icon="o-lock-open" right />

              <x-button type="submit" spinner="login" class="bg-blue-700 hover:bg-blue-400 text-white btn-block">
                Login
              </x-button>
              <x-errors class="text-white" />
            </x-form>

          </div>
        </div>
      </div>
  
    </div>
  </div>
</div>
