# Laravel Passport Autenticación


Se deben ubicar en la carpeta del proyecto por la terminal y ejecutar el siguiente comando

```shell=
composer require laravel/passport
```

Se debe ejecutar nuevamente la migración con el comando

```shell=
php artisan migrate
```

Se debe realizar la instalación de las keys de passport en la base de datos por medio del comando

```shell=
php artisan passport:install
```

Ingrese al archivo auth.php en la carpeta config del proyecto e incluya el siguiente codigo dentro del arreglo guard

```php=
'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
```

Edite el archivo api.php en la carpeta routes del proyecto e incluya el middleware (**middleware('auth:api')**) a cada una de las rutas que desea proteger como se muestra en el siguiente codigo

```php=
Route::apiResource('estudiante',EstudianteApiController::class)->middleware('auth:api');
```

Si se quieren proteger mas de una ruta se puede crearun grupo de rutas protegidas como se muestra en el siguiente codigo
```php=
Route::middleware('auth:api')->group(function () { 
    Route::apiResource('estudiante',EstudianteApiController::class);
});
```

Edite el archivo AuthServiceProvider.php el cual se encuentra dentro de la siguiente jerarquia de carpetas:

app
|--providers

Incluya la liberia de Passport 

```php=
use Laravel\Passport\Passport;
```

Modifique el metodo boot() para incluir la siguiente linea

```php=
if (! $this->app->routesAreCached()) {
    Passport::routes();
}
```
Se debe crear un controlador nuevo para gestionar los procesos de login y registro por medio del comando

```shell=
php artisan make:controller Api/UserApiController
```

Edite el archivo UserApiController y defina dos metodos llamados login y registro.

```php=
    public function login(Request $request) {

    }

    public function registro(Request $request) {
        
    }
```

Incluir las siguientes librerias al archivo:

```php=
use App\Models\User;
use Illuminate\Support\Facades\Validator;
```


Defina el metodo registro como se muestra a continuación:

```php=
public function registro(Request $request) {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'No se puede crear el usuario'], 401);
        }
        $user= User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        $access_token_example = $user->createToken('MyApp')->accessToken;
        return response()->json(['token'=>$access_token_example],200);
    }
```


Defina el metodo login como se muestra a continuación:

```php=
public function login(Request $request) {
        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($login_credentials)){
            $user_login_token= auth()->user()->createToken('MyApp')->accessToken;
            return response()->json(['token' => $user_login_token], 200);
        }
        else{
            return response()->json(['error' => 'Acceso No Autorizado'], 401);
        }
    }
```


Se debe editar el archivo User.php ubicado en la carpeta Models de la carpeta app, modificando la libreria de HasApiToken como se muestra a continuación

```php
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
```

Edite el archivo api.php de la carpeta routes, incluya la siguiente libreria:

```php=
use App\Http\Controllers\Api\UserApiController;
```

Incluya las rutas para login y registro como se muestra a continuación:

```php=
Route::post('/registro', [UserApiController::class,'registro']);
Route::post('/login', [UserApiController::class,'login']);
```

Ejecute el proyecto

```shell=
php artisan serve
```

Por medio de Postman realice el registro y el login de un usuario y solicite la información de los estudiantes

Login
![](https://i.imgur.com/UXlcH8i.png)

Registro
![](https://i.imgur.com/hGZOOlU.png)

Estudiantes
![](https://i.imgur.com/OeyDVKb.png)
