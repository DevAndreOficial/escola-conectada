use Pecee\SimpleRouter\SimpleRouter as Router;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\ProfessorMiddleware;
use App\Middlewares\AlunoMiddleware;

/*
|--------------------------------------------------------------------------
| Rotas protegidas (qualquer usuário logado)
|--------------------------------------------------------------------------
*/
Router::group(['middleware' => AuthMiddleware::class], function () {

    Router::get('/', 'HomeController@index')->name('home');
    Router::get('/sobre', 'SobreController@index');

    Router::get('/users', 'UserController@index')->name('users.index');
    Router::get('/users/{id}', 'UserController@show')->name('users.show');

    Router::get('/logout', 'AuthController@logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Rotas do ADMIN
|--------------------------------------------------------------------------
*/
Router::group([
    'prefix' => '/admin',
    'middleware' => [AuthMiddleware::class, AdminMiddleware::class]
], function () {

    Router::get('/dashboard', 'Admin\DashboardController@index')
        ->name('admin.dashboard');

    Router::get('/usuarios', 'Admin\UserController@index')
        ->name('admin.users.index');
});

/*
|--------------------------------------------------------------------------
| Rotas do PROFESSOR
|--------------------------------------------------------------------------
*/
Router::group([
    'prefix' => '/professor',
    'middleware' => [AuthMiddleware::class, ProfessorMiddleware::class]
], function () {

    Router::get('/dashboard', 'Professor\DashboardController@index')
        ->name('professor.dashboard');

    Router::get('/turmas', 'Professor\TurmaController@index')
        ->name('professor.turmas.index');
});

/*
|--------------------------------------------------------------------------
| Rotas do ALUNO
|--------------------------------------------------------------------------
*/
Router::group([
    'prefix' => '/aluno',
    'middleware' => [AuthMiddleware::class, AlunoMiddleware::class]
], function () {

    Router::get('/dashboard', 'Aluno\DashboardController@index')
        ->name('aluno.dashboard');

    Router::get('/boletim', 'Aluno\BoletimController@index')
        ->name('aluno.boletim.index');
});




