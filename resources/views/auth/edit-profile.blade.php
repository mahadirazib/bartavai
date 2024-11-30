@extends('layouts.app')

@section('content')
  <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
    <x-form :action="route('profile.update')" >
      <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
          <h2 class="text-xl font-semibold leading-7 text-gray-900">Edit Profile</h2>
          <p class="mt-1 text-sm leading-6 text-gray-600">
            This information will be displayed publicly, so be careful what you share.
          </p>

          <div class="mt-10 border-b border-gray-900/10 pb-12">
            <div class="grid grid-cols- gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <x-input name="fname" type="text" label="First name" value="{{ auth()->user()->fname }}" required />
              </div>
              <div class="sm:col-span-3">
                <x-input name="lname" type="text" label="Last name" value="{{ auth()->user()->lname }}" required />
              </div>
              <div class="col-span-full">
                <x-input name="email" type="email" label="Email Address" value="{{ auth()->user()->email }}" required />
              </div>
              <div class="col-span-full">
                <x-input name="phone" type="text" label="Phone Number" value="{{ auth()->user()->phone }}" />
              </div>
            </div>
          </div>
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-full">
              <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
              <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
              <div class="mt-2">
                <textarea id="bio" name="bio" rows="3"
                  class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">{{ auth()->user()->bio }}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
        <button type="submit"
          class="rounded-md bg-black px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 
          focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
          Save
        </button>
      </div>
    </x-form>
  </main>
@endsection