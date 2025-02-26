<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Models\Cooperator;
use App\Mail\Websitemail;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            // Retrieve cooperator based on email
            $cooperator = Cooperator::where('email', $request->email)->first();

            // Check if cooperator exists and password matches
            if (!$cooperator || !Hash::check($request->password, $cooperator->password)) {
                return ResponseHelper::success(
                    message: 'Invalid credentials, please try again.',
                    statusCode: 400
                );
            }

            // Generate a Sanctum token
            $token = $cooperator->createToken('my api token')->plainTextToken;

            $authUser = [
                'user' => $cooperator,
                'token' => $token
            ];

            return ResponseHelper::Success(
                message: 'Login Successfully',
                data: $authUser,
                statusCode: 200
            );

        } catch (Exception $e) {
            \Log::error('Unable to login: ' . $e->getMessage());
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 400
            );
        }
    }

    public function logout()
    {
        try {
            // Get the currently authenticated user
            $cooperator = Auth::guard('sanctum')->user();

            if ($cooperator) {
                // Revoke all tokens for the user
                $cooperator->tokens()->delete();

                return ResponseHelper::Success(
                    message: 'Successfully logged out',
                    statusCode: 200
                );
            }

            return ResponseHelper::Error(
                message: 'No user is currently logged in.',
                statusCode: 400
            );

        } catch (Exception $e) {
            \Log::error('Unable to logout: ' . $e->getMessage());
            return ResponseHelper::Error(
                message: 'An error occurred while logging out.',
                statusCode: 500
            );
        }
    }

    public function loadedUsers()
    {
        try {
            // Get the currently authenticated user
            $cooperator = Auth::guard('sanctum')->user()->load([
                'rule',
                'destination',
                'accommodation',
                'driver',
                'tourguide'
            ]);


            if ($cooperator) {
                return ResponseHelper::Success(
                    message: 'User loaded successfully',
                    data: $cooperator, // or return specific user details if necessary
                    statusCode: 200
                );
            }

            return ResponseHelper::Error(
                message: 'No user is currently authenticated.',
                statusCode: 401
            );

        } catch (Exception $e) {
            \Log::error('Unable to load user: ' . $e->getMessage());
            return ResponseHelper::Error(
                message: 'An error occurred while loading user data.',
                statusCode: 500
            );
        }
    }

    public function forget_password(ForgetPasswordRequest $request)
    {
        try {
            // Retrieve cooperator based on email
            $cooperator = Cooperator::where('email', $request->email)->first();

            // Check if the cooperator exists
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Email not found.',
                    statusCode: 404
                );
            }

            // Generate a unique token
            $token = hash('sha256', time());
            $cooperator->token = $token; // Assuming you have a 'token' field in your Cooperator model
            $cooperator->save(); // Save the token to the database

            // Create a reset link
            $frontendUrl = env('FRONTEND_URL', 'http://localhost:3000');
            $reset_link = $frontendUrl . '/reset-password?email=' . $request->email . '&token=' . $token;


            // Prepare email content
            $subject = "Password Reset Request";
            $message = "To reset your password, please click on the link below:<br>";
            $message .= "<a href='" . $reset_link . "'>Reset Password</a>";

            // Send email
            \Mail::to($request->email)->send(new Websitemail($subject, $message));

            return ResponseHelper::Success(
                message: 'Password reset link has been sent to your email. Please check your inbox or spam folder.',
                statusCode: 200
            );

        } catch (Exception $e) {
            \Log::error('Unable to send password reset link: ' . $e->getMessage());
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function reset_password(ResetPasswordRequest $request)
    {
        try {
            // Retrieve the cooperator based on email and token
            $cooperator = Cooperator::where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            // Check if cooperator exists and the token matches
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Invalid or expired token.',
                    statusCode: 400
                );
            }

            // Update the password and clear the token
            $cooperator->password = Hash::make($request->password);
            $cooperator->token = null; // Clear the token to prevent reuse
            $cooperator->save();

            return ResponseHelper::Success(
                message: 'Password reset successfully.',
                statusCode: 200
            );

        } catch (Exception $e) {
            \Log::error('Unable to reset password: ' . $e->getMessage());
            return ResponseHelper::Error(
                message: 'An error occurred while resetting the password.',
                statusCode: 500
            );
        }
    }

    public function update(Request $request)
    {
        try {
            $cooperator = auth()->user();

            // Check if the user is authenticated
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Validate the request data
            $validated = $request->validate([
                'name' => 'required',
                'slug' => 'required',
                'email' => 'required|email',
                'phone' => 'required|regex:/^[0-9]{10,15}$/',
                'agent_name' => 'required',
            ]);

            // Handle `photo` file upload
            if ($request->hasFile("photo")) {
                // If there's an existing photo, delete it
                if ($cooperator->photo) {
                    $oldPhotoPath = public_path("/uploads/") . $cooperator->photo;
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                // Upload the new photo
                $file = $request->file("photo");
                $imageName = 'Cooperator_photo_' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("/uploads"), $imageName);

                // Save the new photo to the database
                $cooperator->photo = $imageName;
                $cooperator->save();
            }

            // Handle `logo` file upload
            if ($request->hasFile("logo")) {
                // If there's an existing logo, delete it
                if ($cooperator->logo) {
                    $oldLogoPath = public_path("/uploads/") . $cooperator->logo;
                    if (file_exists($oldLogoPath)) {
                        unlink($oldLogoPath);
                    }
                }

                // Upload the new logo
                $file = $request->file("logo");
                $imageNameLogo = 'Cooperator_logo_' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("/uploads"), $imageNameLogo);

                // Save the new logo to the database
                $cooperator->logo = $imageNameLogo;
                $cooperator->save();
            }

            // Update other cooperator details
            $cooperator->update([
                'name' => $request->name ?? $cooperator->name,
                'slug' => $request->slug ?? $cooperator->slug,
                'email' => $request->email ?? $cooperator->email,
                'phone' => $request->phone ?? $cooperator->phone,
                'agent_name' => $request->agent_name ?? $cooperator->agent_name,
                'country' => $request->country ?? $cooperator->country,
                'address' => $request->address ?? $cooperator->address,
                'city' => $request->city ?? $cooperator->city,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,

            ]);

            // Return success response
            return ResponseHelper::Success(
                message: 'Account Updated Successfully',
                data: $cooperator,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }






}
