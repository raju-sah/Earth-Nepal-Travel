<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\UnauthorizedException;
use SebastianBergmann\Invoker\TimeoutException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {

            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    'status' => Response::HTTP_METHOD_NOT_ALLOWED,
                    'message' => 'This Method is not allowed for the requested route',
                    'error' => 'The HTTP method used in the request is not supported for this endpoint.'
                ],  Response::HTTP_METHOD_NOT_ALLOWED);
            }

            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => 'The requested resource was not found',
                    'error' => 'The resource you are trying to access does not exist in the database.'
                ], Response::HTTP_NOT_FOUND);
            }

            if ($exception instanceof BadRequestHttpException) {
                return response()->json([
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Bad request',
                    'error' => 'Please check the request format and ensure all required parameters are included.'
                ], Response::HTTP_BAD_REQUEST);
            }

            if ($exception instanceof TooManyRequestsHttpException) {
                return response()->json([
                    'status' =>  Response::HTTP_TOO_MANY_REQUESTS,
                    'message' => 'Too many requests',
                    'error' => 'You have made too many requests. Please try again later.'
                ], Response::HTTP_TOO_MANY_REQUESTS);
            }
        }
        if ($exception instanceof ConflictHttpException) {
            return response()->json([
                'status' => Response::HTTP_CONFLICT,
                'message' => 'Conflict error',
                'error' => 'The request could not be completed due to a conflict with the current state of the target resource.'
            ], Response::HTTP_CONFLICT);
        }
        if ($exception instanceof UnauthorizedException) {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Unauthorized access',
                'error' => 'Credentials do not match'
            ], Response::HTTP_UNAUTHORIZED);
        }
        if ($exception instanceof TimeoutException) {
            return response()->json([
                'status' => Response::HTTP_REQUEST_TIMEOUT,
                'message' => 'The request timed out',
                'error' => 'The server took too long to respond to the request. Please try again later.'
            ], Response::HTTP_REQUEST_TIMEOUT);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Validation error',
                'errors' => 'The request failed to pass validation. Please check the errors and try again.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // if ($exception instanceof Exception) {
        //     return response()->json([
        //         'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
        //         'message' => 'Internal Server Error',
        //         'error' => 'An unexpected error occurred. Please try again later.'
        //     ], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }
        return parent::render($request, $exception);
    }
}
