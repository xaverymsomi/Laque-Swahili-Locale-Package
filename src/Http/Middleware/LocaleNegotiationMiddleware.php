<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Http\Middleware;
use Laque\SwahiliLocale\Locale\Contracts\LocaleDetectorInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
final class LocaleNegotiationMiddleware implements MiddlewareInterface{
public function __construct(private LocaleDetectorInterface $detector,private string $attribute='locale'){}
public function process(ServerRequestInterface $request,RequestHandlerInterface $handler):ResponseInterface{$query=$request->getQueryParams();$accept=$request->getHeaderLine('Accept-Language');$locale=$this->detector->detect(['lang'=>$query['lang']??null,'accept_language'=>$accept]);return $handler->handle($request->withAttribute($this->attribute,$locale));}
}
