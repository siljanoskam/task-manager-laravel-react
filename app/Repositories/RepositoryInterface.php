<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getItems();
    public function setItems($items);
    public function setError(Bool $error);
    public function hasError(): Bool;
}
