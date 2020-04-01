<?php

namespace App\Http\Controllers;

use App\Http\ControllerProcessor\IFriendshipControllerProcessor;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FriendshipController
 * @property IFriendshipControllerProcessor controllerProcessor
 * @package App\Http\Controllers
 * @Route("/request")
 */
class FriendshipController extends BaseController
{
    public function __construct(IFriendshipControllerProcessor $controllerProcessor)
    {
        $this->middleware('auth');
        $this->controllerProcessor = $controllerProcessor;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function sendRequest(Request $request)
    {
        /** @var string $user_id */
        $user_id = $request->get('user_id');

        if ($user_id) {
            $response = $this->controllerProcessor->handleSendRequest($user_id);
            return $response;

        } else {
            return response('Bad request parameter', 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function acceptedRequest(Request $request)
    {
        /** @var string $user_id */
        $user_id = $request->get('user_id');

        if ($user_id) {
            $response = $this->controllerProcessor->handleAcceptRequest($user_id);
            return $response;

        } else {
            return response('Bad request parameter', 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function rejectRequest(Request $request)
    {
        /** @var string $user_id */
        $user_id = $request->get('user_id');

        if ($user_id) {
            $response = $this->controllerProcessor->handleRejectRequest($user_id);
            return $response;
        } else {
            return response('Bad request parameter', 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function canceledRequest(Request $request)
    {
        /** @var string $user_id */
        $user_id = $request->get('user_id');

        if ($user_id) {

            $response = $this->controllerProcessor->handleCancelRequest($user_id);
            return $response;

        } else {
            return response('Bad request parameter', 400);
        }
    }
}
