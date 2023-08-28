<?php

namespace App\Http\Controllers;

use id;
use Carbon\Carbon;
use App\Models\Thana;
use App\Models\Profile;
use App\Models\District;
use App\Models\Division;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\PhotoUploadController;

class ProfileController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::pluck('name', 'id');
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('backend.modules.profile.profile', compact('divisions', 'profile'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'phone'=>'required',
            'gender'=>'required',
            'division_id'=>'required',
            'district_id'=>'required',
            'thana_id'=>'required',
         ]);
          
          $profile_data = $request->all();
          $profile_data['user_id'] = Auth::id();
          $existing_profile = Profile::where('user_id', Auth::id())->first();
          if ($existing_profile) {
            $existing_profile->update($profile_data);
          } else {
            Profile::create($profile_data);
          }
          
       return redirect()->back();
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
     /**
      * @param int $district_id
      *@return JsonResponse
      */
    public function getDistrict($division_id):JsonResponse
    {
        $districts = District::select('id', 'name')->where('division_id', $division_id)->get();
        return response()->json($districts);
    }
      /**
      * @param int $thana_id
      *@return JsonResponse
      */
    public function getThana($district_id):JsonResponse
    {
        $thanas = Thana::select('id', 'name')->where('district_id', $district_id)->get();
        return response()->json($thanas);
    }

    public function upload_photo(Request $request)
    {
       
       $file = $request->input('photo');
       $name = Str::slug(Auth::user()->name.Carbon::now());
       $height = 200;
       $width = 200;
       $path = 'image/user/';

       $profile = Profile::where('user_id', Auth::id())->first();
       if ($profile?->photo) {
         PhotoUploadController::ImageUnlink($path, $profile?->photo);
       }
       $image_name = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
       $profile_data['photo'] = $image_name;
      
       if ($profile) {
          $profile->update($profile_data);

          return response()->json([
            'msg'=>'Profile Photo Updated SuccessFully',
            'cls'=>'success',
            'photo' => url($path.$profile->photo)
          ]);
       }
       return response()->json([
        'msg'=>'Please Update Profile First',
        'cls'=>'warning'
        
      ]);
    }
}
