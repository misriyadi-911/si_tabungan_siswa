<?php

namespace App\Providers;
use Illuminate\Support\Carbon;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Models\Kelas;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        View::composer('*', function ($view) {
            $data_kelas = Kelas::all();
            $view->with('data_kelas', $data_kelas);
        });

         Blade::directive('currency', function ($expression) {
            return "<?php echo 'Rp. ' . number_format($expression, 0, ',', '.'); ?>";
        });
    }
}
