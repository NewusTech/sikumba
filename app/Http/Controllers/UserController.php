<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->where('status', 1)->get();
        return view(
            'pages.admin.user-management',
            [
                'user' => Auth::user(),
                'users' => $users
            ]
        );
    }

    public function create()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        Log::info($roles);
        return view(
            'pages.admin.create-user',
            [
                'users' => $users,
                'user' => Auth::user(),
                'roles' => $roles,
            ]
        );
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $pw = strtolower(explode(' ', $request->input('fullname'))[0]);
            $password = $pw . '123';
            $passwordfix = bcrypt($password);

            $user = User::create([
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'password' => $passwordfix,
                'status' => 1
            ]);

            $user->roles()->attach([$request->input('role')]); // Gunakan attach() untuk menambahkan role baru.

            DB::commit();

            return redirect()->route('user-management')->with('success', 'User has been created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $userr = User::findOrFail($id);
        $roles = Role::all();

        return view(
            'pages.admin.edit-user',
            [
                'userr' => $userr,
                'user' => Auth::user(),
                'roles' => $roles
            ]
        );
    }

    public function profileuser()
    {
        $userr = Auth::user();
        $roles = Role::all();

        return view(
            'pages.profile-user',
            [
                'userr' => $userr,
                'user' => Auth::user(),
                'roles' => $roles
            ]
        );
    }

    public function profileupdate(Request $request, $id)
    {
        try {
            // Mulai transaksi database
            DB::beginTransaction();
    
            // Temukan user berdasarkan ID
            $user = User::findOrFail($id);
    
            // Validasi input
            $validatedData = $request->validate([
                'fullname' => 'required|max:255|min:2',
                'email' => [
                    'required',
                    'email',
                    'max:255',
    
                    function ($attribute, $value, $fail) {
                        $domain = explode('@', $value)[1] ?? '';
                        if (!preg_match('/.+\..+/', $domain)) {
                            $fail('The ' . $attribute . ' must contain a valid domain.');
                        }
                    },
                ],
                'password' => 'nullable|min:5|max:255',
            ]);
    
            // Hash password jika diberikan
            if ($request->filled('password')) {
                $validatedData['password'] = bcrypt($request->input('password'));
            } else {
                // Jika password tidak diisi, hapus dari array yang akan diupdate
                unset($validatedData['password']);
            }
    
            // Update data user
            $user->update($validatedData);
    
            // Commit transaksi
            DB::commit();
    
            // Redirect dengan pesan sukses
            return redirect()->route('profile-user')->with('success', 'Profile user has been updated');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
    
            // Redirect kembali dengan pesan kesalahan validasi
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
    
            // Redirect kembali dengan pesan kesalahan umum
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }
     

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->update([
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
            ]);

            if($request->input('role')){
                $user->roles()->sync([$request->input('role')]);
            }
            DB::commit();

            return redirect()->route('user-management')->with('success', 'User has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $role = RoleUser::where('user_id', $id)->first();

            if ($role) {
                RoleUser::where([
                    'user_id' => $id,
                ])->delete();
            }

            $user = User::findOrFail($id);
            if ($user) {
                $user->delete();
            }

            DB::commit();

            return redirect()->route('user-management')->with('success', 'User has been deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
