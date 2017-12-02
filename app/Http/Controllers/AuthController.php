<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Ramsey\Uuid\Uuid;
use Validator;
use Hash;
use Auth;

class AuthController extends Controller
{

    /**
     * Exibe o formulário de login /usuario/login [GET]
     */
    public function login()
    {
        return view('users.login');
    }

    /**
     * Trata a requisição vinda do formulário em /usuario/login [POST]
     */
    public function doLogin(Request $request)
    {
        $validacao = $this->loginValidator($request->all());

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao->errors());
        }

        $cred = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if (Auth::attempt($cred)) {
            //Autenticou, manda ele pra home
            return redirect('/');
        } else {
            //Credenciais inválidas
            return redirect()->back()->withErrors(['password' => 'Credenciais inválidas']);
        }

    }

    /**
     * Exibe o formulário de registro /usuario/registro [GET]
     */
    public function register()
    {
        return view('users.register');
    }


    /**
     * Trata a requisição vinda do formulário de registro /usuario/registro [POST]
     */
    public function doRegister(Request $request)
    {
        $validacao = $this->registerValidator($request->all());

        if ($validacao->fails()) {
            return redirect()->back()->withInput()->withErrors($validacao->errors());
        }

        $photo = null;
        if ($request->hasFile('photo')) {
            $nomeArquivo = Uuid::uuid4();
            $anexoFile = $request->file('photo');
            $photo = $nomeArquivo . '-' . $anexoFile->getClientOriginalName();
            $anexoFile->storeAs('uploads', $photo, 'public');
        }

        $registrado = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'cep' => $request->get('cep'),
            'logradouro' => $request->get('logradouro'),
            'cidade' => $request->get('cidade'),
            'estado' => $request->get('estado'),
            'photo' => $photo,
        ]);

        if ($registrado) {
            Auth::login($registrado);
            return redirect('/');
        } else {
            return redirect()->back()->withInput()->withErrors($validacao->errors());
        }
    }

    /**
     * Valida os dados para o login.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function loginValidator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|string|min:1',
            'email' => 'required|string|email|max:255'
        ]);
    }

    /**
     * Valida os dados para o registro.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function registerValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'cep' => 'required|string|digits:8',
            'logradouro' => 'required|string|min:5|max:255',
            'cidade' => 'required|string|min:3|max:255',
            'estado' => 'required|string|size:2',
            'photo' => 'image:jpg',
        ]);
    }

    /**
     * Valida os dados para o login.
     */
    protected function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
