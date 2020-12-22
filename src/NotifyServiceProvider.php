<?php

namespace Jubayed\Notify;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__.'/../config/notify.php') ?: $raw;
        $this->publishes([$source => config_path('notify.php')], 'config');
        $this->mergeConfigFrom($source, 'notify');
        $this->registerBladeDirectives();

        // alert type
        $view_path = dirname(__DIR__, 1) . '/../views/' . Config::get('notify.alert');
        $this->loadViewsFrom($view_path, 'alert');
        $this->publishes([
            $view_path  => base_path('resources/views/vendor/alert')
        ]);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerNotify();
    }

    public function registerNotify()
    {
        $this->app->singleton('notify', function (Container $app) {
            return new Notify(NotifierFactory::make($app['config']['notify']), $app['session'], $app['config']);
        });

        $this->app->alias('notify', Notify::class);

        //
        // singleton
        $this->app->singleton('alert', function () {
            return $this->app->make(Alert::class);
        });

    }


    public function registerBladeDirectives()
    {
        Blade::directive('notify_render', function () {
            return "<?php echo app('notify')->render(); ?>";
        });

        Blade::directive('notify_css', function () {
            return '<?php echo notify_css(); ?>';
        });

        Blade::directive('notify_js', function () {
            return '<?php echo notify_js(); ?>';
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'notify',
            'alert'
        ];
    }
}
