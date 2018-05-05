# Documentation
## Key Points
1. Custom guard/driver `jwt` is introduced so that user details can be accessed using `Auth::user()` or `$request->user()`.
2. Custom middleware `AuthenticateUsingJwt` checks for token and login(not using sessions) the user automatically.
3. For encoding and decoding the jwt token, take a look at `Code\Auth\Traits\JwtAuthentication`.
4. For jwt encoding and decoding `Firebase\JWT\JWT` package is made use.
5. Folder structure to be followed
6. Uses Repository pattern
7. All user details in jwt tokens are encrypted.
8. Centralized custom error handling.
9. `JsonResponseTrait` takes care of success and error json responses.
10. All modules will reside in code folder.
<br>
```
├── Module Name(User, Search, Payment, Admin)
│   ├── database
│   │   ├── migrations
│   │   └── seeds
│   ├── Http
│   │   ├── Controllers
│   │   │   └── Api
│   │   │       └── v1
│   │   ├── Requests
│   │   │   └── Api
│   │   │       └── v1
│   │   └── Resources (New in laravel 5.5)
│   ├── Model
│   ├── Policies
│   ├── Providers
│   │   ├── AuthServiceProvider.php
│   │   ├── ModuleNameServiceProvider.php
│   │   └── RouteServiceProvider.php
│   ├── Repository
│   │   └── ModuleNameRepository.php
│   ├── resources (For rendering pages.)
│       ├── assets
│       │   ├── js
│       │   └── sass
│       └── views
│   └── routes
│       ├── web (Folder contains user.php, admin.php etc)
│       └── api
│         └── v1(Folder Contains user.php, admin.php etc)
│   ├── tests
│       ├── Feature
│       │   ├── api
│       │   │   └── v1
│       │   │       └── CoreExampleTest.php
│       │   └── web
│       └── Unit
│   └── Traits
```

## If initiating new project with laravel 5.5
1. Clone the repository
2. Run `composer update`
3. When 3rd packages are added place the providers/aliases in `registerProviders()` / `registerAlias()` of `CoreServiceProvider` class. 
4. Replace `api-user1` with name of custom guard of your choice in line 58, 60 of `Core\Auth\Providers\AuthServiceProvider`
5. Replace `custom-provider` with the name of your choice in line 62 and 65 of `Core\Auth\Providers\AuthServiceProvider`

## Apply in existing project or other laravel version(5 and above)
1. Copy the code folder and paste in project directory.
2. Add `Code\Core\Providers\CoreServiceProvider::class` to `config/app.php`.
3. Copy required packages from package.json to your existing project's package.json.
4. Update your composer.json with
    ```
        "psr-4": {
            "App\\": "app/",
            "Code\\": "code/" #This line
        }
    },
    ```
5. When 3rd packages are added place the providers/aliases in `registerProviders()` / `registerAlias()` of `CoreServiceProvider` class. 
6. Replace `api-user1` with name of custom guard of your choice in line 58, 60 of `Core\Auth\Providers\AuthServiceProvider`
7. Replace `custom-provider` with the name of your choice in line 62 and 65 of `Core\Auth\Providers\AuthServiceProvider`

## Testing
1. Install phpunit globally using the `composer global require --dev phpunit/phpunit ^6.4`
2. For each module add the corresponding test folder paths under `<testsuites>` in `phpunit.xml` file found 
in project directory.
```
  <testsuites>
         <testsuite name="Feature">
             <directory suffix="Test.php">code/Core/tests/Feature</directory>
         </testsuite>
 
         <testsuite name="Unit">
             <directory suffix="Test.php">code/Core/tests/Unit</directory>
         </testsuite>
     </testsuites>
```
3. Finally run the command `phpunit` from project directory