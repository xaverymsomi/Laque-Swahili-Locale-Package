<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Laque\SwahiliLocale\Support\SimpleLocaleDetector;
use Laque\SwahiliLocale\Http\Middleware\LocaleNegotiationMiddleware;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

// PSR-17 factory gives us PSR-7 objects
$psr17   = new Psr17Factory();
$request = $psr17->createServerRequest('GET', 'https://example.test/')
	->withHeader('Accept-Language', 'en-US,en;q=0.8,sw;q=0.6');

$middleware = new LocaleNegotiationMiddleware(
	new SimpleLocaleDetector(['sw_TZ', 'en_US'], 'sw_TZ')
);

// Simple PSR-15 handler that inspects the locale attribute
$handler = new class($psr17) implements RequestHandlerInterface {
	public function __construct(private Psr17Factory $f) {}
	public function handle(ServerRequestInterface $request): ResponseInterface {
		$locale = $request->getAttribute('locale') ?? 'n/a';
		echo "Handled. locale={$locale}\n";
		return $this->f->createResponse(200);
	}
};

$middleware->process($request, $handler);
