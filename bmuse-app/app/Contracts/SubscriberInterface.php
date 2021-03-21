<?php

namespace App\Contracts;

Interface SubscriberInterface
{
    public function getSubscribers();
    public function destroy( $id );
    public function getSubscribersById( $ids );
    public function store( $input );
    public function getAllSubscribers( );
}