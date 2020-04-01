<?php
/**
 * Created by PhpStorm.
 * User: miljanvulovic
 * Date: 4/1/20
 * Time: 9:50 AM
 */

namespace App\Http\ControllerProcessor;

use App\Model\FriendshipTypeEntity;
use App\Model\User;
use App\Repository\Friendship\IFriendshipEntityRepository;
use App\Repository\FriendshipType\IFriendshipTypeEntityRepository;
use App\Repository\User\IUserRepositoryInterface;

/**
 * @property IUserRepositoryInterface userRepository
 * @property IFriendshipEntityRepository friendshipEntityRepository
 * @property IFriendshipTypeEntityRepository friendshipTypeEntityRepository
 */
class FriendshipControllerProcessor implements IFriendshipControllerProcessor
{
    /**
     * PostController constructor.
     *
     * @param IUserRepositoryInterface $userRepository
     * @param IFriendshipEntityRepository $friendshipEntityRepository
     * @param IFriendshipTypeEntityRepository $friendshipTypeEntityRepository
     */
    public function __construct(IUserRepositoryInterface $userRepository,
                                IFriendshipEntityRepository $friendshipEntityRepository,IFriendshipTypeEntityRepository $friendshipTypeEntityRepository)
    {
        $this->userRepository = $userRepository;
        $this->friendshipEntityRepository = $friendshipEntityRepository;
        $this->friendshipTypeEntityRepository = $friendshipTypeEntityRepository;
    }

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|null
     */
    public function handleSendRequest($user_id)
    {
        $loggedin_user_id = auth()->user()->id;

        /** @var User $user */
        $addresse_id = $this->userRepository->get($user_id);

        if (!$addresse_id) {
            return response('Bad request parameter', 400);
        }

        if ($loggedin_user_id == $addresse_id->id) {
            return response('Bad request parameter', 400);
        }

        $relation_check = $this->friendshipEntityRepository->sendRequestCheckRelation($loggedin_user_id, $addresse_id->id);

        $relation_check_reverse = $this->friendshipEntityRepository->sendRequestCheckRelationReverse($addresse_id->id, $loggedin_user_id);

        $relation = $this->friendshipEntityRepository->canSendFriendRequest($loggedin_user_id, $addresse_id->id);

        if ($relation_check or $relation_check_reverse) {
            return response('You can not send friend request', 422);
        } else {

            /** @var FriendshipTypeEntity $friendship_type */
            $friendship_type = $this->friendshipTypeEntityRepository->getSendRequestType();

            if ($relation) {

                $this->friendshipEntityRepository->update($relation->id , $friendship_type->id);

                return response('Relation updated', 200);

            } else {
                $this->friendshipEntityRepository->create($loggedin_user_id, $addresse_id->id,$friendship_type->id );
                return response('Relation created', 202);
            }
        }
    }

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|null
     */
    public function handleAcceptRequest($user_id)
    {
        $loggedin_user_id = auth()->user()->id;
        $addresse_id = $this->userRepository->get($user_id);

        if (!$addresse_id) {
            return response('Bad request parameter', 400);
        }

        if ($loggedin_user_id == $addresse_id->id) {
            return response('Bad request parameter', 400);
        }

        if ($addresse_id) {

            $relation_check = $this->friendshipEntityRepository->acceptRequestCheckRelation($addresse_id->id, $loggedin_user_id);

            $relation = $this->friendshipEntityRepository->canAcceptRequestCheckRelation($addresse_id->id, $loggedin_user_id);

            if ($relation_check) {
                return response('You can not accept friend request', 422);
            } else {

                /** @var FriendshipTypeEntity $friendship_type */
                $friendship_type = $this->friendshipTypeEntityRepository->getAcceptRequestType();

                if ($relation) {

                    $this->friendshipEntityRepository->update($relation->id , $friendship_type->id);

                } else {
                    return $this->friendshipEntityRepository->relationDoesNotExits();
                }
            }
            return response('Relation updated', 200);
        } else {
            return response('Bad request parameter', 400);
        }
    }

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|null
     */
    public function handleRejectRequest($user_id)
    {
        $loggedin_user_id = auth()->user()->id;
        $addresse_id = $this->userRepository->get($user_id);

        if (!$addresse_id) {
            return response('Bad request parameter', 400);
        }

        if ($loggedin_user_id == $addresse_id->id) {
            return response('Bad request parameter', 400);
        }

        if ($addresse_id) {

            $relation_check = $this->friendshipEntityRepository->rejectAndCancelRequestCheckRelation($addresse_id->id, $loggedin_user_id);
            $relation = $this->friendshipEntityRepository->canRejectAndCancelRequestCheckRelation($addresse_id->id, $loggedin_user_id);

            if ($relation_check) {
                return response('You can not cancel friend request', 422);
            } else {

                /** @var FriendshipTypeEntity $friendship_type */
                $friendship_type = $this->friendshipTypeEntityRepository->getRejectRequestType();

                if ($relation) {

                    $this->friendshipEntityRepository->update($relation->id , $friendship_type->id);

                } else {
                    return $this->friendshipEntityRepository->relationDoesNotExits();
                }
            }
            return response('Relation updated', 200);
        } else {
            return response('Bad request parameter', 400);
        }
    }

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|null
     */
    public function handleCancelRequest($user_id)
    {
        $loggedin_user_id = auth()->user()->id;
        $addresse_id = $this->userRepository->get($user_id);

        if (!$addresse_id) {
            return response('Bad request parameter', 400);
        }

        if ($loggedin_user_id == $addresse_id->id) {
            return response('Bad request parameter', 400);
        }

        if ($addresse_id) {

            $relation_check = $this->friendshipEntityRepository->rejectAndCancelRequestCheckRelation($addresse_id->id, $loggedin_user_id);

            $relation = $this->friendshipEntityRepository->canRejectAndCancelRequestCheckRelation($loggedin_user_id, $addresse_id->id);

            if ($relation_check) {
                return response('You can not cancel friend request', 422);
            } else {

                /** @var FriendshipTypeEntity $friendship_type */
                $friendship_type = $this->friendshipTypeEntityRepository->getCancelRequestType();

                if ($relation) {

                    $this->friendshipEntityRepository->update($relation->id , $friendship_type->id);
                } else {
                    return $this->friendshipEntityRepository->relationDoesNotExits();
                }
            }
            return response('Relation updated', 200);
        } else {
            return response('Bad request parameter', 400);
        }
    }
}