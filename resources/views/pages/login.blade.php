@extends('layout.app')
    @section('content')
        <div class="text-center text-primary m-auto">
            <h1 class="display-3 p-3">Login</h1>

            <form class="p-1 mt-4" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                <input class="m-auto form-control w-25 mt-3 p-2" type="text" name="user" placeholder="Username">
                <input class="m-auto form-control w-25 mt-3 p-2" type="password" name="pass" placeholder="Password">

                <button type="submit" class="btn btn-primary w-25 mt-3 ">Login</button>
                <br><button type="cancel" class="btn btn-outline-primary w-25 mt-1 ">Cancel</button>
            </form>
        </div>
    @endsection